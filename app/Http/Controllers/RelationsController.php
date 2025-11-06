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

    }

}
