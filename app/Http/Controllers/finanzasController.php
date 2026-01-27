<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Adeudo;
use App\Models\Dato_personal;
use App\Models\Catalogo_servicio_finanzas;
use App\Models\Catalogo_beca;
use App\Models\Dato_facturacion;
use App\Models\solicitud_facturacion;
use Illuminate\Support\Facades\Auth;
use \Carbon\Carbon;

class FinanzasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function estadodecuenta()
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu');
                break;
                
            case "LICU":
                // Count: conteo por si no hay resultados disponibles
                $count = Adeudo::where('matricula', Auth::user()->cuenta)
                    ->where('status_adeudo', 'VI')
                    ->count();

                // si hay 1 o mas lleva acabo la consulta si no redirecciona
                if($count > 0){

                    $DatoPersonal = Dato_personal::where('matricula', Auth::user()->cuenta)->first();
                    if(!$DatoPersonal) {
                        return view('finanzas.sinadeudoslicu');
                    }

                    $adeudos = Adeudo::where('matricula', Auth::user()->cuenta)
                        ->where('status_adeudo', 'VI')
                        ->orderBy('concepto_adeudo', 'asc')
                        ->get();      
                    
                    $date = Carbon::now(); //obteniendo fecha actual 
                    $datosadeudo = []; //generando Arreglo
                    
                    foreach($adeudos as $adeudo){ //datos que contiene el arreglo
                        // Verificar si la relación existe
                        if($adeudo->dato_personal) {
                            foreach($adeudo->dato_personal as $beca) {
                                // Verificar si el método C_S_F existe
                                if(method_exists($adeudo, 'C_S_F')) {
                                    $csfs = $adeudo->C_S_F()
                                        ->where('gradoacademico', $DatoPersonal->gradoacademico)
                                        ->whereDate('vigencia_del', '<=', $adeudo->fecha_calculo)
                                        ->whereDate('vigencia_al', '>=', $adeudo->fecha_calculo)
                                        ->get();
                                    
                                    foreach($csfs as $csf) {
                                        // Verificar si el método cat_beca existe
                                        if(method_exists($DatoPersonal, 'cat_beca')) {
                                            $dps = $DatoPersonal->cat_beca()
                                                ->where('gradoacademico', $DatoPersonal->gradoacademico)
                                                ->whereDate('iniciovigencia', '<=', $adeudo->fecha_calculo)
                                                ->whereDate('terminovigencia', '>=', $adeudo->fecha_calculo)
                                                ->get();
                                            
                                            foreach($dps as $dp) {
                                                $datos_adeudo = [   
                                                    'fechaactual' => $date, //fecha actual
                                                    'fechacalculo' => Carbon::parse($adeudo->fecha_calculo), //fecha calculo
                                                    'tipoadeudo' => $adeudo->tipo_adeudo ?? '', //tipo adeudo
                                                    'folioadeudo' => $adeudo->folio_adeudo ?? '', //folio adeudo
                                                    'claveservicio' => $adeudo->clave_servicio ?? '', //clave de servicio
                                                    'conceptoadeudo' => $adeudo->concepto_adeudo ?? '', //concepto adeudo
                                                    'saldoadeudo' => $adeudo->saldo_adeudo ?? 0, //importe
                                                    'aplicarbeca' => $adeudo->aplicar_beca ?? 0, //se aplica beca?
                                                    'beca' => $beca->beca ?? '',
                                                    'aplicacion' => $csf->aplicacion ?? '',
                                                    'porcentajeinteres' => $csf->porcentaje_interes ?? 0,
                                                    'importe' => $csf->importe ?? 0,
                                                    'porcentajebeca' => $dp->porcentaje_beca ?? 0,
                                                    'ajuste' => $dp->ajuste ?? 0
                                                ];
                                                array_push($datosadeudo, $datos_adeudo); //conexion arreglo - CORREGIDO
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                    
                    if(empty($datosadeudo)) {
                        return view('finanzas.sinadeudoslicu');
                    }
                    
                    // dias de atraso
                    $dias_atraso = [];
                    foreach($datosadeudo as $row) {
                        if($row['fechaactual'] > $row['fechacalculo']){
                            $dias_atraso[] = ['diasatraso' => $row['fechacalculo']->diffInDays($row['fechaactual'])];
                        } else {
                            $dias_atraso[] = ['diasatraso' => 0];
                        }
                    }
                    
                    // meses de atraso
                    $meses_atraso = [];
                    foreach($datosadeudo as $row) {
                        if($row['fechaactual'] > $row['fechacalculo']){
                            $meses_atraso[] = ['mesesatraso' => $row['fechacalculo']->diffInMonths($row['fechaactual'])];
                        } else {
                            $meses_atraso[] = ['mesesatraso' => 0];
                        }
                    }
                    
                    // calculo importe interes
                    $importe_interes = [];
                    for($i = 0; $i < count($datosadeudo); $i++) {
                        if($datosadeudo[$i]['tipoadeudo'] == 'NO'){
                            if($datosadeudo[$i]['aplicacion'] == 'D'){
                                $importe = $dias_atraso[$i]['diasatraso'] * ($datosadeudo[$i]['saldoadeudo'] * ($datosadeudo[$i]['porcentajeinteres']/100));
                                $importe_interes[] = ['importeinteres' => $importe];
                            } elseif($datosadeudo[$i]['aplicacion'] == 'M') {
                                $importe = $meses_atraso[$i]['mesesatraso'] * ($datosadeudo[$i]['saldoadeudo'] * ($datosadeudo[$i]['porcentajeinteres']/100));
                                $importe_interes[] = ['importeinteres' => $importe];
                            } else {
                                $importe_interes[] = ['importeinteres' => 0];
                            }
                        } elseif($datosadeudo[$i]['tipoadeudo'] == 'CO') {
                            $importe_interes[] = ['importeinteres' => 0];
                        } else {
                            $importe_interes[] = ['importeinteres' => 0];
                        }
                    }
                    
                    // calculo atraso
                    $atraso = [];
                    for($i = 0; $i < count($datosadeudo); $i++) {
                        if($datosadeudo[$i]['tipoadeudo'] == 'NO'){
                            if($datosadeudo[$i]['aplicacion'] == 'D'){
                                $atraso[] = ['atraso' => $dias_atraso[$i]['diasatraso']];
                            } elseif($datosadeudo[$i]['aplicacion'] == 'M'){
                                $atraso[] = ['atraso' => $meses_atraso[$i]['mesesatraso']];
                            } else {
                                $atraso[] = ['atraso' => 0];
                            }
                        } elseif($datosadeudo[$i]['tipoadeudo'] == 'CO'){
                            if($datosadeudo[$i]['aplicacion'] == 'D'){
                                $atraso[] = ['atraso' => $dias_atraso[$i]['diasatraso']];
                            } elseif($datosadeudo[$i]['aplicacion'] == 'M'){
                                $atraso[] = ['atraso' => $meses_atraso[$i]['mesesatraso']];
                            } else {
                                $atraso[] = ['atraso' => 0];
                            }
                        } else {
                            $atraso[] = ['atraso' => 0];
                        }
                    }
                    
                    // calculo beca
                    $descuento_beca = [];
                    for($i = 0; $i < count($datosadeudo); $i++) {
                        if(($datosadeudo[$i]['beca'] == 'SI' || $datosadeudo[$i]['beca'] == 'RE') && 
                           $dias_atraso[$i]['diasatraso'] == 0 && 
                           $datosadeudo[$i]['claveservicio'] == 50 && 
                           $datosadeudo[$i]['aplicarbeca'] == 1){
                            $descuento = ($datosadeudo[$i]['importe'] * ($datosadeudo[$i]['porcentajebeca']/100)) + $datosadeudo[$i]['ajuste'];
                            $descuento_beca[] = ['descuentobeca' => $descuento];
                        } else {
                            $descuento_beca[] = ['descuentobeca' => 0];
                        }
                    }
                    
                    // subtotal
                    $subtotal = [];
                    for($i = 0; $i < count($datosadeudo); $i++) {
                        $sub = $datosadeudo[$i]['saldoadeudo'] + $importe_interes[$i]['importeinteres'] - $descuento_beca[$i]['descuentobeca'];
                        $subtotal[] = ['subtotal' => $sub];
                    }
                    
                    // total
                    $total = 0;
                    foreach($subtotal as $sub) {
                        $total += $sub['subtotal'];
                    }

                    // Array: Datos a Mostrar en la tabla
                    $datostabla = [];
                    for($i = 0; $i < count($datosadeudo); $i++) {
                        $datostabla[] = [
                            'folioadeudo' => $datosadeudo[$i]['folioadeudo'],
                            'claveservicio' => $datosadeudo[$i]['claveservicio'],
                            'conceptoadeudo' => $datosadeudo[$i]['conceptoadeudo'],
                            'saldoadeudo' => $datosadeudo[$i]['saldoadeudo'],
                            'subtotal' => number_format($subtotal[$i]['subtotal'], 2),
                        ];
                    }

                    return view('finanzas.adeudoslicu', compact('datostabla', 'total'));
                } else {
                    return view('finanzas.sinadeudoslicu');
                }
                break;
                
            case "MACU":
                return view('finanzas.adeudosmacu');
                break;
        }     
    }

    public function reinscripcion()
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu');
                break;
                
            case "LICU":
                $dato_ps = Dato_personal::where('matricula', Auth::user()->cuenta)->first();
                if(!$dato_ps) {
                    return view('finanzas.sinadeudoslicu');
                }
        
                switch ($dato_ps->mes_reinscripcion) {
                    case "1": $mes='ENERO'; break;
                    case "2": $mes='FEBRERO'; break;
                    case "3": $mes='MARZO'; break;
                    case "4": $mes='ABRIL'; break;
                    case "5": $mes='MAYO'; break;
                    case "6": $mes='JUNIO'; break;
                    case "7": $mes='JULIO'; break;
                    case "8": $mes='AGOSTO'; break;
                    case "9": $mes='SEPTIEMBRE'; break;
                    case "10": $mes='OCTUBRE'; break;
                    case "11": $mes='NOVIEMBRE'; break;
                    case "12": $mes='DICIEMBRE'; break;
                    default: $mes='INDEFINIDO'; break;
                }
                
                $dps = [];
                $datos_p = [   
                    'periodo' => $dato_ps->periodo_inicio ?? '',
                    'inicio' => $dato_ps->fecha_inicio ?? '',
                    'mes' => $mes ?? '',
                ];
                array_push($dps, $datos_p);
            
                return view('finanzas.reinscripcionlicu', compact('dps'));
                break;
                
            case "MACU":
                $dato_ps = Dato_personal::where('matricula', Auth::user()->cuenta)->first();
                if(!$dato_ps) {
                    return view('finanzas.sinadeudoslicu');
                }
        
                switch ($dato_ps->mes_reinscripcion) {
                    case "1": $mes='ENERO'; break;
                    case "2": $mes='FEBRERO'; break;
                    case "3": $mes='MARZO'; break;
                    case "4": $mes='ABRIL'; break;
                    case "5": $mes='MAYO'; break;
                    case "6": $mes='JUNIO'; break;
                    case "7": $mes='JULIO'; break;
                    case "8": $mes='AGOSTO'; break;
                    case "9": $mes='SEPTIEMBRE'; break;
                    case "10": $mes='OCTUBRE'; break;
                    case "11": $mes='NOVIEMBRE'; break;
                    case "12": $mes='DICIEMBRE'; break;
                    default: $mes='INDEFINIDO'; break;
                }
                
                $dps = [];
                $datos_p = [   
                    'periodo' => $dato_ps->periodo_inicio ?? '',
                    'inicio' => $dato_ps->fecha_inicio ?? '',
                    'mes' => $mes ?? '',
                ];
                array_push($dps, $datos_p);
            
                return view('finanzas.reinscripcionmacu', compact('dps'));
                break;
        }
    }

    public function datosfiscales()
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu');
                break;
                
            case "LICU":
                $countdf = Dato_facturacion::where('matricula', Auth::user()->cuenta)->count();
                $countsf = solicitud_facturacion::where('matricula', Auth::user()->cuenta)->count();

                if ($countdf > 0 && $countsf > 0) {
                    $df = Dato_facturacion::where('matricula', Auth::user()->cuenta)->first();
                    $sf = solicitud_facturacion::where('matricula', Auth::user()->cuenta)
                        ->orderBy('fecha_solicitud', 'DESC')
                        ->first();

                    $datosfacturacion = [];
                    $datos = [      
                        'fecha_solicitud' => $df->fecha_solicitud ?? '',
                        'matricula' => $df->matricula ?? '',
                        'rfc' => $df->rfc ?? '',
                        'razonsocial' => $df->razonsocial ?? '',
                        'domiciliofiscal' => $df->domiciliofiscal ?? '',
                        'correo' => $df->correo ?? '',
                        'telefono' => $df->telefono ?? '',
                    ];
                    array_push($datosfacturacion, $datos);

                    $date = Carbon::now();
                    $meshoy = $date->format('Ym');
                    
                    if($sf && $sf->fecha_solicitud) {
                        $mes = Carbon::parse($sf->fecha_solicitud);
                        $messol = $mes->format('Ym');
                    } else {
                        $messol = '';
                    }

                    if(($countsf > 0) && ($meshoy == $messol)){
                        $sfacturacion = [];
                        if(method_exists($sf, 'cat_status')) {
                            $status_sf = $sf->cat_status()->get();
                            foreach($status_sf as $status) {
                                $sdatos = [     
                                    'fecha_solicitud' => $sf->fecha_solicitud ?? '',
                                    'matricula' => $sf->matricula ?? '',
                                    'rfc' => $sf->rfc ?? '',
                                    'status_solicitud' => $status->descripcion_status_solicitud_movtosbeca ?? '',
                                ];
                                array_push($sfacturacion, $sdatos);
                            }
                        }
                        $btnS = '';
                    } else {
                        $sfacturacion = [[
                            'fecha_solicitud' => '',
                            'matricula' => '', 
                            'rfc' => '',  
                            'status_solicitud' => ''
                        ]];
                        $btnS = 'btnSolicitar.disabled = !this.checked';
                    }

                    // Boton Datos Facturacion
                    if($countdf == 0){
                        $btn1 = '';
                        $btn2 = 'd-none';
                    } else {
                        $btn1 = 'd-none';
                        $btn2 = '';
                    }

                    // Info box estado solicitud
                    if(($countsf > 0) && ($meshoy == $messol)){
                        switch ($sf->status_solicitud) {
                            case "SP": $infobox = 'info'; break;
                            case "SC": $infobox = 'danger'; break;
                            case "SE": $infobox = 'success'; break;
                            default: $infobox = 'light'; break;
                        }
                    } else {
                        $infobox = 'light';
                    }

                    $array = [
                        "btn1" => $btn1,
                        "btn2" => $btn2,
                        "btnS" => $btnS,
                        "infobox" => $infobox,
                    ];
                    
                    return view('finanzas.datosfiscaleslicu', compact('sfacturacion', 'datosfacturacion', 'array'));
                } else {
                    return view('finanzas.paginaEnConstruccion');
                }
                break;
                
            case "MACU":
                return view('finanzas.datosfiscalesmacu');
                break;
        }
    }

    public function creardatosfiscales(Request $request)
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu');
                break;
                
            case "LICU":
                $request->validate([
                    'rfc' => 'required|string|max:13',
                    'razonsocial' => 'required|string|max:255',
                    'domiciliofiscal' => 'required|string|max:500',
                    'correo' => 'required|email|max:255',
                    'telefono' => 'required|string|max:15',
                ]);

                $date = Carbon::now();
                $fecha = $date->format('Y-m-d');

                // Creamos el objeto
                $df = new Dato_facturacion();
                
                // Seteamos las propiedades
                $df->fecha_solicitud = $fecha;
                $df->matricula = Auth::user()->cuenta;
                $df->rfc = $request->rfc;
                $df->razonsocial = $request->razonsocial;
                $df->domiciliofiscal = $request->domiciliofiscal;
                $df->correo = $request->correo;
                $df->telefono = $request->telefono;
                $df->vigente = 'SI';

                if($request->hasFile('archivo')) {
                    $file = $request->file('archivo');
                    $path = $file->storeAs('public/constanciasDF/', Auth::user()->cuenta . '.pdf');
                }
                
                // Guardamos en la base de datos
                $df->save();

                return redirect()->back()->with("success", "Sus datos se agregaron con éxito!");
                break;
                
            case "MACU":
                return view('finanzas.datosfiscalesmacu');
                break;
        }
    }

    public function editardatosfiscales(Request $request)
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu');
                break;
                
            case "LICU":
                $request->validate([
                    'rfc' => 'required|string|max:13',
                    'razonsocial' => 'required|string|max:255',
                    'domiciliofiscal' => 'required|string|max:500',
                    'correo' => 'required|email|max:255',
                    'telefono' => 'required|string|max:15',
                ]);

                $date = Carbon::now();
                $fecha = $date->format('Y-m-d');

                // Buscamos el objeto existente
                $df = Dato_facturacion::where('matricula', Auth::user()->cuenta)->first();
                
                if(!$df) {
                    return redirect()->back()->with("error", "No se encontraron datos para actualizar.");
                }
                
                // Actualizamos las propiedades
                $df->fecha_solicitud = $fecha;
                $df->rfc = $request->rfc;
                $df->razonsocial = $request->razonsocial;
                $df->domiciliofiscal = $request->domiciliofiscal;
                $df->correo = $request->correo;
                $df->telefono = $request->telefono;
                $df->vigente = 'SI';

                if($request->hasFile('archivo')) {
                    $file = $request->file('archivo');
                    $path = $file->storeAs('public/constanciasDF/', Auth::user()->cuenta . '.pdf');
                }
                
                // Guardamos en la base de datos
                $df->save();

                return redirect()->back()->with("success", "Sus datos se actualizaron con éxito!");
                break;
                
            case "MACU":
                return view('finanzas.datosfiscalesmacu');
                break;
        }
    }

    public function solicitarfactura(Request $request)
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu');
                break;
                
            case "LICU":
                $df = Dato_facturacion::where('matricula', Auth::user()->cuenta)->first();

                if(!$df) {
                    return redirect()->back()->with("error", "Primero debe registrar sus datos fiscales.");
                }

                $date = Carbon::now();
                $fecha = $date->format('Y-m-d');

                // Creamos el objeto
                $sf = new solicitud_facturacion();
                
                // Seteamos las propiedades
                $sf->fecha_solicitud = $fecha;
                $sf->rfc = $df->rfc;
                $sf->matricula = $df->matricula;
                $sf->status_solicitud = 'SP';
                
                // Guardamos en la base de datos
                $sf->save();

                return redirect()->back()->with("success", "Su solicitud se generó con éxito!");
                break;
                
            case "MACU":
                return view('finanzas.datosfiscalesmacu');
                break;
        }
    }
}