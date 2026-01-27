<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;
use Hash;

class cambiopasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function password()
    {
        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu', compact('dps'));
                break;
            case "LICU":
                return view('auth.passwordlicu');
                break;
            case "MACU":
                return view('auth.passwordmacu');
                break;
        }
    }
 
    public function changePassword(Request $request)
    {

        switch (Auth::user()->gradoconsulta) {
            case "EPCU":
                return view('inicioepcu', compact('dps'));
                break;
            case "LICU":
                if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                    // Las contraseñas coinciden
                    return redirect()->back()->with("error","Su contraseña actual no coincide con la contraseña que proporcionó. Inténtalo de nuevo.");
                }
        
                if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
                    // La contraseña actual y la nueva contraseña son las mismas
                    return redirect()->back()->with("error","La nueva contraseña no puede ser la misma que su contraseña actual. Por favor, elija una contraseña diferente.");
                }
        
                $validatedData = $request->validate([
                    'current-password' => 'required',
                    'new-password' => 'required|string|confirmed',
                ]);
        
                // Cambia la contraseña
                $user = Auth::user();
                $user->password = bcrypt($request->get('new-password'));
                $user->save();
        
                return redirect()->back()->with("success","Contraseña cambiada con éxito !");
                break;
            case "MACU":
                if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
                    // Las contraseñas coinciden
                    return redirect()->back()->with("error","Su contraseña actual no coincide con la contraseña que proporcionó. Inténtalo de nuevo.");
                }
        
                if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
                    // La contraseña actual y la nueva contraseña son las mismas
                    return redirect()->back()->with("error","La nueva contraseña no puede ser la misma que su contraseña actual. Por favor, elija una contraseña diferente.");
                }
        
                $validatedData = $request->validate([
                    'current-password' => 'required',
                    'new-password' => 'required|string|confirmed',
                ]);
        
                // Cambia la contraseña
                $user = Auth::user();
                $user->password = bcrypt($request->get('new-password'));
                $user->save();
        
                return redirect()->back()->with("success","Contraseña cambiada con éxito !");
                break;
        }
    }
}
