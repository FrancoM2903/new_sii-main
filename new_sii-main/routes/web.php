<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Escolares\AlumnoController;
use App\Http\Controllers\Escolares\PlanEstudioController;
use App\Http\Controllers\Escolares\DocenteController;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/home', [HomeController::class, 'index'])->name('home');

//Grupo de rutas para Escolares
Route::get('/escolares/alumnos', [AlumnoController::class, 'index'])->name('escolaresAlumnos');
Route::get('/escolares/alumnos/alta', [AlumnoController::class, 'altaAlumno'])->name('escolaresAlumnosAlta');
Route::post('/escolares/alumnos/crear', [AlumnoController::class, 'crearAlumno'])->name('escolaresAlumnosCrear');

Route::get('/escolares/planes_estudio', [PlanEstudioController::class, 'index'])->name('escolaresPlanesEstudio');
Route::patch('/escolares/planes_estudio/editar/{id}', [PlanEstudioController::class, 'updatePlanEstudio'])->name('planEstudioUpdate');
Route::delete('/escolares/planes_estudio/delete/{id}', [PlanEstudioController::class, 'deletePlanEstudio'])->name('PlanesEstudioEliminar');
Route::post('/escolares/planes_estudio/create', [PlanEstudioController::class, 'createPlanEstudio'])->name('PlanesEstudioCrear');

// ****************** DOCENTES ******************
Route::get('/escolares/docente', [DocenteController::class, 'index'])->name('escolaresDocente');
Route::patch('/escolares/docente/editar/{id}', [DocenteController::class, 'updateDocente'])->name('docenteUpdate');
Route::delete('/escolares/docente/delete/{id}', [DocenteController::class, 'deleteDocente'])->name('docenteDelete');
Route::post('/escolares/docente/create', [DocenteController::class, 'createDocente'])->name('docenteCreate');