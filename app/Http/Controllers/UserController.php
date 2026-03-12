<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{

     // Mostrar formulario de login
     function showLoginForm()
    {
        return view('auth.login'); // resources/views/auth/login.blade.php
    }

    // Procesar login tradicional
     function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard'); // ruta protegida
        }

        return back()->withErrors([
            'email' => 'Correo o contraseña incorrecta',
        ]);
    }

    // Cerrar sesión
     function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Redirigir a Google
     function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback de Google
    function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            ['name' => $googleUser->getName(),
            'google_id' => $googleUser->getId(),
            'rol' => 1 // cliente por defecto
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
}
