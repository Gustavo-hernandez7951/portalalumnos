<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class bibliotecaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function digital()
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('biblioteca.digitalepcu');
                break;
            case "LICU":
                return view('biblioteca.digitallicu');
                break;
            case "MACU":
                return view('biblioteca.digitalmacu');
                break;
        }
    }

    public function librosenprestamo()
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('biblioteca.librosenprestamoepcu');
                break;
            case "LICU":
                return view('biblioteca.librosenprestamolicu');
                break;
            case "MACU":
                return view('biblioteca.librosenprestamomacu');
                break;
        }
    }

    public function consultabibliografia()
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('biblioteca.consultabibliografiaepcu');
                break;
            case "LICU":
                return view('biblioteca.consultabibliografialicu');
                break;
            case "MACU":
                return view('biblioteca.consultabibliografiamacu');
                break;
        }
    }
}
