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
                // Historial completo y ordenado
                $historial = Historial_academico::where('matricula', Auth::user()->cuenta)
                    ->orderBy('clave_mat', 'asc')
                    ->get();

                $materiascount = $historial->count();

                // Historial sin inglés (para promedio) y ordenado
                $historial2 = Historial_academico::where('matricula', Auth::user()->cuenta)
                    ->where('asignatura', 'not like', '%INGLES%')
                    ->orderBy('clave_mat', 'asc')
                    ->get();

                $materiascount2 = $historial2->count();
                $sumcals = $historial2->sum('calificacion');
                $promedio = $materiascount2 > 0 ? bcdiv($sumcals, $materiascount2, 2) : 0;

                // Construcción de la tabla
                $asig = [];
                foreach ($historial as $h) {
                    $asig[] = [
                        'orden' => $h->num_orden ?? '',
                        'clave' => $h->clave_mat ?? '', 
                        'asignatura' => $h->asignatura ?? '',

                        'calord' => $h->calificacion ?? '',
                        'fechaord' => $h->fecha_examen ?? '',

                        'calext' => $h->cal_ext ?? '',
                        'fechaext' => $h->fecha_ext ?? '',

                        'calo1r' => $h->cal_o1r ?? '',
                        'fechao1r' => $h->fecha_o1r ?? '',

                        'cale1r' => $h->cal_e1r ?? '',
                        'fechae1r' => $h->fecha_e1r ?? '',

                        'calo2r' => $h->cal_o2r ?? '',
                        'fechao2r' => $h->fecha_o2r ?? '',

                        'cale2r' => $h->cal_e2r ?? '',
                        'fechae2r' => $h->fecha_e2r ?? '',
                    ];
                }

                return view('serviciosescolares.kardexlicu', compact('asig', 'promedio', 'materiascount'));
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
