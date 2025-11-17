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

    public function assignments(){
        return $this->hasMany(CityManagerTask::class);
    }

}
