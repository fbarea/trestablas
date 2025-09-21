<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CityManagerTask extends Pivot
{
    use HasFactory;

    protected $table = 'city_manager_task';
    protected $fillable = [
        'city_id',
        'task_id',
        'manager_id',
        'f_inicio',
        'f_final',
        'activa'
    ];
}
