<?php

namespace App\Http\Controllers;
use App\Models\Dato_personal;
use App\Models\Carga_academica;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class direccionacademicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cargaacademica()
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('direccionacademica.cargaacademicaepcu');
                break;
            case "LICU":
                //Consulta datos personales
                $dps = Dato_personal::where('matricula', Auth::user()->cuenta)->first();
                if($dps != null){
                    $programa = $dps->programa;
                    $gradoacademico = $dps->gradoacademico;
                }else{
                    $programa = '';
                    $gradoacademico = '';
                }

                // Consulta periodo mt
                $periodosMT = Carga_academica::where('programa', $programa)
                ->where('turno', 'MT')
                ->orderBy('inicio', 'desc')
                ->first();        
                if($periodosMT != null){
                    $periodoMT = $periodosMT->periodo;
                }else{
                    $periodoMT = '';
                }

                // Consulta periodo vs
                $periodosVS = Carga_academica::where('programa', $programa)
                ->where('turno', 'VS')
                ->orderBy('inicio', 'desc')
                ->first();        
                if($periodosVS != null){
                    $periodoVS = $periodosVS->periodo;
                }else{
                    $periodoVS = '';
                }

                //Consulta periodo mx
                $periodosMX = Carga_academica::where('programa', $programa)
                ->where('turno', 'MX')
                ->orderBy('inicio', 'desc')
                ->first();
                if($periodosMX != null){
                    $periodoMX = $periodosMX->periodo;
                }else{
                    $periodoMX = '';
                }
                
                //Consulta carga academica mt
                $camts = Carga_academica::where('programa', $programa)
                ->where('gradoacademico', $gradoacademico)
                ->where('periodo', $periodoMT)
                ->where('turno', 'MT')
                ->orderBy('grupo', 'asc')
                ->get();

                //Consulta carga academica vs
                $cavss = Carga_academica::where('programa', $programa)
                ->where('gradoacademico', $gradoacademico)
                ->where('periodo', $periodoVS)
                ->where('turno', 'VS')
                ->orderBy('grupo', 'asc')
                ->get();

                //Consulta carga academica mx
                $camxs = Carga_academica::where('programa', $programa)
                ->where('gradoacademico', $gradoacademico)
                ->where('periodo', $periodoMX)
                ->where('turno', 'MX')
                ->orderBy('grupo', 'asc')
                ->get();
                
                return view('direccionacademica.cargaacademicalicu', compact('camts','cavss','camxs'));
                break;
            case "MACU":
                //Consulta datos personales
                $dps = Dato_personal::where('matricula', Auth::user()->cuenta)->first();
                if($dps != null){
                    $programa = $dps->programa;
                    $grupo = $dps->grupo;
                    $gradoacademico = $dps->gradoacademico;
                }else{
                    $programa = '';
                    $grupo = '';
                    $gradoacademico = '';
                }

                //Consulta periodo sb
                $periodos3 = Carga_academica::where('programa', $programa)
                ->where('grupo', $grupo)
                ->where('turno', 'SB')
                ->orderBy('inicio', 'desc')
                ->first();
                if($periodos3 != null){
                    $periodosb = $periodos3->inicio;
                }else{
                    $periodosb = '';
                }

                //Consulta carga academica sb
                $casbs = Carga_academica::where('programa', $programa)
                ->where('gradoacademico', $gradoacademico)
                ->where('grupo', $grupo)
                ->where('inicio', $periodosb)
                ->where('turno', 'SB')
                ->orderBy('asignatura', 'asc')
                ->get();
                
                return view('direccionacademica.cargaacademicamacu', compact('casbs'));
                break;
        }

    }
}
