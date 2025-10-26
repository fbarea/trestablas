<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Task;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        return view('home');
    }

    public function tasksList(){

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

    public function tasksCreate(){
        return 'Método tasksCreate';
    }
}
