<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\RelationsController;
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
Route::match(['get','post'],'listar_tareas',[MainController::class,'taskList'])->name('tasks.list');
Route::get('nueva_tarea',[MainController::class,'taskCreate'])->name('tasks.create');
Route::post('grabar_tarea',[MainController::class,'taskStore'])->name('tasks.store');
Route::get('editar_tarea/{id}',[MainController::class,'taskEdit'])->name('tasks.edit');
Route::post('actualizar_tarea',[MainController::class,'taskUpdate'])->name('tasks.update');
Route::get('borrar_tarea/{id}',[MainController::class,'taskDestroy'])->name('tasks.destroy');

// Relaciones
Route::get('editar_relacion/{task_id}/{city_id}',[RelationsController::class,'relationEdit'])->name('relations.edit');
Route::post('actualizar_relacion/{task_id}/{city_id}',[RelationsController::class,'relationUpdate'])->name('relations.update');
Route::get('borrar_ciudad/{task_id}/{city_id}',[RelationsController::class,'relationDestroy'])->name('relations.destroy');

//Route::get('editar-relacion/{task_id}/{city_id}', 'RelationsController@relationEdit')->name('relationEdit');
