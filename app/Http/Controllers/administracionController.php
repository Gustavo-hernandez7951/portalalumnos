<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dato_personal;
use App\Models\solicitud_movto_beca;
use App\Models\Movimiento_beca;
use App\Models\Historial_academico;
use App\Models\config;
Use \Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;


class administracionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function becasolicitud()
    {
        switch (Auth::user()->gradoconsulta) {

            case "EPCU":
                // En este controlador no tienes $dps definido, así que mejor redirigir
                return redirect()->route('inicio');

            case "LICU":
            case "MACU":

                // Datos iniciales
                $fecha = Carbon::now()->format('Y-m-d');
                $configs = config::first();
                $datos_dps = Dato_personal::where('matricula', Auth::user()->cuenta)->get();

                // Evitar variables indefinidas
                $beca = $datos_dps->first();
                $año_inicio = $beca ? date("Y", strtotime($beca->fecha_inicio)) : null;

                // ======= ARMAR DPS (INFO BECA) =======
                $dps = [];

                foreach ($datos_dps as $dp) {

                    $tipo_becas = $dp->cat_beca()
                        ->where('gradoacademico', $dp->gradoacademico)
                        ->whereDate('iniciovigencia', '<=', $fecha)
                        ->whereDate('terminovigencia', '>=', $fecha)
                        ->get();

                    // Si no hay tipo de beca, igual agregamos fila vacía (para que tu tabla no truene)
                    if ($tipo_becas->isEmpty()) {
                        $dps[] = [
                            'beca' => $dp->beca ?? '',
                            'tipo_beca' => '',
                            'modalidadbeca' => '',
                            'vigencia' => $dp->vigencia ?? '',
                            'calif_condicionada' => $dp->calif_condicionada ?? '',
                            'revision_calif' => $dp->revision_calif ?? '',
                        ];
                        continue;
                    }

                    foreach ($tipo_becas as $tipo_beca) {

                        $mod_becas = $dp->cat_modbeca()->get();

                        if ($mod_becas->isEmpty()) {
                            $dps[] = [
                                'beca' => $dp->beca ?? '',
                                'tipo_beca' => $tipo_beca->porcentaje_beca ?? '',
                                'modalidadbeca' => '',
                                'vigencia' => $dp->vigencia ?? '',
                                'calif_condicionada' => $dp->calif_condicionada ?? '',
                                'revision_calif' => $dp->revision_calif ?? '',
                            ];
                            continue;
                        }

                        foreach ($mod_becas as $mod_beca) {
                            $dps[] = [
                                'beca' => $dp->beca ?? '',
                                'tipo_beca' => $tipo_beca->porcentaje_beca ?? '',
                                'modalidadbeca' => $mod_beca->descripcionmodalidad ?? '',
                                'vigencia' => $dp->vigencia ?? '',
                                'calif_condicionada' => $dp->calif_condicionada ?? '',
                                'revision_calif' => $dp->revision_calif ?? '',
                            ];
                        }
                    }
                }

                // ======= CONTEO SOLICITUD OB =======
                $count = solicitud_movto_beca::where('matricula', Auth::user()->cuenta)
                    ->where('tipo_solicitud', 'OB')
                    ->where('ciclo_solicitud', $configs->ciclo_movimientos_beca)
                    ->count();

                // Botón Solicitar
                if ($beca && ($beca->beca == 'OB') && ($año_inicio == $configs->ciclo_movimientos_beca)) {
                    $btnBeca = ($count == 0) ? '' : 'disabled';
                } else {
                    $btnBeca = 'disabled';
                }

                // ======= ARMAR SMBS (SOLICITUDES) =======
                if ($count > 0) {

                    $datos_smbs = solicitud_movto_beca::where('matricula', Auth::user()->cuenta)
                        ->where('tipo_solicitud', 'OB')
                        ->where('ciclo_solicitud', $configs->ciclo_movimientos_beca)
                        ->get();

                    $ga = $datos_dps->first();         // para grado académico
                    $statusRow = $datos_smbs->first(); // para status

                    $smbs = [];

                    foreach ($datos_smbs as $smb) {

                        $tipo_becas = $smb->cat_beca()
                            ->where('gradoacademico', $ga ? $ga->gradoacademico : null)
                            ->whereDate('iniciovigencia', '<=', $fecha)
                            ->whereDate('terminovigencia', '>=', $fecha)
                            ->get();

                        $mod_becas = $smb->cat_modbeca()->get();
                        $mov_becas = $smb->cat_movbeca()->get();
                        $status_becas = $smb->cat_statusbeca()->get();

                        foreach ($tipo_becas as $tipo_beca) {
                            foreach ($mod_becas as $mod_beca) {
                                foreach ($mov_becas as $mov_beca) {
                                    foreach ($status_becas as $status_beca) {

                                        $smbs[] = [
                                            'fecha_solicitud' => $smb->fecha_solicitud ?? '',
                                            'tipo_solicitud' => $mov_beca->descripcion_movimiento ?? '',
                                            'matricula' => $smb->matricula ?? '',
                                            'tipo_beca' => ($tipo_beca->porcentaje_beca ?? '') . '%',
                                            'modalidadbeca' => $mod_beca->descripcionmodalidad ?? '',
                                            'ciclo_solicitud' => $smb->ciclo_solicitud ?? '',
                                            'status_solicitud' => $status_beca->descripcion_status_solicitud_movtosbeca ?? '',
                                        ];
                                    }
                                }
                            }
                        }
                    }

                } else {
                    $statusRow = null;
                    $smbs = [[
                        'fecha_solicitud' => '',
                        'tipo_solicitud' => '',
                        'matricula' => '',
                        'tipo_beca' => '',
                        'modalidadbeca' => '',
                        'ciclo_solicitud' => '',
                        'status_solicitud' => ''
                    ]];
                }

                // ======= INFOBOX =======
                if ($count > 0 && $statusRow) {
                    switch ($statusRow->status_solicitud) {
                        case "SP": $infobox = 'info'; break;
                        case "ST": $infobox = 'warning'; break;
                        case "SR": $infobox = 'danger'; break;
                        case "SA": $infobox = 'success'; break;
                        default:   $infobox = 'light'; break;
                    }
                } else {
                    $infobox = 'light';
                }

                // Botón descargar constancia
                if ($count > 0 && $statusRow && $statusRow->status_solicitud == 'SA') {
                    $btnConstancia = '';
                } else {
                    $btnConstancia = 'disabled';
                }

                // Modal rechazo
                if ($count > 0 && $statusRow && in_array($statusRow->status_solicitud, ['SR', 'ST'])) {
                    $autoopen = 'autoopen';
                    $status = $statusRow->status_solicitud;
                } else {
                    $autoopen = '';
                    $status = '';
                }

                // Vistas según grado
                if (Auth::user()->gradoconsulta == "LICU") {
                    return view('administracion.becasolicitudlicu', compact(
                        'dps', 'smbs', 'btnBeca', 'infobox', 'btnConstancia', 'autoopen', 'status'
                    ));
                }

                return view('administracion.becasolicitudmacu', compact(
                    'dps', 'smbs', 'btnBeca', 'infobox', 'btnConstancia', 'autoopen'
                ));
        }
    }

    public function solicitarbeca(Request $request)
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu', compact('dps'));
                break;
            case "LICU":
                $dps = Dato_personal::where('matricula', Auth::user()->cuenta)->first();

                $configs = config::first();
                $date = Carbon::now();
                $fecha = $date->format('Y-m-d');

                // Creamos el objeto
                $renovar = new solicitud_movto_beca();
                
                // Seteamos las propiedades
                $renovar->fecha_solicitud = $fecha;
                $renovar->tipo_solicitud = 'OB';
                $renovar->matricula = $dps->matricula;
                $renovar->tipo_beca = $dps->tipo_beca;
                $renovar->modalidadbeca = $dps->modalidadbeca;
                $renovar->ciclo_solicitud = $configs->ciclo_movimientos_beca;
                $renovar->status_solicitud = 'SP';
                
                // Guardamos en la base de datos (equivalente al flush de Doctrine)
                $renovar->save();

                return redirect()->back()->with("success","Su solicitud se generó con éxito!");
                break;
            case "MACU":
                $dps = Dato_personal::where('matricula', Auth::user()->cuenta)->first();

                $configs = config::first();
                $date = Carbon::now();
                $fecha = $date->format('Y-m-d');

                // Creamos el objeto
                $renovar = new solicitud_movto_beca();
                
                // Seteamos las propiedades
                $renovar->fecha_solicitud = $fecha;
                $renovar->tipo_solicitud = 'OB';
                $renovar->matricula = $dps->matricula;
                $renovar->tipo_beca = $dps->tipo_beca;
                $renovar->modalidadbeca = $dps->modalidadbeca;
                $renovar->ciclo_solicitud = $configs->ciclo_movimientos_beca;
                $renovar->status_solicitud = 'SP';
                
                // Guardamos en la base de datos (equivalente al flush de Doctrine)
                $renovar->save();

                return redirect()->back()->with("success","Su solicitud se generó con éxito!");
                break;
        }
    }

    public function constanciaobPDF(){

        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu', compact('dps'));
                break;
            case "LICU":
                $configs = config::first();
                $smbs = solicitud_movto_beca::where('matricula', Auth::user()->cuenta)
                ->where('tipo_solicitud', 'OB')
                ->where('ciclo_solicitud', $configs->ciclo_movimientos_beca)
                ->get();
                foreach($smbs as $smb)

                // Consulta ultimo ciclo
                $cicloUltimo = Movimiento_beca::where('matricula', Auth::user()->cuenta)
                ->orderBy('ciclo_movimiento', 'desc')
                ->first();

                // datos del alumno
                $mov_becas = Movimiento_beca::where('matricula', Auth::user()->cuenta)
                ->where('ciclo_movimiento', $cicloUltimo->ciclo_movimiento)
                ->get();
                foreach($mov_becas as $mov_beca)

                $monto = $mov_beca->importe_colegiatura-(($mov_beca->importe_colegiatura*($mov_beca->porcentaje_beca/100))+$mov_beca->ajuste_beca);

                $folio = Auth::user()->gradoconsulta.'_'.'OB'.'_'.$smb->ciclo_solicitud.'_'.$mov_beca->matricula;

                $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($folio));
                $pdf = \PDF::loadView('administracion.constanciaoblicu', compact('smb', 'mov_beca', 'qrcode', 'monto'))->setPaper('letter');
                $pdf->save(storage_path('app/public/constanciasOB/') . $folio.'.pdf');
                return $pdf->download($folio.'.pdf',array('Attachment'=>false));
                break;
            case "MACU":
                $configs = config::first();
                $smbs = solicitud_movto_beca::where('matricula', Auth::user()->cuenta)
                ->where('tipo_solicitud', 'OB')
                ->where('ciclo_solicitud', $configs->ciclo_movimientos_beca)
                ->get();
                foreach($smbs as $smb)

                // Consulta ultimo ciclo
                $cicloUltimo = Movimiento_beca::where('matricula', Auth::user()->cuenta)
                ->orderBy('ciclo_movimiento', 'desc')
                ->first();

                // datos del alumno
                $mov_becas = Movimiento_beca::where('matricula', Auth::user()->cuenta)
                ->where('ciclo_movimiento', $cicloUltimo->ciclo_movimiento)
                ->get();
                foreach($mov_becas as $mov_beca)

                $monto = $mov_beca->importe_colegiatura-(($mov_beca->importe_colegiatura*($mov_beca->porcentaje_beca/100))+$mov_beca->ajuste_beca);

                $folio = Auth::user()->gradoconsulta.'_'.'OB'.'_'.$smb->ciclo_solicitud.'_'.$mov_beca->matricula;

                $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($folio));
                $pdf = \PDF::loadView('administracion.constanciaobmacu', compact('smb', 'mov_beca', 'qrcode', 'monto'))->setPaper('letter');
                $pdf->save(storage_path('app/public/constanciasOB/') . $folio.'.pdf');
                return $pdf->download($folio.'.pdf',array('Attachment'=>false));
                break;
        }
    }

    public function becareactivacion()
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu', compact('dps'));
                break;
            case "LICU":
                // Datos iniciales
                $date = Carbon::now();
                $fecha = $date->format('Y-m-d');
                $configs = config::first();
                $datos_dps = Dato_personal::where('matricula', Auth::user()->cuenta)->get();
                $count_cals = Historial_academico::where('matricula', Auth::user()->cuenta)
                ->whereBetween('calificacion', [0, 5])
                ->count();

                // dd($count_cals);
                foreach($datos_dps as $beca)
                $año_inicio = date("Y", strtotime($beca->fecha_inicio));
                
                $dps = []; //generando arreglo
                foreach($datos_dps as $datos_dp){ //datos que contiene el arreglo
                    $tipo_becas = $datos_dp->cat_beca()->where('gradoacademico', $datos_dp->gradoacademico)
                        ->whereDate('iniciovigencia', '<=', $fecha)
                        ->whereDate('terminovigencia', '>=', $fecha)->get();
                            foreach( $tipo_becas as $tipo_beca)
                        $mod_becas = $datos_dp->cat_modbeca()->get();
                                foreach( $mod_becas as $mod_beca)
                $datos_dp = [ 'beca' => $datos_dp['beca'] ?? '',
                                'tipo_beca' => $tipo_beca['porcentaje_beca'] ?? '',
                                'modalidadbeca' => $mod_beca['descripcionmodalidad'] ?? '',
                                'vigencia' => $datos_dp['vigencia'] ?? '',
                                'calif_condicionada' => $datos_dp['calif_condicionada'] ?? '',
                                'revision_calif' => $datos_dp['revision_calif'] ?? '',
                            ];
                array_push($dps, $datos_dp); //conexion arreglo
                }

                $count = solicitud_movto_beca::where('matricula', Auth::user()->cuenta)
                ->where('tipo_solicitud', 'RA')
                ->where('ciclo_solicitud', $configs->ciclo_movimientos_beca)
                ->count();

                // Boton Ronovar
                if(($count_cals=='0') && ($beca->beca=='NO') && ($año_inicio<$configs->ciclo_movimientos_beca)){
                    if($count==0){
                        $btnRenovar = '';
                    }else{
                        $btnRenovar = 'disabled';
                    }
                }else{
                    $btnRenovar = 'disabled';
                }

                if($count>0){
                $datos_smbs = solicitud_movto_beca::where('matricula', Auth::user()->cuenta)
                ->where('tipo_solicitud', 'RA')
                ->where('ciclo_solicitud', $configs->ciclo_movimientos_beca)
                ->get();
                foreach($datos_dps as $ga)
                foreach($datos_smbs as $status)
                
                $smbs = []; //generando arreglo
                foreach($datos_smbs as $datos_smb){ //datos que contiene el arreglo
                    $tipo_becas = $datos_smb->cat_beca()->where('gradoacademico', $ga->gradoacademico)
                        ->whereDate('iniciovigencia', '<=', $fecha)
                        ->whereDate('terminovigencia', '>=', $fecha)->get();
                            foreach( $tipo_becas as $tipo_beca)
                        $mod_becas = $datos_smb->cat_modbeca()->get();
                                foreach( $mod_becas as $mod_beca)
                            $mov_becas = $datos_smb->cat_movbeca()->get();
                                    foreach( $mov_becas as $mov_beca)
                                $status_becas = $datos_smb->cat_statusbeca()->get();
                                        foreach( $status_becas as $status_beca)
                $datos_smb = [  'fecha_solicitud' => $datos_smb['fecha_solicitud'] ?? '',
                                'tipo_solicitud' => $mov_beca['descripcion_movimiento'] ?? '',
                                'matricula' => $datos_smb['matricula'] ?? '',
                                'tipo_beca' => $tipo_beca['porcentaje_beca'].'%' ?? '',
                                'modalidadbeca' => $mod_beca['descripcionmodalidad'] ?? '',
                                'ciclo_solicitud' => $datos_smb['ciclo_solicitud'] ?? '',
                                'status_solicitud' => $status_beca['descripcion_status_solicitud_movtosbeca'] ?? '',
                            ];
                array_push($smbs, $datos_smb); //conexion arreglo
                }
                }else{
                    $smbs = array(array(  'fecha_solicitud' => '',
                                    'tipo_solicitud' => '', 
                                    'matricula' => '', 
                                    'tipo_beca' => '', 
                                    'modalidadbeca' => '',
                                    'ciclo_solicitud' => '', 
                                    'status_solicitud' => ''));
                }

                // Info box estado solicitud
                if($count>0){
                    switch ($status->status_solicitud) {
                        case "SP":
                            $infobox = 'info';
                            break;
                        case "SR":
                            $infobox = 'danger';
                            break;
                        case "SA":
                            $infobox = 'success';
                            break;
                    }
                }else{
                    $infobox = 'light';
                }

                // Boton Descargar Constancia
                if($count>0){
                    if($status->status_solicitud=='SA'){
                        $btnConstancia = '';
                    }else{
                        $btnConstancia = 'disabled';
                    }
                }else{
                    $btnConstancia = 'disabled';
                }

                // Mensaje Solicitud Rechazada
                if($configs->apertura_renovacion_beca=='SI'){
                    if($count>0){
                        if($status->status_solicitud=='SR'){
                            $autoopen = 'autoopen';
                        }else{
                            $autoopen = '';
                        }
                    }else{
                        $autoopen = '';
                    }
                }else{
                    $autoopen = '';
                }
                
                return view('administracion.becareactivacionlicu', compact('dps', 'smbs', 'btnRenovar', 'infobox', 'btnConstancia', 'autoopen'));
                break;
            case "MACU":
                return view('administracion.becareactivacionmacu');
                break;
        }
    }

    public function becarenovacion()
    {
        switch (Auth::user()->gradoconsulta) {

            case "EPCU":
                return redirect()->route('inicio');

            case "LICU":
            case "MACU":

                // =========================
                // Datos iniciales
                // =========================
                $fecha   = Carbon::now()->format('Y-m-d');
                $configs = config::first();
                $datos_dps = Dato_personal::where('matricula', Auth::user()->cuenta)->get();

                $beca = $datos_dps->first(); // evita variable indefinida
                $año_inicio = $beca ? date("Y", strtotime($beca->fecha_inicio)) : null;

                // =========================
                // Armado de DPS (info beca)
                // =========================
                $dps = [];

                foreach ($datos_dps as $dp) {

                    $tipo_becas = $dp->cat_beca()
                        ->where('gradoacademico', $dp->gradoacademico)
                        ->whereDate('iniciovigencia', '<=', $fecha)
                        ->whereDate('terminovigencia', '>=', $fecha)
                        ->get();

                    // si no hay tipos, agregamos fila vacía (sin tronar)
                    if ($tipo_becas->isEmpty()) {
                        $dps[] = [
                            'beca' => $dp->beca ?? '',
                            'tipo_beca' => '',
                            'modalidadbeca' => '',
                            'vigencia' => $dp->vigencia ?? '',
                            'calif_condicionada' => $dp->calif_condicionada ?? '',
                            'revision_calif' => $dp->revision_calif ?? '',
                        ];
                        continue;
                    }

                    foreach ($tipo_becas as $tipo_beca) {

                        $mod_becas = $dp->cat_modbeca()->get();

                        if ($mod_becas->isEmpty()) {
                            $dps[] = [
                                'beca' => $dp->beca ?? '',
                                'tipo_beca' => $tipo_beca->porcentaje_beca ?? '',
                                'modalidadbeca' => '',
                                'vigencia' => $dp->vigencia ?? '',
                                'calif_condicionada' => $dp->calif_condicionada ?? '',
                                'revision_calif' => $dp->revision_calif ?? '',
                            ];
                            continue;
                        }

                        foreach ($mod_becas as $mod_beca) {
                            $dps[] = [
                                'beca' => $dp->beca ?? '',
                                'tipo_beca' => $tipo_beca->porcentaje_beca ?? '',
                                'modalidadbeca' => $mod_beca->descripcionmodalidad ?? '',
                                'vigencia' => $dp->vigencia ?? '',
                                'calif_condicionada' => $dp->calif_condicionada ?? '',
                                'revision_calif' => $dp->revision_calif ?? '',
                            ];
                        }
                    }
                }

                // =========================
                // Conteo solicitudes RA
                // =========================
                $count = solicitud_movto_beca::where('matricula', Auth::user()->cuenta)
                    ->where('tipo_solicitud', 'RA')
                    ->where('ciclo_solicitud', $configs->ciclo_movimientos_beca)
                    ->count();

                // =========================
                // Botón Renovar
                // =========================
                if (
                    $configs->apertura_renovacion_beca == 'SI'
                    && $beca
                    && in_array($beca->beca, ['RP', 'RE'])
                    && $año_inicio
                    && ($año_inicio < $configs->ciclo_movimientos_beca)
                ) {
                    $btnRenovar = ($count == 0) ? '' : 'disabled';
                } else {
                    $btnRenovar = 'disabled';
                }

                // =========================
                // Armado de SMBS (solicitudes)
                // =========================
                if ($count > 0) {

                    $datos_smbs = solicitud_movto_beca::where('matricula', Auth::user()->cuenta)
                        ->where('tipo_solicitud', 'RA')
                        ->where('ciclo_solicitud', $configs->ciclo_movimientos_beca)
                        ->get();

                    $ga = $datos_dps->first();         // grado académico
                    $statusRow = $datos_smbs->first(); // status

                    $smbs = [];

                    foreach ($datos_smbs as $smb) {

                        $tipo_becas = $smb->cat_beca()
                            ->where('gradoacademico', $ga ? $ga->gradoacademico : null)
                            ->whereDate('iniciovigencia', '<=', $fecha)
                            ->whereDate('terminovigencia', '>=', $fecha)
                            ->get();

                        $mod_becas    = $smb->cat_modbeca()->get();
                        $mov_becas    = $smb->cat_movbeca()->get();
                        $status_becas = $smb->cat_statusbeca()->get();

                        foreach ($tipo_becas as $tipo_beca) {
                            foreach ($mod_becas as $mod_beca) {
                                foreach ($mov_becas as $mov_beca) {
                                    foreach ($status_becas as $status_beca) {

                                        $smbs[] = [
                                            'fecha_solicitud' => $smb->fecha_solicitud ?? '',
                                            'tipo_solicitud'  => $mov_beca->descripcion_movimiento ?? '',
                                            'matricula'       => $smb->matricula ?? '',
                                            'tipo_beca'       => ($tipo_beca->porcentaje_beca ?? '') . '%',
                                            'modalidadbeca'   => $mod_beca->descripcionmodalidad ?? '',
                                            'ciclo_solicitud' => $smb->ciclo_solicitud ?? '',
                                            'status_solicitud'=> $status_beca->descripcion_status_solicitud_movtosbeca ?? '',
                                        ];
                                    }
                                }
                            }
                        }
                    }

                } else {
                    $statusRow = null;
                    $smbs = [[
                        'fecha_solicitud' => '',
                        'tipo_solicitud' => '',
                        'matricula' => '',
                        'tipo_beca' => '',
                        'modalidadbeca' => '',
                        'ciclo_solicitud' => '',
                        'status_solicitud' => '',
                    ]];
                }

                // =========================
                // InfoBox estado
                // =========================
                if ($count > 0 && $statusRow) {
                    switch ($statusRow->status_solicitud) {
                        case "SP": $infobox = 'info'; break;
                        case "ST": $infobox = 'warning'; break;
                        case "SR": $infobox = 'danger'; break;
                        case "SA": $infobox = 'success'; break;
                        default:   $infobox = 'light'; break;
                    }
                } else {
                    $infobox = 'light';
                }

                // =========================
                // Botón Constancia
                // =========================
                if ($count > 0 && $statusRow && $statusRow->status_solicitud == 'SA') {
                    $btnConstancia = '';
                } else {
                    $btnConstancia = (Auth::user()->gradoconsulta == "MACU") ? 'd-none' : 'd-none';
                }

                // =========================
                // Mensaje/Modal de rechazo
                // =========================
                $autoopen = '';
                $status = '';

                if ($configs->apertura_renovacion_beca == 'SI' && $count > 0 && $statusRow) {
                    if (in_array($statusRow->status_solicitud, ['SR', 'ST'])) {
                        $autoopen = 'autoopen';
                        $status = $statusRow->status_solicitud;
                    }
                }

                // =========================
                // Return vista según grado
                // =========================
                if (Auth::user()->gradoconsulta == "LICU") {
                    return view('administracion.becarenovacionlicu', compact(
                        'dps', 'smbs', 'btnRenovar', 'infobox', 'btnConstancia', 'autoopen', 'status'
                    ));
                }

                // MACU: mantenemos tus variables extra por si la vista las usa
                $subirArchivo = solicitud_movto_beca::where('matricula', Auth::user()->cuenta)
                    ->where('status_solicitud', 'PP')
                    ->count();

                $matricula = Auth::user()->cuenta;

                return view('administracion.becarenovacionmacu', compact(
                    'dps', 'smbs', 'btnRenovar', 'infobox', 'btnConstancia', 'autoopen',
                    'subirArchivo', 'año_inicio', 'beca', 'configs', 'count', 'datos_dps', 'matricula'
                ));
        }
    }

    public function statustabla(Request $request)
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu', compact('dps'));
                break;
            case "LICU":
                // $dps = Dato_personal::where('matricula', Auth::user()->cuenta)->first();

                // $configs = config::first();
                // $date = Carbon::now();
                // $fecha = $date->format('Y-m-d');

                // // Creamos el objeto
                // $renovar = new solicitud_movto_beca();
                
                // // Seteamos las propiedades
                // $renovar->fecha_solicitud = $fecha;
                // $renovar->tipo_solicitud = 'RA';
                // $renovar->matricula = $dps->matricula;
                // $renovar->tipo_beca = $dps->tipo_beca;
                // $renovar->modalidadbeca = $dps->modalidadbeca;
                // $renovar->ciclo_solicitud = $configs->ciclo_movimientos_beca;
                // $renovar->status_solicitud = 'SP';
                
                // // Guardamos en la base de datos (equivalente al flush de Doctrine)
                // $renovar->save();

                // return redirect()->back()->with("success","Su solicitud se generó con éxito!");
                // break;
            case "MACU":
                $dps = Dato_personal::where('matricula', Auth::user()->cuenta)->first();
                $configs = config::first();
                $date = Carbon::now();
                $fecha = $date->format('Y-m-d');
                
                
                $renovar = new solicitud_movto_beca();
                
                // Seteamos las propiedades
                $renovar->fecha_solicitud = $fecha;
                $renovar->tipo_solicitud = 'RA';
                $renovar->matricula = $dps->matricula;
                $renovar->tipo_beca = $dps->tipo_beca;
                $renovar->modalidadbeca = $dps->modalidadbeca;
                $renovar->ciclo_solicitud = $configs->ciclo_movimientos_beca;
                $renovar->status_solicitud = 'PP';
                
                // Guardamos en la base de datos (equivalente al flush de Doctrine)
                $renovar->save();
                $array = [
                    "msj" =>  "guardado"
                ];
                return response()->json($array);
        }
    }
    public function renovarbeca(Request $request)
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu', compact('dps'));
                break;
            case "LICU":
                $dps = Dato_personal::where('matricula', Auth::user()->cuenta)->first();

                $configs = config::first();
                $date = Carbon::now();
                $fecha = $date->format('Y-m-d');

                // Creamos el objeto
                $renovar = new solicitud_movto_beca();
                
                // Seteamos las propiedades
                $renovar->fecha_solicitud = $fecha;
                $renovar->tipo_solicitud = 'RA';
                $renovar->matricula = $dps->matricula;
                $renovar->tipo_beca = $dps->tipo_beca;
                $renovar->modalidadbeca = $dps->modalidadbeca;
                $renovar->ciclo_solicitud = $configs->ciclo_movimientos_beca;
                $renovar->status_solicitud = 'SP';
                
                // Guardamos en la base de datos (equivalente al flush de Doctrine)
                $renovar->save();

                return redirect()->back()->with("success","Su solicitud se generó con éxito!");
                break;

            //Este case ya no se manda a llamar en "MACU" por que hay otra forma de renovar la beca 
            case "MACU":

                // if($request->hasFile('archivo'))
                //     {
                //         $file = $request->file('archivo');
                //         $path = $file->storeAs('D:/', 'SA'.Auth::user()->cuenta.'.pdf');
                //     }
                $dps = Dato_personal::where('matricula', Auth::user()->cuenta)->first();

                $configs = config::first();
                $date = Carbon::now();
                $fecha = $date->format('Y-m-d');
                //$matricula = $dps->matricula;
                // Creamos el objeto
                $renovar = new solicitud_movto_beca();
                $actualiza = Dato_personal::where('matricula', '=', Auth::user()->cuenta)
                ->first();
                $actua = Dato_personal::where('matricula', '=', Auth::user()->cuenta)
                ->count();
                $statts = $dps->beca;
                if($actua>0){
                    $actualiza->beca = 'RE';
                    $actualiza->save();
                }
                // Seteamos las propiedades
                $renovar->fecha_solicitud = $fecha;
                $renovar->tipo_solicitud = 'RA';
                $renovar->matricula = $dps->matricula;
                $renovar->tipo_beca = $dps->tipo_beca;
                $renovar->modalidadbeca = $dps->modalidadbeca;
                $renovar->ciclo_solicitud = $configs->ciclo_movimientos_beca;
                $renovar->status_solicitud = 'PP';
                //$renovar->docruta = '/dist/documentos/Subidos/SA'.$matricula.'.pdf';
                
                // Guardamos en la base de datos (equivalente al flush de Doctrine)
                $renovar->save();

                return redirect()->back()->with("success","Espere fechas habiles para hacer la carga del documento");
                break;
        }
    }

    public function subiarchivo(Request $request)
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu', compact('dps'));
            case "LICU":
                return view('inicioepcu', compact('dps'));
            case "MACU":

                $dps = Dato_personal::where('matricula', Auth::user()->cuenta)->first();
                $configs = config::first();

                $nombreArchivoo = 'RA26-'.$dps->matricula.'.pdf'; //falta definir el nombre del archivo con lo guardado en la configuracion de la base de datos
                $nombreArchivo =str_replace(' ','',$nombreArchivoo);
                if($request->hasFile('archivo'))
                {
                    $file = $request->file('archivo');
                    $path = $file->storeAs('public/renovacionbeca/', $nombreArchivo);
                }

                // DB::table('solicitudes_movto_beca')
                // ->where('matricula','=',$dps->matricula)
                // ->where('tipo_beca','=',$dps->tipo_beca)
                // ->where('modalidadbeca','=',$dps->modalidadbeca)
                // ->where('ciclo_solicitud','=',$configs->ciclo_movimientos_beca)
                // ->update(['status_solicitud' => 'SP'])
                // ->update(['docruta' => $nombreArchivo]); 


                $actualiza = solicitud_movto_beca::where('matricula', '=', Auth::user()->cuenta)
                ->where('tipo_beca', '=', $dps->tipo_beca)
                ->where('modalidadbeca', '=', $dps->modalidadbeca)
                ->where('ciclo_solicitud', '=', $configs->ciclo_movimientos_beca)
                ->first();

                $count = solicitud_movto_beca::where('matricula', '=', Auth::user()->cuenta)
                ->where('tipo_beca', '=', $dps->tipo_beca)
                ->where('modalidadbeca', '=', $dps->modalidadbeca)
                ->where('ciclo_solicitud', '=', $configs->ciclo_movimientos_beca)
                ->count();

                if($count>0){
                    $actualiza->status_solicitud = 'SP';
                    $actualiza->docruta = $nombreArchivo;
                    $actualiza->save();
                    
                }else{
                    return redirect()->back()->with("error","Error al subir el documento.");
                }

                return redirect()->back()->with("success","El documento se subió correctamente.");
        }
    }

    public function constanciaPDF(){
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu', compact('dps'));
                break;
            case "LICU":
                $configs = config::first();
                $smbs = solicitud_movto_beca::where('matricula', Auth::user()->cuenta)
                ->where('tipo_solicitud', 'RA')
                ->where('ciclo_solicitud', $configs->ciclo_movimientos_beca)
                ->get();
                foreach($smbs as $smb)

                // Consulta ultimo ciclo
                $cicloUltimo = Movimiento_beca::where('matricula', Auth::user()->cuenta)
                ->orderBy('ciclo_movimiento', 'desc')
                ->first();

                // datos del alumno
                $mov_becas = Movimiento_beca::where('matricula', Auth::user()->cuenta)
                ->where('ciclo_movimiento', $cicloUltimo->ciclo_movimiento)
                ->get();
                foreach($mov_becas as $mov_beca)

                $monto = $mov_beca->importe_colegiatura-(($mov_beca->importe_colegiatura*($mov_beca->porcentaje_beca/100))+$mov_beca->ajuste_beca);

                $folio = Auth::user()->gradoconsulta.'_'.'RA'.'_'.$smb->ciclo_solicitud.'_'.$mov_beca->matricula;

                 // Codigo de QR esta estaba comentada
                $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($folio));
                
                $pdf = \PDF::loadView('administracion.constanciaralicu', compact('smb', 'mov_beca', 'qrcode','monto'))->setPaper('letter');
                $pdf->save(storage_path('app/public/constanciasRA/') . $folio.'.pdf');
                return $pdf->download($folio.'.pdf',array('Attachment'=>false));
                break;
            case "MACU":
                $configs = config::first();
                $smbs = solicitud_movto_beca::where('matricula', Auth::user()->cuenta)
                ->where('tipo_solicitud', 'RA')
                ->where('ciclo_solicitud', $configs->ciclo_movimientos_beca)
                ->get();
                foreach($smbs as $smb)

                // Consulta ultimo ciclo
                $cicloUltimo = Movimiento_beca::where('matricula', Auth::user()->cuenta)
                ->orderBy('ciclo_movimiento', 'desc')
                ->first();

                // datos del alumno
                $mov_becas = Movimiento_beca::where('matricula', Auth::user()->cuenta)
                ->where('ciclo_movimiento', $cicloUltimo->ciclo_movimiento)
                ->get();
                foreach($mov_becas as $mov_beca)

                $monto = $mov_beca->importe_colegiatura-(($mov_beca->importe_colegiatura*($mov_beca->porcentaje_beca/100))+$mov_beca->ajuste_beca);

                $folio = Auth::user()->gradoconsulta.'_'.'RA'.'_'.$smb->ciclo_solicitud.'_'.$mov_beca->matricula;

                $qrcode = base64_encode(QrCode::format('svg')->size(200)->errorCorrection('H')->generate($folio));
                $pdf = \PDF::loadView('administracion.constanciaramacu', compact('smb', 'mov_beca', 'qrcode', 'monto'))->setPaper('letter');
                $pdf->save(storage_path('app/public/constanciasRA/') . $folio.'.pdf');
                return $pdf->download($folio.'.pdf',array('Attachment'=>false));
                break;
        }
    }
}
