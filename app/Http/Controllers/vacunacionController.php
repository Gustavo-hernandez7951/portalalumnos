<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dato_personal;
use App\Models\Credencial_digital;
use Illuminate\Support\Facades\Auth;
Use \Carbon\Carbon;

class vacunacionController extends Controller
{
    public function registro()
    {
        $count = Credencial_digital::where('idempleado',Auth::user()->cuenta)
        ->count();
        $sa = Dato_personal::where('matricula',Auth::user()->cuenta)
            ->first();

        if($count>0){
            $a = Credencial_digital::where('idempleado',Auth::user()->cuenta)
            ->first();
            $dps = [];
                $datos = [      'matricula' => $a['idempleado'] ?? '',
                                'rfc' => $a['rfc_empleado'] ?? '',
                                'curp_alumno' => $a['curp_empleado'] ?? '',
                                'nombre' => $a['nombre_empleado'] ?? '',
                                'paterno' => $a['paterno_empleado'] ?? '',
                                'materno' => $a['materno_empleado'] ?? '',
                                'domicilio' => $a['domicilio_empleado'] ?? '',
                                'ciudad' => $a['localidad_empleado'] ?? '',
                                'nombremunicipio' => $a['municipio_empleado'] ?? '',
                                'celular' => $a['telefono_empleado'] ?? '',
                                'email_institucional' => $a['email_empleado'] ?? '',];
                array_push($dps, $datos); //conexion arreglo
        }else{
            $b = Dato_personal::where('matricula',Auth::user()->cuenta)
            ->first();
            $dps = [];
                $datos = [      'matricula' => $b['matricula'] ?? '',
                                'rfc' => $b['rfc'] ?? '',
                                'curp_alumno' => $b['curp_alumno'] ?? '',
                                'nombre' => $b['nombre'] ?? '',
                                'paterno' => $b['paterno'] ?? '',
                                'materno' => $b['materno'] ?? '',
                                'domicilio' => trim($b['calle']).' '.trim($b['colonia']).' C.P. '.trim($b['codpostal']) ?? '',
                                'ciudad' => $b['ciudad'] ?? '',
                                'nombremunicipio' => $b->cat_municipio['nombremunicipio'] ?? '',
                                'celular' => $b['celular'] ?? '',
                                'email_institucional' => $b['email_institucional'] ?? '',];
                array_push($dps, $datos); //conexion arreglo
        }
    
        foreach($dps as $dp)

        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu', compact('dps'));
                break;
            case "LICU":

                // Boton Registrar
                if(($sa->status_admvo=='AC') && ($count==0)){
                    $btnR = '';
                }else{
                    $btnR = 'disabled';
                }

                // Info box estado
                if($count>0){
                    $infobox = 'success';
                    $reg = 'Registrado!';
                }else{
                    $infobox = 'secondary';
                    $reg = 'Sin Registrar!';
                }

                return view('vacunacion.registrolicu', compact('dps', 'btnR', 'infobox', 'reg'));
                break;
            case "MACU":

                // Boton Registrar
                if(($sa->status_admvo=='AC' || $sa->status_admvo=='EG') && ($count==0)){
                    $btnR = '';
                }else{
                    $btnR = 'disabled';
                }

                // Info box estado
                if($count>0){
                    $infobox = 'success';
                    $reg = 'Registrado!';
                }else{
                    $infobox = 'secondary';
                    $reg = 'Sin Registrar!';
                }

                return view('vacunacion.registromacu', compact('dps', 'btnR', 'infobox', 'reg'));
                break;
        }     
    }

    public function registrar(Request $request)
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu', compact('dps'));
                break;
            case "LICU":
                $date = Carbon::now();
                $fecha = $date->format('Y-m-d');

                $dps = Dato_personal::where('matricula',Auth::user()->cuenta)
                ->get();
                foreach($dps as $dp)

                // Creamos el objeto
                $cd = new Credencial_digital();
                
                // Seteamos las propiedades
                $cd->idempleado = trim($dp->matricula) ;
                $cd->centro_trabajo = '13PSU0012V' ;
                $cd->rfc_empleado = $request['rfc'] ;
                $cd->curp_empleado = $request['curp'] ;
                $cd->funcion_empleado = 'ALUMNO' ;
                $cd->nombre_empleado = trim($dp->nombre) ;
                $cd->paterno_empleado = trim($dp->paterno) ;
                $cd->materno_empleado = trim($dp->materno) ;
                $cd->domicilio_empleado = $request['domicilio'] ;
                $cd->localidad_empleado = $request['localidad'] ;
                $cd->municipio_empleado = $request['municipio'] ;
                $cd->telefono_empleado = $request['telefono'] ;
                $cd->email_empleado = $dp->email_institucional ;
                $cd->area_empleado = 'ALUMNO' ;
                $cd->observaciones =  $request['observaciones'] ;
                $cd->aplicacion = $request['aplicacion'] ;
                $cd->fecha_registro = $fecha ;
                $cd->status_aplicacion = 'AP' ;
                $cd->siglas_titulo = 'C.' ;
                
                // Guardamos en la base de datos (equivalente al flush de Doctrine)
                $cd->save();

                return redirect()->back()->with("success","Sus datos se agregaron con éxito!");
                break;
            case "MACU":
                $date = Carbon::now();
                $fecha = $date->format('Y-m-d');

                $dps = Dato_personal::where('matricula',Auth::user()->cuenta)
                ->get();
                foreach($dps as $dp)

                // Creamos el objeto
                $cd = new Credencial_digital();
                
                // Seteamos las propiedades
                $cd->idempleado = trim($dp->matricula) ;
                $cd->centro_trabajo = '13MSU0344N' ;
                $cd->rfc_empleado = $request['rfc'] ;
                $cd->curp_empleado = $request['curp'] ;
                $cd->funcion_empleado = 'ALUMNO' ;
                $cd->nombre_empleado = trim($dp->nombre) ;
                $cd->paterno_empleado = trim($dp->paterno) ;
                $cd->materno_empleado = trim($dp->materno) ;
                $cd->domicilio_empleado = $request['domicilio'] ;
                $cd->localidad_empleado = $request['localidad'] ;
                $cd->municipio_empleado = $request['municipio'] ;
                $cd->telefono_empleado = $request['telefono'] ;
                $cd->email_empleado = $dp->email_institucional ;
                $cd->area_empleado = 'ALUMNO' ;
                $cd->observaciones =  $request['observaciones'] ;
                $cd->aplicacion = $request['aplicacion'] ;
                $cd->fecha_registro = $fecha ;
                $cd->status_aplicacion = 'AP' ;
                $cd->siglas_titulo = 'C.' ;
                
                // Guardamos en la base de datos (equivalente al flush de Doctrine)
                $cd->save();

                return redirect()->back()->with("success","Sus datos se agregaron con éxito!");
                break;
        }     
    }

    public function comprobante()
    {
        $countcv = Credencial_digital::where('idempleado', Auth::user()->cuenta)->count();

        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu');
                break;
            case "LICU":
                if($countcv>0){
                    $cv = Credencial_digital::where('idempleado', Auth::user()->cuenta)->first();
                    $btns = '';
                }else{
                    $cv = [
                        "fecha_vacunacion" => "",
                        "marca_vacuna" => "",
                        "lote_vacuna" => "",
                        "dosis_vacuna" => "",
                    ];
                        $btns = 'disabled';
                }
                return view('vacunacion.comprobantelicu', compact('cv', 'btns'));
                break;
            case "MACU":
                if($countcv>0){
                    $cv = Credencial_digital::where('idempleado', Auth::user()->cuenta)->first();
                    $btns = '';
                }else{
                    $cv = [
                        "fecha_vacunacion" => "",
                        "marca_vacuna" => "",
                        "lote_vacuna" => "",
                        "dosis_vacuna" => "",
                    ];
                        $btns = 'disabled';
                }
                return view('vacunacion.comprobantelicu', compact('cv', 'btns'));
                break;
        }     
    }

    public function subircomprobante(Request $request)
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu', compact('dps'));
                break;
            case "LICU":
                $date = Carbon::now();
                $fecha = $date->format('Y-m-d');

                // Creamos el objeto
                $cv = Credencial_digital::where('idempleado', Auth::user()->cuenta)->first();
                
                // Seteamos las propiedades
                $cv->fecha_subiocv = $fecha ;
                $cv->fecha_vacunacion = $request['fechav'];
                $cv->marca_vacuna = $request['vacuna'];
                $cv->lote_vacuna = $request['lote'];
                $cv->dosis_vacuna = $request['dosis'];
                $cv->status_aplicacion = 'VA';
                $cv->aplicacion = 'N';

                if($request->hasFile('archivo'))
                    {
                        $file = $request->file('archivo');
                        $originalname = time().$file->getClientOriginalName();
                        $path = $file->storeAs('public/comprobanteCV/', Auth::user()->cuenta.'.pdf');
                    }
                
                // Guardamos en la base de datos (equivalente al flush de Doctrine)
                $cv->save();

                return redirect()->back()->with("success","Sus datos se actualizaron con éxito!");

                break;
            case "MACU":
                $date = Carbon::now();
                $fecha = $date->format('Y-m-d');

                // Creamos el objeto
                $cv = Credencial_digital::where('idempleado', Auth::user()->cuenta)->first();
                
                // Seteamos las propiedades
                $cv->fecha_subiocv = $fecha ;
                $cv->fecha_vacunacion = $request['fechav'];
                $cv->marca_vacuna = $request['vacuna'];
                $cv->lote_vacuna = $request['lote'];
                $cv->dosis_vacuna = $request['dosis'];
                $cv->status_aplicacion = 'VA';
                $cv->aplicacion = 'N';

                if($request->hasFile('archivo'))
                    {
                        $file = $request->file('archivo');
                        $originalname = time().$file->getClientOriginalName();
                        $path = $file->storeAs('public/comprobanteCV/', Auth::user()->cuenta.'.pdf');
                    }
                
                // Guardamos en la base de datos (equivalente al flush de Doctrine)
                $cv->save();

                return redirect()->back()->with("success","Sus datos se actualizaron con éxito!");

                break;
        }
    }

}
