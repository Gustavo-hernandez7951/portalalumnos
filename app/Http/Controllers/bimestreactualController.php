<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use Illuminate\Support\Facades\Auth;
Use \Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade as PDF;

class bimestreactualController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function parciales()
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('bimestreactual.calificacionesepcu');
                break;
            case "LICU":
                // Consulta periodo actual
                $periodos = Calificacion::where('matricula', Auth::user()->cuenta)
                ->selectRaw('periodo')
                ->orderBy('fecha_examen', 'desc')
                ->first();

                // Contador de calificaciones
                $count = Calificacion::where('matricula', Auth::user()->cuenta)
                ->where('periodo', $periodos->periodo)
                ->where('visible_portal', 'S')
                ->orderBy('num_orden', 'asc')
                ->count();

                // Boton Descargar
                if($count==0){
                    $btnDescargar = 'disabled';
                }else{
                    // Consulta calificacion periodo actual
                    $calificaciones = Calificacion::where('matricula', Auth::user()->cuenta)
                    ->where('periodo', $periodos->periodo)
                    ->where('visible_portal', 'S')
                    ->orderBy('num_orden', 'asc')
                    ->get();
                    $btnDescargar = '';
                }
        
                return view('bimestreactual.parcialeslicu', compact('calificaciones', 'btnDescargar'));
                break;
            case "MACU":
                $calificaciones = Calificacion::where('matricula', Auth::user()->cuenta)
                    ->where('visible_portal', 'S')
                    ->orderBy('num_orden', 'asc')
                    ->get();
                $count = $calificaciones->count();
                $btnDescargar = ($count > 0) ? '' : 'disabled';
                return view('bimestreactual.calificacionesmacu', compact('calificaciones', 'btnDescargar'));
                break;

        }        
    }

    public function boleta()
    {
        switch (Auth::user()->gradoconsulta) {

            case "EPCU":
                return view('bimestreactual.calificacionesepcu');
                break;

            case "LICU":
                // Consulta periodo actual
                $periodos = Calificacion::where('matricula', Auth::user()->cuenta)
                    ->selectRaw('periodo')
                    ->orderBy('fecha_examen', 'desc')
                    ->first();

                // Contador de calificaciones
                $count = Calificacion::where('matricula', Auth::user()->cuenta)
                    ->where('periodo', $periodos->periodo)
                    ->where('visible_portal', 'S')
                    ->orderBy('num_orden', 'asc')
                    ->count();

                // Botón Descargar
                if ($count == 0) {
                    $btnDescargar = 'disabled';
                } else {
                    // Consulta calificación periodo actual
                    $calificaciones = Calificacion::where('matricula', Auth::user()->cuenta)
                        ->where('periodo', $periodos->periodo)
                        ->where('visible_portal', 'S')
                        ->orderBy('num_orden', 'asc')
                        ->get();
                    $btnDescargar = '';
                }

                return view('bimestreactual.calificacioneslicu', compact('calificaciones', 'btnDescargar'));
                break;

            case "MACU":
                // Obtener TODAS las calificaciones visibles del alumno
                $calificaciones = Calificacion::where('matricula', Auth::user()->cuenta)
                    ->where('visible_portal', 'S')
                    ->orderBy('num_orden', 'asc')
                    ->get();

                // Contador
                $count = $calificaciones->count();
                $btnDescargar = ($count > 0) ? '' : 'disabled';

                return view('bimestreactual.calificacionesmacu', compact('calificaciones', 'btnDescargar'));
                break;
        }
    }

    public function boletaPDF(){
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                // return view('inicioepcu', compact('dps'));
                break;
            case "LICU":
                // Consulta periodo actual
                $periodos = Calificacion::where('matricula', Auth::user()->cuenta)
                ->orderBy('fecha_examen', 'desc')
                ->first();
                if($periodos != null){
                    $periodo = $periodos->periodo;
                }else{
                    $periodo = '';
                }
                
                // Consulta calificacion periodo actual
                $calificaciones = Calificacion::where('matricula', Auth::user()->cuenta)
                ->where('periodo', $periodo)
                ->orderBy('num_orden', 'asc')
                ->get();

                // arreglo
                $datoscals = [];
                foreach($calificaciones as $calificacion){
                $datos_cals = [ 'clave' => trim($calificacion['clave_mat']) ?? '',   
                                'calificacion' => $calificacion['calificacion'] ?? ''];
                array_push($datoscals, $datos_cals); //conexion arreglo
                }
                $claveen1 = array_column($datoscals, 'clave');
                $calsen1 = array_column($datoscals, 'calificacion');
                $folioclave = implode('-', $claveen1);
                $foliocalif = implode('-', $calsen1);
                
                $fecha = Carbon::now(); //obteniendo fecha actual
                $folio = Auth::user()->gradoconsulta.'_'.trim($calificacion->matricula).'_'.$periodos->periodo.'_'.$folioclave.'_'.$foliocalif;

                $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($folio));
                $pdf = \PDF::loadView('bimestreactual.boletalicu', compact('calificaciones', 'periodos', 'qrcode'))->setPaper('letter');
                $pdf->save(storage_path('app/public/boletas/') . $folio.'.pdf');
                return $pdf->download($folio.'.pdf',array('Attachment'=>false));
                break;
            case "MACU":
                // Consulta periodo actual
                $cuatrimestres = Calificacion::where('matricula', Auth::user()->cuenta)
                ->orderBy('fecha_examen', 'desc')
                ->first();
                if($cuatrimestres != null){
                    $cuatrimestre = $cuatrimestres->cuatrimestre;
                }else{
                    $cuatrimestre = '';
                }
                
                // Consulta calificacion periodo actual
                $calificaciones = Calificacion::where('matricula', Auth::user()->cuenta)
                ->where('cuatrimestre', $cuatrimestre)
                ->orderBy('num_orden', 'asc')
                ->get();

                // arreglo
                $datoscals = [];
                foreach($calificaciones as $calificacion){
                $datos_cals = [ 'clave' => trim($calificacion['clave_mat']) ?? '',   
                                'calificacion' => $calificacion['calificacion'] ?? ''];
                array_push($datoscals, $datos_cals); //conexion arreglo
                }
                $claveen1 = array_column($datoscals, 'clave');
                $calsen1 = array_column($datoscals, 'calificacion');
                $folioclave = implode('-', $claveen1);
                $foliocalif = implode('-', $calsen1);
                
                $fecha = Carbon::now(); //obteniendo fecha actual
                $folio = Auth::user()->gradoconsulta.'_'.trim($calificacion->matricula).'_'.$cuatrimestres->cuatrimestre.'_'.$folioclave.'_'.$foliocalif;

                $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($folio));
                $pdf = \PDF::loadView('bimestreactual.boletamacu', compact('calificaciones', 'cuatrimestres', 'qrcode'))->setPaper('letter');
                $pdf->save(storage_path('app/public/boletas/') . $folio.'.pdf');
                return $pdf->download($folio.'.pdf',array('Attachment'=>false));
                break;
        }
    }

    public function boletaPDFindividual($id)
    {
        $calificacion = Calificacion::where('idcalificacion', $id)
            ->where('matricula', Auth::user()->cuenta)
            ->firstOrFail();

        $pdf = \PDF::loadView('bimestreactual.boletaindividual', compact('calificacion'))
            ->setPaper('letter');

        return $pdf->download('Boleta-'.$calificacion->clave_mat.'.pdf');
    }
}