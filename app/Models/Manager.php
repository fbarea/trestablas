<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    protected $table = 'managers';
    protected $fillable = [
        'nombre',
        'cargo'
    ];

    public function cities(){
        return $this->belongsToMany(City::class,'city_manager_task')
        ->withTimestamps()
        ->withPivot('manager_id','f_inicio','f_final','activa');
    }

    public function tasks(){
        return $this->belongsToMany(Task::class,'city_manager_task')
        ->withTimestamps()
        ->withPivot('f_inicio','f_final','activa');
    }

}
