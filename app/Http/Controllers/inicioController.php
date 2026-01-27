<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dato_personal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InicioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio()
    {
        $dps = Dato_personal::where('matricula', Auth::user()->cuenta)->get();
        $modal = null;

        switch (Auth::user()->gradoconsulta) {

            case "EPCU":
                // Vista real
                return view('inicioepcu', compact('dps'));

            case "LICU":
                foreach ($dps as $DatoPersonal) {
                    $programa = trim((string) $DatoPersonal->programa);

                    if (in_array($programa, ['LD','LP','ISC','LCSF','LASC','LCE'])) {
                        $modal = 'autoopen';
                        break;
                    }
                }

                // Vista real
                return view('iniciolicu', compact('dps', 'modal'));

            case "MACU":
                // Vista real
                return view('iniciomacu', compact('dps'));

            default:
                return view('iniciolicu', compact('dps', 'modal'));
        }
    }

    public function estadoPrivacidad()
    {
        try {
            $matricula = Auth::user()->cuenta;

            $estado = DB::table('datos_personales')
                ->where('matricula', $matricula)
                ->value('aviso_privacidad_aceptado');

            return response()->json([
                'aceptado' => (bool) $estado,
                'matricula' => $matricula,
                'valor_bd' => $estado,
            ]);

        } catch (\Exception $e) {
            Log::error('Error en estadoPrivacidad', ['exception' => $e]);

            return response()->json([
                'aceptado' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function aceptarPrivacidad()
    {
        try {
            $matricula = Auth::user()->cuenta;

            $updated = DB::table('datos_personales')
                ->where('matricula', $matricula)
                ->update(['aviso_privacidad_aceptado' => true]);

            if ($updated === 0) {
                return response()->json([
                    'aceptado' => false,
                    'mensaje' => 'No se encontró la matrícula en datos_personales'
                ], 404);
            }

            return response()->json([
                'aceptado' => true,
                'mensaje' => 'Actualizado correctamente'
            ]);

        } catch (\Exception $e) {
            Log::error('Error en aceptarPrivacidad', ['exception' => $e]);

            return response()->json([
                'aceptado' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
