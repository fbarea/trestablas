<?php

namespace App\Http\Controllers;

use App\Models\City;
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

}
