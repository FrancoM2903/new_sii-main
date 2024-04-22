<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Edificio;
use Illuminate\Database\QueryException;

class EdificioController extends Controller
{
    //
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $edificios = Edificio::all();

        return view('escolares.edificio', compact('edificios'));
    }

    public function createEdificio(Request $request) {
        try {
            $request->validate([
                'txtEdificio' => 'required|string',
                'txtDescripcion' => 'required|string',
            ]);

            // Crea un nuevo plan
            $edificio = new Edificio();
            $edificio->nombre_edificio = $request->txtEdificio;
            $edificio->descripcion = $request->txtDescripcion;
            $edificio->save();

            return back()->with("Correcto", "Edificio correctamente");
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Ese edificio ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar el edificio");
        }
    }

    public function updateEdificio(Request $request, $id) {
        try {

            $edificio = Edificio::findOrFail($id);
            $edificio->nombre_edificio = $request->txtEdificio;
            $edificio->descripcion = $request->txtDescripcion;
            $edificio->save();
            return back()->with("Correcto", "Edificio modificado correctamente");
        } catch (QueryException $e) {
            // Verificar si el error es debido a una restricción de unicidad
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Error, el edificio ya existe");
            }

            // Si no es una restricción de unicidad, puedes manejar otros tipos de errores aquí
            return back()->with("Incorrecto", "Error desconocido");
        }
    }

    public function deleteEdificio($id) {
        //Hay que recibir como parametro el id del registro a eliminar
        try {
            // Buscamos el plan de estudio
            $edificio = Edificio::findOrFail($id);
            // Se elimina
            $edificio->delete();

            return back()->with("Correcto", "Se ha eliminado el edificio correctamente");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error al eliminar el edificio");
        }
    }
}
