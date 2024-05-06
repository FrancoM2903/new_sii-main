<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\User;
use App\Models\PlanEstudio;
use App\Models\Estatus;
use App\Models\TiposAlumno;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class AlumnoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAlumno (){
        $alumnos = Alumno::all();
        $plan_estudios = PlanEstudio::all();
        $estatus = Estatus::all();
        $tipos_alumno = TiposAlumno::all();
        return view('escolares.alumno', compact('alumnos','plan_estudios','estatus', 'tipos_alumno'));
    }

    public function createAlumno(Request $request) {
        try {
            $request->validate([
                'txtNoControl' => 'required',
                'txtNombAlumn' => 'required',
                'txtApPatAlumn' => 'required',
                'txtApMatAlumn' => 'required',
                'txtCURPAlum' => 'required',
                'txtSemestre' => 'required',
                'selectCarreraAlum' => 'required',
                'selectEsatAlum' => 'required',
                'selectTipoAlum' => 'required',
            ]);

            $fecha_nacimiento = substr($request->txtCURPAlum,4,6);
            //echo($fecha_nacimiento);

            $user = User::create([
                'name' => $request->txtApPatAlumn.' '.$request->txtApMatAlumn.' '.$request->txtNombAlumn,
                'email' => 'l'.$request->txtNoControl.'@sjuanrio.tecnm.mx',
                'password' => Hash::make('Tecsj+'.$fecha_nacimiento),
            ]);

            // Crea un nuevo plan
            $alumnos = new Alumno();
            $alumnos->numero_control = $request->txtNoControl;
            $alumnos->nombre = $request->txtNombAlumn;
            $alumnos->ap_paterno = $request->txtApPatAlumn;
            $alumnos->ap_materno = $request->txtApMatAlumn;
            $alumnos->curp = $request->txtCURPAlum;
            $alumnos->semestre = $request->txtSemestre;
            //foraneas
            $alumnos->plan_estudio_id = $request->selectCarreraAlum;
            $alumnos->estatus_id = $request->selectEsatAlum;
            $alumnos->tipo_alumno_id = $request->selectTipoAlum;
            //asignando el id a llave foranea
            $alumnos->user_id = $user->id;

            $alumnos->save(); //Guardamos

            $user->assignRole('alumno');

            return back()->with("Correcto", "Alumno agregado correctamente");
            
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Ese Numero de control ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar al Alumno");
        }
    }

    public function updateAlumno(Request $request, $id) {
        try {
            // Tu lógica para actualizar el plan de estudios aquí
            $alumnos = Alumno::findOrFail($id);
            $alumnos->numero_control = $request->txtNoControlUp;
            $alumnos->nombre = $request->txtNombAlumnUp;
            $alumnos->ap_paterno = $request->txtApPatAlumnUp;
            $alumnos->ap_materno = $request->txtApMatAlumnUp;
            $alumnos->curp = $request->txtCURPAlumUp;
            $alumnos->semestre = $request->txtSemestreUp;
            //foraneas
            $alumnos->plan_estudio_id = $request->selectCarreraAlumUp;
            $alumnos->estatus_id = $request->selectEsatAlumUp;
            $alumnos->tipo_alumno_id = $request->selectTipoAlumUp;

            $alumnos->save();

            return back()->with("Correcto", "Alumno modificado correctamente");
        } catch (QueryException $e) {
            // Verificar si el error es debido a una restricción de unicidad
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Error, el alumno ya existe");
            }

            // Si no es una restricción de unicidad, puedes manejar otros tipos de errores aquí
            return back()->with("Incorrecto", "Error desconocido");
        }
    }

    public function deleteAlumno($id) {
        //Hay que recibir como parametro el id del registro a eliminar
        try {
            // Buscamos el plan de estudio
            $alumnos = Alumno::findOrFail($id);
            // Se elimina
            $alumnos->delete();
 
            return back()->with("Correcto", "Se ha eliminado el alumno correctamente");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error al eliminar el alumno");
        }
    }

    

}
