<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Escolares\AlumnoController;
use App\Http\Controllers\Escolares\PlanEstudioController;
use App\Http\Controllers\Escolares\DocenteController;
use App\Http\Controllers\Escolares\EdificioController;
use App\Http\Controllers\Escolares\SalonController;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/home', [HomeController::class, 'index'])->name('home');

// ****************** PLAN DE ESTUDIOS ******************
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

// ****************** EDIFICIOS Y SALONES ******************
// ------------------------- EDIFICIOS -------------------------
Route::get('/escolares/edificio', [EdificioController::class, 'getEdificio'])->name('edificios');
Route::post('/escolares/edificio/create', [EdificioController::class, 'createEdificio'])->name('edificioCreate');
Route::patch('/escolares/edificio/editar/{id}', [EdificioController::class, 'updateEdificio'])->name('edificioUpdate');
Route::delete('/escolares/edificio/delete/{id}', [EdificioController::class, 'deleteEdificio'])->name('edificioDelete');

// --------------------------- SALONES ---------------------------
//Route::get('/escolares/edificio', [EdificioController::class, 'getEdificios'])->name('salonesMostrar');
Route::post('/escolares/salon/create', [SalonController::class, 'createSalon'])->name('salonCreate');
Route::patch('/escolares/salon/editar/{id}', [SalonController::class, 'updateSalon'])->name('salonUpdate');
Route::delete('/escolares/salon/delete/{id}', [SalonController::class, 'deleteSalon'])->name('salonDelete');