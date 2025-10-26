<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', 'App\Http\Controllers\MainController@index')->name('inicio'); 

// Tareas
Route::match(['get','post'],'listar_tareas',[MainController::class,'tasksList'])->name('tasks.list');
Route::get('nueva_tarea',[MainController::class,'tasksCreate'])->name('tasks.create');

// Relaciones
//Route::get('editar-relacion/{task_id}/{city_id}', 'RelationsController@relationEdit')->name('relationEdit');
