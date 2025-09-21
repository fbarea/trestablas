<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = [
        'tarea',
        'descripcion'
    ];

    public function cities(){
        return $this->belongsToMany(City::class,'city_manager_task')
        ->withTimestamps()
        ->withPivot('manager_id','f_inicio','f_final','activa');
    }

    public function managers(){
        return $this->belongsToMany(Manager::class,'city_manager_task')
        ->withTimestamps()
        ->withPivot('f_inicio','f_final','activa');
    }

}
