<?php

namespace App\Http\Controllers\Escolares;

use App\Http\Controllers\Controller;
use App\Models\Periodo;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PeriodoController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function getPeriodos() {
        $periodos = Periodo::all();
        return view('escolares.periodo', compact('periodos'));
    }

    public function createPeriodo(Request $request) {
        try {
            $request->validate([
                'selectAnioPeri' => 'required',
                'selectPeriodoPer' => 'required',
                'selectEstatusPeri' => 'required',
            ]);

            if ($request->selectPeriodoPer == 1) {
                $perio = "Enero - Junio";
            } elseif ($request->selectPeriodoPer == 2) {
                $perio = "Agosto - Diciembre";
            } elseif ($request->selectPeriodoPer == 3) {
                $perio = "Verano";
            }

            // Crea un nuevo plan
            $periodo = new Periodo();
            $periodo->clave_periodo = $request->selectAnioPeri.'/'.$request->selectPeriodoPer;
            $periodo->nombre_periodo = $perio.' 20'.$request->selectAnioPeri;
            $periodo->estatus = $request->selectEstatusPeri;
            $periodo->save();

            return back()->with("Correcto", "Periodo creado correctamente");

        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "ERROR - Ese periodo ya existe");
            }
            // Cualquier Otro error
            return back()->with("Incorrecto", "Error al agregar el periodo");
        }
    }

    public function updatePeriodo(Request $request, $id) {

        try {

            if ($request->selectPeriodoPer == 1) {
                $period = "Enero - Junio";
            } elseif ($request->selectPeriodoPer == 2) {
                $period = "Agosto - Diciembre";
            } elseif ($request->selectPeriodoPer == 3) {
                $period = "Verano";
            }

            // Crea un nuevo plan
            $periodo = Periodo::findOrFail($id);
            //$periodo->clave_periodo = $request->selectAnioPeriUp.'/'.$request->selectPeriodoPerUp;
            //$periodo->nombre_periodo = $period.' 20'.$request->selectAnioPeriUp;
            $periodo->estatus = $request->selectEstatusPeriUp;
            $periodo->save();


            return back()->with("Correcto", "Periodo modificado correctamente");
        } catch (QueryException $e) {
            // Verificar si el error es debido a una restricción de unicidad
            if ($e->errorInfo[1] == 1062) {
                return back()->with("Incorrecto", "Error, el periodo ya existe");
            }
            // Si no es una restricción de unicidad, puedes manejar otros tipos de errores aquí
            return back()->with("Incorrecto", "Error desconocido");
        }
    }

    public function deletePeriodo($id) {
        //Hay que recibir como parametro el id del registro a eliminar
        try {
            // Buscamos el plan de estudio
            $periodo = Periodo::findOrFail($id);
            // Se elimina
            $periodo->delete();

            return back()->with("Correcto", "Se ha eliminado el periodo correctamente");
        } catch (QueryException $e) {
            // Cualquier  error
            return back()->with("Incorrecto", "Error al eliminar el periodo");
        }
    }
}
