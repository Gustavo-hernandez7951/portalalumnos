<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MensajeRecibido;
use Illuminate\Support\Facades\Auth;
class contactoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function contacto()
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu', compact('dps'));
                break;
            case "LICU":
                return view('contacto.contactolicu');
                break;
            case "MACU":
                return view('contacto.contactomacu');
                break;
        }
    }

    public function contactar(Request $request)
    {
        $msg = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ],[
            'name.required' => __('Yo necesito su nombre')
        ]);

        Mail::to('contacto.web@cuh.edu.mx')->send(new MensajeRecibido($msg));

        return redirect()->back()->with("success","Mensaje Enviado!");
    }
}
