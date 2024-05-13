<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class MateriaController extends Controller {
    
    public function __construct() {
        $this->middleware('auth');
    }

    public function getMaterias() {
        $materias = Materia::all();
        return view('escolares.materia', compact('materias'));
    }

    public function createMateria(Request $request) {
        try {
            $request->validate([
                'txtClaveMat' => 'required',
                'txtNombMat' => 'required',
                'txtCredMat' => 'required',
            ]);

            // Crea un nuevo plan
            $materia = new Materia();
            $materia->calve_materia = $request->txtClaveMat;
            $materia->nombre = $request->txtNombMat;
            $materia->creditos = $request->txtCredMat;
            $materia->save();

            return back()->with("Correcto", "Materia creada correctamente");

        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Esa materia ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar la materia");
        }
    }

    public function updateMateria(Request $request, $id) {

        try {
            $materia = Materia::findOrFail($id);
            $materia->calve_materia = $request->txtClaveMatUp;
            $materia->nombre = $request->txtNombMatUp;
            $materia->creditos = $request->txtCredMatUp;
            $materia->save();
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

    public function deleteMateria($id) {
        //Hay que recibir como parametro el id del registro a eliminar
        try {
            // Buscamos el plan de estudio
            $materia = Materia::findOrFail($id);
            // Se elimina
            $materia->delete();

            return back()->with("Correcto", "Se ha eliminado la materia correctamente");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error al eliminar la materia");
        }
    }
}
