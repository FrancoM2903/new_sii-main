<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Escolares\AlumnoController;
use App\Http\Controllers\Escolares\PlanEstudioController;
use App\Http\Controllers\Escolares\DocenteController;
use App\Http\Controllers\Escolares\EdificioController;
use App\Http\Controllers\Escolares\SalonController;
use App\Http\Controllers\Escolares\EspecialidadController;
use App\Http\Controllers\Escolares\MateriaController;
use App\Http\Controllers\Escolares\PeriodoController;
use App\Http\Controllers\Escolares\MateriaPlanEstudioController;

Auth::routes();

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['role:escolares']], function () {

    // ****************** ALUMNOS ******************
	Route::get('/escolares/alumnos', [AlumnoController::class, 'getAlumno'])->name('escolaresAlumnos');
    Route::post('/escolares/alumnos/create', [AlumnoController::class, 'createAlumno'])->name('alumnoCreate');
    Route::patch('/escolares/alumnos/editar/{id}', [AlumnoController::class, 'updateAlumno'])->name('alumnoUpdate');
    Route::delete('/escolares/alumnos/delete/{id}', [AlumnoController::class, ' '])->name('alumnoDelete');

    // ****************** DOCENTES ******************
    Route::get('/escolares/docente', [DocenteController::class, 'index'])->name('escolaresDocente');
    Route::patch('/escolares/docente/editar/{id}', [DocenteController::class, 'updateDocente'])->name('docenteUpdate');
    Route::delete('/escolares/docente/delete/{id}', [DocenteController::class, 'deleteDocente'])->name('docenteDelete');
    Route::post('/escolares/docente/create', [DocenteController::class, 'createDocente'])->name('docenteCreate');

    // ****************** EDIFICIOS Y SALONES ******************
    // ------------------------- EDIFICIOS -------------------------
    Route::get('/escolares/edificio', [EdificioController::class, 'getEdificio'])->name('escolaresEdificios');
    Route::post('/escolares/edificio/create', [EdificioController::class, 'createEdificio'])->name('edificioCreate');
    Route::patch('/escolares/edificio/editar/{id}', [EdificioController::class, 'updateEdificio'])->name('edificioUpdate');
    Route::delete('/escolares/edificio/delete/{id}', [EdificioController::class, 'deleteEdificio'])->name('edificioDelete');

    // --------------------------- SALONES ---------------------------
    Route::post('/escolares/salon/create', [SalonController::class, 'createSalon'])->name('salonCreate');
    Route::patch('/escolares/salon/editar/{id}', [SalonController::class, 'updateSalon'])->name('salonUpdate');
    Route::delete('/escolares/salon/delete/{id}', [SalonController::class, 'deleteSalon'])->name('salonDelete');

    // ------------------------- PERIODOS -------------------------
    Route::get('/escolares/periodo', [PeriodoController::class, 'getPeriodos'])->name('escolaresPeriodos');
    Route::post('/escolares/periodo/create', [PeriodoController::class, 'createPeriodo'])->name('periodoCreate');
    Route::patch('/escolares/periodo/editar/{id}', [PeriodoController::class, 'updatePeriodo'])->name('periodoUpdate');
    Route::delete('/escolares/periodo/delete/{id}', [PeriodoController::class, 'deletePeriodo'])->name('periodoDelete');

});

Route::group(['middleware' => ['role:docente|escolares']], function () {
    // ****************** PLAN DE ESTUDIOS Y ESPECIALIDADES******************
    // ------------------------- PLANES DE ESTUDIO -------------------------
    Route::get('/escolares/planes_estudio', [PlanEstudioController::class, 'index'])->name('escolaresPlanesEstudio');
    Route::patch('/escolares/planes_estudio/editar/{id}', [PlanEstudioController::class, 'updatePlanEstudio'])->name('planEstudioUpdate');
    Route::delete('/escolares/planes_estudio/delete/{id}', [PlanEstudioController::class, 'deletePlanEstudio'])->name('PlanesEstudioEliminar');
    Route::post('/escolares/planes_estudio/create', [PlanEstudioController::class, 'createPlanEstudio'])->name('PlanesEstudioCrear');

    // ------------------------- ESPECIALIDEDES -------------------------
    Route::post('/escolares/especialidad/create', [EspecialidadController::class, 'createEspecialidad'])->name('especialidadCreate');
    Route::patch('/escolares/especialidad/editar/{id}', [EspecialidadController::class, 'updateEspecialidad'])->name('especialidadUpdate');
    Route::delete('/escolares/especialidad/delete/{id}', [EspecialidadController::class, 'deleteEspecialidad'])->name('especialidadDelete');

    // ------------------------- MATERIAS POR PLAN DE ESTUDIO -------------------------
    Route::get('/escolares/planes_estudio/materia/{id}', [MateriaPlanEstudioController::class, 'getMateriasPlan'])->name('escolaresMateriaPlanEstudio');
    Route::post('/escolares/periodo/create/{idPlan}', [MateriaPlanEstudioController::class, 'createMateriaPlanEstudio'])->name('materiaPlanEstudioCreate');
    Route::delete('/escolares/periodo/delete/{idPlan}/{idMateria}', [MateriaPlanEstudioController::class, 'deleteMateriaPlanEstudio'])->name('materiaPlanEstudioDelete');
});

Route::group(['middleware' => ['role:div_estudios|escolares']], function () {
    // ------------------------- MATERIAS -------------------------
    Route::get('/escolares/materia', [MateriaController::class, 'getMaterias'])->name('escolaresMaterias');
    Route::post('/escolares/materia/create', [MateriaController::class, 'createMateria'])->name('materiaCreate');
    Route::patch('/escolares/materia/editar/{id}', [MateriaController::class, 'updateMateria'])->name('materiaUpdate');
    Route::delete('/escolares/materia/delete/{id}', [MateriaController::class, 'deleteMateria'])->name('materiaDelete');
});

