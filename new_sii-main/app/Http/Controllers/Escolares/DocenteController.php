<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use App\Models\Docente;
use App\Models\User;

class DocenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index (){
        $docentes = Docente::all();

        return view('escolares.docente', compact('docentes'));
    }

    public function updateDocente(Request $request, $id) {
        try {
            // Tu lógica para actualizar el plan de estudios aquí
            $docentes = Docente::findOrFail($id);
            $docentes->rfc = $request->txtRFC;
            $docentes->nombre = $request->txtNombre;
            $docentes->ap_paterno = $request->txtApPaterno;
            $docentes->ap_materno = $request->txtApMaterno;
            $docentes->curp = $request->txtCURP;
            $docentes->email = $request->txtEmail;
            // Actualiza otros campos si es necesario...
            $docentes->save();
            return back()->with("Correcto", "Docente modificado correctamente");
        } catch (QueryException $e) {
            // Verificar si el error es debido a una restricción de unicidad
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Error, el docente ya existe");
            }

            // Si no es una restricción de unicidad, puedes manejar otros tipos de errores aquí
            return back()->with("Incorrecto", "Error desconocido");
        }
    }

    public function deleteDocente($id) {
        //Hay que recibir como parametro el id del registro a eliminar
        try {
            // Buscamos el plan de estudio
            $docente = Docente::findOrFail($id);
            // Se elimina
            $docente->delete();
 
            return back()->with("Correcto", "Se ha eliminado el docente correctamente");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error al eliminar el plan de estudios");
        }
    }

    public function createDocente(Request $request) {
        try {
            $request->validate([
                'txtRFC' => 'required|string',
                'txtNombre' => 'required|string',
                'txtApPaterno' => 'required|string',
                'txtApMaterno' => 'required|string',
                'txtCURP' => 'required|string',
                'txtEmail' => 'required|string',
                // Agrega más reglas de validación para otros campos aquí
                // los 'txt' vienen de la vista
            ]);

            $fecha_nacimiento = substr($request->txtCURP,4,6);
            echo($fecha_nacimiento);

            $user = User::create([
                'name' => $request->txtApPaterno.' '.$request->txtApMaterno.' '.$request->txtNombre,
                'email' => $request->txtEmail,
                'password' => Hash::make('Tecsj+'.$fecha_nacimiento),
            ]);

            // Crea un nuevo plan
            $docentes = new Docente();
            $docentes->rfc = $request->txtRFC;
            $docentes->nombre = $request->txtNombre;
            $docentes->ap_paterno = $request->txtApPaterno;
            $docentes->ap_materno = $request->txtApMaterno;
            $docentes->curp = $request->txtCURP;
            $docentes->email = $request->txtEmail;
            //asignando el id a llave foranea
            $docentes->user_id = $user->id;

            $docentes->save(); //Guardamos

            $user->assignRole('docente');

            return back()->with("Correcto", "Docente agregado correctamente");
            
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Ese RFC ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar al docente");
        }
    }
}
