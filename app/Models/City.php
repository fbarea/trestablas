<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities';
    protected $fillable = [
        'ciudad',
        'pais'
    ];

    /*
    public function managers(){
        return $this->belongsToMany(Manager::class,'city_manager_task')
        ->withTimestamps()
        ->withPivot('f_inicio','f_final','activa');
    }

    public function tasks(){
        return $this->belongsToMany(Task::class,'city_manager_task')
        ->withTimestamps()
        ->withPivot('f_inicio','f_final','activa');
    }
    */
    
    public function assignments(){
        return $this->hasMany(CityManagerTask::class);
    }

}
