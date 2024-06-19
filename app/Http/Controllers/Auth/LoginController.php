<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; // Asegúrate de tener este use statement al principio de tu LoginController
use Illuminate\Http\Request; // Asegúrate de tener este use statement al principio de tu LoginController

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    // En tu LoginController boton DE ESTADO ACTIVO E INACTIVO
    public function attemptLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['state'] = 'Activo'; // Asegúrate de que el valor sea un string

        if (Auth::attempt($credentials)) {
            // El usuario está activo y las credenciales son correctas
            return redirect()->intended($this->redirectPath());
        }

        // Aquí puedes manejar el error como prefieras, por ejemplo:
        return back()->withErrors([
            'email' => 'The credentials provided do not match our records or the account is inactive.',
        ]);
    }
}
