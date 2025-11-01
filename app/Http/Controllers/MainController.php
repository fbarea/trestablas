<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Manager;
use App\Models\Task;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        return view('home');
    }

    public function taskList(){

        $tareas = Task::with(['assignments.city','assignments.manager'])
            ->orderBy('tarea')
            ->get();
        
        $tareas = $tareas->map(function($tarea){
            $tarea->cities = $tarea->assignments->map(function($assignment){
                $city = $assignment->city;
                $city->manager = $assignment->manager;
                $city->activa = $assignment->activa;
                $city->f_inicio = $assignment->f_inicio;
                $city->f_final = $assignment->f_final;
                return $city;
            });
            //dd($tarea);
            return $tarea;
        });
        
        //dd($tareas);
        
        return view('tareas.list')
        ->with(['tareas' => $tareas]);

    }

    public function taskCreate(){
        
        // Obtenemos datos de los listados
        $ciudades = City::orderBy('ciudad')->get();
        $responsables = Manager::orderBy('nombre')->get();

        return view('tareas.new')
            -> with([
                'ciudades' => $ciudades,
                'responsables' => $responsables,
                'fecha_por_defecto' => date('Y-m-d')
            ]);
    
    }

    public function taskStore(Request $request){
        
        $reglas = [
            'tarea' => 'required|max:100|unique:tasks,tarea',
            'f_inicio' => 'required',
            'f_final' => 'required|after_or_equal:f_inicio',
            'city_id' => 'required|exists:cities,id',
            'manager_id' => 'required|exists:managers,id'
        ];

        $mensajes = [
            'tarea.required' => 'Debe indicar el nombre de la tarea',
            'tarea.max' => 'El nombre de la tarea no puede exceder de 100 caracteres',
            'tarea.unique' => 'Ya existe una tarea con ese nombre',
            'f_inicio.required' => 'Debe indicar una fecha de inicio',
            'f_final.required' => 'Debe indicar una fecha de fin',
            'f_final.after_or_equal' => 'La fecha de finalización no puede ser anterior a la fecha de inicio'
        ];

        $request->validate($reglas,$mensajes);

        $nuevaTarea = Task::create([
            'tarea' => $request->tarea,
            'descripcion' => $request->descripcion
        ]);

        // registramos la relacion en la tabla pivote
        $nuevaTarea->assignments()->create([
            'city_id' => $request->city_id,
            'manager_id' => $request->manager_id,
            'f_inicio' => $request->f_inicio,
            'f_final' => $request->f_final,
            'activa' => $request->activa
        ]);

        return view('tareas.creada')
        ->with([
            'tarea' => $request->tarea
        ]);


    }

    public function taskEdit($id){
        $tarea = Task::findOrFail($id);
        return view('tareas.edit')
        ->with(['tarea'=>$tarea]);
    }

    public function taskUpdate(Request $request){
        
        $reglas = [
            'tarea'=> 'required|max:100|unique:tasks,tarea,'.$request->id.',id',
        ];

        $messages = [
            'tarea.required' => 'Debe especificar el nombre de la tarea.',
            'tarea.max' => 'El nombre de la tarea es demasiado largo.',
            'tarea.unique' => 'El nombre ya está asignado a otra tarea.',
        ];

        $request->validate($reglas, $messages);

        $cambio = Task::find($request->id);
        $cambio->tarea = $request->tarea;
        $cambio->descripcion = $request->descripcion;

        // comprobamos si ha habido cambios
        if($cambio->isClean()){
            $aviso = 'No se han cambiado datos.';
            $clase = 'alert-danger';
            $boton = 'btn-danger'; 
        } else {
            $aviso = 'Los cambios se han efectuado.';
            $clase = 'alert-success';
            $boton = 'btn-success';
            $cambio->save();
        }

        return view('tareas.editada')
        ->with([
            'tarea' => $request->tarea,
            'aviso' => $aviso,
            'clase' => $clase,
            'boton' => $boton
        ]);
    }

    public function taskDestroy($id){
        
        $tarea = Task::findOrFail($id);
        $tarea->assignments()->delete();
        $tarea->delete();

        return redirect()
            -> route('tasks.list')
            ->with('success','Tarea eliminada');
    }
}
