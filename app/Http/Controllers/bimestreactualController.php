<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calificacion;
use Illuminate\Support\Facades\Auth;
Use \Carbon\Carbon;
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

public function boletaPDF()
{
    @set_time_limit(120);
    ini_set('memory_limit', '512M');

    $grado = Auth::user()->gradoconsulta;
    $matricula = Auth::user()->cuenta;

    if ($grado === "LICU") {
        $periodos = Calificacion::where('matricula', $matricula)
            ->orderBy('fecha_examen', 'desc')
            ->first();
        $periodo = ($periodos !== null) ? $periodos->periodo : '';
        $calificaciones = Calificacion::where('matricula', $matricula)
            ->where('periodo', $periodo)
            ->orderBy('num_orden', 'asc')
            ->get();

        if ($calificaciones->isEmpty()) {
            abort(404, 'No hay calificaciones para generar la boleta.');
        }

        // Nombre de archivo corto (sin concatenar claves/califs)
        $folio = "LICU_{$matricula}_{$periodo}_" . now()->format('YmdHis');

        $pdf = PDF::loadView('bimestreactual.boletalicu', compact('calificaciones', 'periodos'))
            ->setPaper('letter');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $folio . '.pdf', ['Content-Type' => 'application/pdf']);
    }

    if ($grado == "MACU") {

        $cuatrimestres = Calificacion::where('matricula', $matricula)
            ->orderBy('fecha_examen', 'desc')
            ->first();

        $cuatrimestre = ($cuatrimestres !== null) ? $cuatrimestres->cuatrimestre : '';

        if ($cuatrimestre === '') {
            abort(404, 'No hay cuatrimestre disponible.');
        }

        $calificaciones = Calificacion::where('matricula', $matricula)
            ->where('cuatrimestre', $cuatrimestre)
            ->orderBy('num_orden', 'asc')
            ->get();

        if ($calificaciones->isEmpty()) {
            abort(404, 'No hay calificaciones para generar la boleta.');
        }

        $folio = "MACU_{$matricula}_{$cuatrimestre}_" . now()->format('YmdHis');

        $pdf = PDF::loadView('bimestreactual.boletamacu', compact('calificaciones', 'cuatrimestres'))
            ->setPaper('letter');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $folio . '.pdf', ['Content-Type' => 'application/pdf']);
    }
    abort(404);
}

    public function boletaPDFindividual($id)
    {
        $calificacion = Calificacion::where('idcalificacion', $id)
            ->where('matricula', Auth::user()->cuenta)
            ->firstOrFail();

        $pdf = PDF::loadView('bimestreactual.boletaindividual', compact('calificacion'))
            ->setPaper('letter');

        return $pdf->download('Boleta-'.$calificacion->clave_mat.'.pdf');
    }
}