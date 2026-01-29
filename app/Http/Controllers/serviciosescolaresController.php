<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dato_personal;
use App\Models\Catalogo_asignatura;
use App\Models\Historial_academico;
use App\Models\Servicio_social;
use Illuminate\Support\Facades\Auth;

class serviciosescolaresController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function datospersonales(){
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('serviciosescolares.datospersonalesepcu');
            case "LICU":
                $dps = Dato_personal::where('matricula', Auth::user()->cuenta)->get();
                return view('serviciosescolares.datospersonaleslicu', compact('dps'));
            case "MACU":
                $dps = Dato_personal::where('matricula', Auth::user()->cuenta)->get();
                return view('serviciosescolares.datospersonalesmacu', compact('dps'));
        }
    }

    public function kardex()
    {
        switch (Auth::user()->gradoconsulta) {

            case "LICU":

                // 1) Traemos plan/programa del alumno desde datos_personales
                $alumno = Dato_personal::where('matricula', Auth::user()->cuenta)
                    ->select(['idplan', 'programa'])
                    ->first();

                $plan = (int) ($alumno->idplan ?? 0);
                $programa = strtoupper(trim($alumno->programa ?? ''));

                // 2) Historial completo
                $historial = Historial_academico::where('matricula', Auth::user()->cuenta)
                    ->orderBy('clave_mat', 'asc')
                    ->get();

                $materiascount = $historial->count();

                // 3) Historial para promedio según regla institucional:
                //    Plan 2002 y 2016 -> excluir inglés
                //    Plan 2023 -> incluir inglés
                $queryPromedio = Historial_academico::where('matricula', Auth::user()->cuenta)
                    ->orderBy('clave_mat', 'asc');

                if (in_array($plan, [2002, 2016], true)) {
                    $queryPromedio->where('asignatura', 'not like', '%INGLES%');
                }

                $historial2 = $queryPromedio->get();
                $materiascount2 = $historial2->count();

                // 4) Promedio TRUNCADO a 2 decimales (sin redondear)
                $sumcals = (float) $historial2->sum('calificacion');

                if ($materiascount2 > 0) {
                    $raw = $sumcals / $materiascount2;
                    $promedio = floor($raw * 100) / 100;                 // truncado real
                    $promedio = number_format($promedio, 2, '.', '');     // "0.00"
                } else {
                    $promedio = number_format(0, 2, '.', '');
                }

                //Helper local: convierte número a A/NA (solo para visualización)
                $toAcreditadoNA = function ($valor) {
                    if ($valor === null || $valor === '') return '';
                    // Si ya viene como texto, lo respetamos
                    if (is_string($valor) && !is_numeric($valor)) return strtoupper(trim($valor));

                    $num = (float) $valor;
                    return ($num >= 6) ? 'A' : 'NA';
                };

                // 5) Construcción de la tabla (con regla A/NA para planes 2002 y 2016)
                $asig = [];
                foreach ($historial as $h) {

                    $esIngles = stripos($h->asignatura ?? '', 'INGLES') !== false;
                    $usaAcreditado = $esIngles && in_array($plan, [2002, 2016], true);

                    $asig[] = [
                        'orden' => $h->num_orden ?? '',
                        'clave' => $h->clave_mat ?? '',
                        'asignatura' => $h->asignatura ?? '',

                        'calord' => $usaAcreditado ? $toAcreditadoNA($h->calificacion) : ($h->calificacion ?? ''),
                        'fechaord' => $h->fecha_examen ?? '',

                        'calext' => $usaAcreditado ? $toAcreditadoNA($h->cal_ext) : ($h->cal_ext ?? ''),
                        'fechaext' => $h->fecha_ext ?? '',

                        'calo1r' => $usaAcreditado ? $toAcreditadoNA($h->cal_o1r) : ($h->cal_o1r ?? ''),
                        'fechao1r' => $h->fecha_o1r ?? '',

                        'cale1r' => $usaAcreditado ? $toAcreditadoNA($h->cal_e1r) : ($h->cal_e1r ?? ''),
                        'fechae1r' => $h->fecha_e1r ?? '',

                        'calo2r' => $usaAcreditado ? $toAcreditadoNA($h->cal_o2r) : ($h->cal_o2r ?? ''),
                        'fechao2r' => $h->fecha_o2r ?? '',

                        'cale2r' => $usaAcreditado ? $toAcreditadoNA($h->cal_e2r) : ($h->cal_e2r ?? ''),
                        'fechae2r' => $h->fecha_e2r ?? '',
                    ];
                }

                return view('serviciosescolares.kardexlicu', compact(
                    'asig', 'promedio', 'materiascount', 'plan', 'programa'
                ));
        }
    }

    public function serviciosocial()
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu', compact('dps'));
                break;
            case "LICU":
                $ss = Servicio_social::where('matricula', Auth::user()->cuenta)->first();
                $serviciosocial = [];
                $datos_ss = [   'tipo' => $ss->cat_tiss['descripcion_tipo_inscripcion'] ?? '',
                                'dependencia' => $ss->cat_dep['nombre_dependencia'] ?? '',
                                'programa' => $ss->cat_pross['nombre_programa'] ?? '',
                                'ejercico' => $ss->cat_perss['anio_periodo'] ?? '',
                                'inicio' => $ss->cat_perss['fecha_inicio'] ?? '',
                                'termino' => $ss->cat_perss['fecha_termino'] ?? '',
                                'status' => $ss->cat_sss['descripcion_status_servsocial'] ?? '',
                                'solicitud' => $ss['solicitud'] ?? '',
                                'historialacademico' => $ss['historial_academico'] ?? '',
                                'constancianoadeudo' => $ss['constancia_no_adeudo'] ?? '',
                                'cartapresentacion' => $ss['carta_presentacion'] ?? '',
                                'cartaaceptacion' => $ss['carta_aceptacion'] ?? '',
                                'cartaasignacion' => $ss['carta_asignacion'] ?? '',
                                'cartaterminacion' => $ss['carta_terminacion'] ?? '',
                                'constanciaacreditacion' => $ss['constancia_acreditacion'] ?? '',
                                'reporte1' => $ss['reporte_mes1'] ?? '',
                                'reporte2' => $ss['reporte_mes2'] ?? '',
                                'reporte3' => $ss['reporte_mes3'] ?? '',
                                'reporte4' => $ss['reporte_mes4'] ?? '',
                                'reporte5' => $ss['reporte_mes5'] ?? '',
                                'reporte6' => $ss['reporte_mes6'] ?? '',
                                'reportefinal' => $ss['reporte_final'] ?? '',];
                array_push($serviciosocial, $datos_ss); //conexion arreglo
                
                return view('serviciosescolares.serviciosociallicu', compact('serviciosocial'));
                break;
            case "MACU":
                return view('serviciosescolares.serviciosocialmacu');
                break;
        }
    }

    public function estudiosocioeconomico() {
        return view('serviciosescolares.estudiosocioeconomico');
    }

    public function titulaciones() {
        return view('serviciosescolares.titulaciones');
    }
}
