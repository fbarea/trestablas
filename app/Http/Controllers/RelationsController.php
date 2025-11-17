<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\CityManagerTask;
use App\Models\Manager;
use App\Models\Task;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function relationDestroy($task_id, $city_id){
        
        $tarea = Task::findOrFail($task_id);
        $ciudad = City::findOrFail($city_id);

        $tarea->assignments()
         ->where('city_id',$city_id)
         ->delete();

        return view('relaciones.borrada')
        ->with([
            'tarea' => $tarea->tarea,
            'ciudad' => $ciudad->ciudad
            ]
        );
    }

    public function relationCreate($task_id){
        
        $bolSinCiudades = false;
        $bolSinManagers = false;
        $mensajeSinElementos = "";

        // obtenemos la tarea
        $tarea = Task::findOrFail($task_id);

        // ciudades y managers
        $ciudades = City::orderBy('ciudad')->get();
        $managers = Manager::orderBy('nombre')->get();

        // ciudades y managers usados
        $ciudadesRelacionadas = CityManagerTask::where('task_id',$task_id)
            ->pluck('city_id')
            ->unique()
            ->toArray();

        $managersRelacionados = CityManagerTask::where('task_id',$task_id)
            ->pluck('manager_id')
            ->unique()
            ->toArray();    

        // eliminamos los usados
        $ciudadesDisponibles = $ciudades->reject(function ($c) use ($ciudadesRelacionadas){
            return in_array($c->id, $ciudadesRelacionadas);
        })->values();

        $managersDisponibles = $managers->reject(function ($m) use ($managersRelacionados){
            return in_array($m->id,$managersRelacionados);
        })->values();

        // si ya no hay ciudades disponibles
        if($ciudadesDisponibles->count() == 0){
            $bolSinCiudades = true;
            $mensajeSinElementos = " ciudades ";
        }
        if($managersDisponibles->count() == 0){
            $bolSinManagers = true;
            $mensajeSinElementos = " managers ";
        }

        if($bolSinCiudades && $bolSinManagers){
            $mensajeSinElementos = " ciudades ni managers ";
        }

        if($bolSinCiudades || $bolSinManagers){
            return view('relaciones.todos-asociados')
            ->with([
                'tarea' => $tarea->tarea,
                'mensaje' => $mensajeSinElementos
            ]);
        }

        // Obtenemos la fecha por defecto para asociarla a la relacion
        $fechaPorDefecto = date('Y-m-d');

        // Vista
        return view('relaciones.new')
            ->with([
                'tarea' => $tarea,
                'ciudades' => $ciudadesDisponibles,
                'managers' => $managersDisponibles,
                'fechaPorDefecto' => $fechaPorDefecto
            ]);

    }

    public function relationEdit($task_id, $city_id){

        // relacion
        $relacion = CityManagerTask::where('task_id',$task_id)
            ->where('city_id',$city_id)
            ->firstOrFail();

        // cargamos relaciones
        $relacion->load(['task','city','manager']);

        // datos para listados
        $cities = City::orderBy('ciudad')->get();
        $managers = Manager::orderBy('nombre')->get();

        return view('relaciones.edit')
        ->with([
            'relacion' => $relacion,
            'tarea' => $relacion->task,
            'ciudad' => $relacion->city,
            'manager' => $relacion->manager,
            'ciudades' => $cities,
            'managers' => $managers
        ]);   
    }

    public function relationUpdate(Request $request, $task_id, $city_id){
        
        $reglas = [
            'manager_id' => 'required|exists:managers,id',
            'f_inicio' => 'required|date',
            'f_final' => 'required|date|after_or_equal:f_inicio',
            'activa' => 'required|in:S,N',
            'city_id' => [
                'required',
                'exists:cities,id',
                function ($attribute, $value, $fail) use ($task_id, $city_id){
                    $existe = CityManagerTask::where('task_id', $task_id)
                        ->where('city_id',$value)
                        ->where('city_id','!=',$city_id)
                        ->exists();

                    if($existe){
                        $ciudadSeleccionada = City::find($value);
                        $nombreCiudad = $ciudadSeleccionada ? $ciudadSeleccionada->ciudad : 'desconocida';
                        $fail("La ciudad '{$nombreCiudad}' ya está asignada a esta tarea");
                    }    
                }
            ],
        ];

        $mensajes = [
            'manager_id.required' => 'Debe seleccionar un gestor',
            'f_inicio.required' => 'Debe indicar una fecha de inicio',
            'f_final.required' => 'Debe indicar una fecha de fin',
            'f_final.after_or_equal' => 'La fecha de finalización no puede ser anterior a la fecha de inicio',
            'city_id.required' => 'Debe seleccionar una ciudad'
        ];

        $request->validate($reglas,$mensajes);

        $relacion = CityManagerTask::where('task_id',$task_id)
            ->where('city_id',$city_id)
            ->firstOrFail();

        $relacion->city_id = $request->city_id;
        $relacion->manager_id = $request->manager_id;
        $relacion->f_inicio = $request->f_inicio;
        $relacion->f_final = $request->f_final;
        $relacion->activa = $request->activa;
        $relacion->save();

        $tarea = Task::find($request->task_id);
        
        return view('relaciones.editada')
        ->with([
            'tarea' => $tarea->tarea
        ]);

    }

    public function relationStore(Request $request){

        $reglas = [
            'manager' => 'required|exists:managers,id',
            'city' => 'required|exists:cities,id',
            'f_inicio' => 'required',
            'f_final' => 'required|after_or_equal:f_inicio',
        ];

        $mensajes = [
            'city.required' => 'Debe indicar la ciudad con la que se relaciona la tarea.',
            'city.exists' => 'La ciudad indicada no está registrada.',
            'manager.required' => 'Debe indicar el gestor de la tarea.',
            'manager.exists' => 'El gestor indicado no existe.',
            'f_inicio.required' => 'Se necesita una fecha de inicio.',
            'f_final.required' => 'Se necesita una fecha de finalización.',
            'f_final.after_or_equal' => 'La fecha de finalización no puede ser anterior a la de inicio.',
        ];

        $request->validate($reglas,$mensajes);

        // comprobamos que no exista ya esa relacion.
        $task_id = $request->task_id;

        $existeRelacion = CityManagerTask::where('task_id',$task_id)
            ->where('city_id',$request->city)
            ->exists();

        if ($existeRelacion) {
            return back()
            ->withErrors(['city' => 'Esa ciudad ya está asignada a esta tarea'])
            ->withInput();
        }

        CityManagerTask::create([
            'task_id' => $task_id,
            'city_id' => $request->city,
            'manager_id' => $request->manager,
            'f_inicio' => $request->f_inicio,
            'f_final' => $request->f_final,
            'activa' => $request->activa ?? 'S'
        ]);

        // datos para la vista
        $tarea = Task::find($request->task_id);
        $ciudad = City::find($request->city);

        return view('relaciones.creada')
            ->with([
                'tarea' => $tarea->tarea,
                'ciudad' => $ciudad->ciudad
            ]);

    }

}
