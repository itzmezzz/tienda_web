<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Login tradicional
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            // VALIDAR SI VERIFICÓ EMAIL
            if (!$user->hasVerifiedEmail()) {
                Auth::logout();
                return redirect('/email/verify')->withErrors([
                    'email' => 'Debes verificar tu correo antes de iniciar sesión'
                ]);
            }

            // Redirección según rol: 0 -> Dashboard, 1 -> Tienda
            return redirect($user->rol == 0 ? '/dashboard' : '/tienda');
        }

        return back()->withErrors([
            'email' => 'Correo o contraseña incorrecta',
        ]);
    }

    // Registro tradicional
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol' => 1,
            'estatus' => 'A'
        ]);

        // Envío de correo de verificación
        $user->sendEmailVerificationNotification();

        // Loguear usuario temporalmente para que vea la vista de verificación
        Auth::login($user);

        return redirect('/email/verify');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Google Redirect
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google Callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['email' => 'Hubo un problema al autenticar con Google.']);
        }

        // Buscamos el usuario o lo creamos
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'rol' => 1, // Por defecto cliente
                'estatus' => 'A',
                'email_verified_at' => now(), // Al venir de Google, el email ya es válido
            ]
        );

        Auth::login($user);

        // Redirección según rol: 0 -> Dashboard, 1 -> Tienda
        return redirect($user->rol == 0 ? '/dashboard' : '/tienda');
    }
}