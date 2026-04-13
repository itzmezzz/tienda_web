<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // formulario de login
    function showLoginForm()
    {
        return view('auth.login');
    }

    //Login tradicional
    function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            //VALIDAR SI VERIFICÓ EMAIL
            if (!Auth::user()->hasVerifiedEmail()) {
                Auth::logout();

                return redirect('/email/verify')->withErrors([
                    'email' => 'Debes verificar tu correo antes de iniciar sesión'
                ]);
            }

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Correo o contraseña incorrecta',
        ]);
    }

    //Registro tradicional
    function register(Request $request)
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

        // AQUÍ SE ENVÍA EL CORREO
        $user->sendEmailVerificationNotification();

        //logear usuario
        Auth::login($user);

        return redirect('/email/verify');
    }

    //Logout
    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    // Google
    function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'rol' => 1
            ]
        );

        Auth::login($user);
        if($user == '0'){
            return redirect('/dashboard');
        }else{}

        return redirect('/tienda');
    }
}