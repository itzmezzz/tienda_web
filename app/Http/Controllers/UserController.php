<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Carrito; 
use App\Models\Producto; 
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('welcome');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            if (!$user->hasVerifiedEmail()) {
                Auth::logout();
                return redirect('/email/verify')->withErrors([
                    'email' => 'Debes verificar tu correo antes de iniciar sesión'
                ]);
            }

            // Sincronizar carrito al iniciar sesión tradicional
            $this->sincronizarCarrito($user);

            return redirect($user->rol == 0 ? '/dashboard' : '/tienda');
        }

        return back()->withErrors([
            'email' => 'Correo o contraseña incorrecta',
        ]);
    }

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

        try {
            $user->sendEmailVerificationNotification();
        } catch (\Exception $e) {
            Log::error("Error SMTP: " . $e->getMessage());
            Auth::login($user);
            return redirect('/email/verify')->withErrors([
                'email' => 'El usuario se creó pero no pudimos enviar el correo. Revisa tu configuración SMTP.'
            ]);
        }

        Auth::login($user);
        return redirect('/email/verify');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['email' => 'Hubo un problema al autenticar con Google.']);
        }

        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'rol' => 1,
                'estatus' => 'A',
                'email_verified_at' => now(), 
            ]
        );

        Auth::login($user);
        
        // Sincronizar carrito al iniciar sesión con Google
        $this->sincronizarCarrito($user);

        return redirect($user->rol == 0 ? '/dashboard' : '/tienda');
    }

    // Método de sincronización (FUERA de handleGoogleCallback)
    private function sincronizarCarrito($user) 
    {
        $carritoBD = Carrito::where('id_usuario', $user->id)
                            ->where('estado', 'activo')
                            ->with('detalles.producto') 
                            ->first();

        if ($carritoBD) {
            $carritoSesion = [];
            foreach ($carritoBD->detalles as $detalle) {
                $prod = $detalle->producto;
                // Verificamos que el producto exista para evitar errores
                if ($prod) {
                    $carritoSesion[$prod->id] = [
                        'id' => $prod->id,
                        'nombre' => $prod->nombre,
                        'precio' => $prod->precio,
                        'imagen' => asset('productos/' . $prod->imagen),
                        'numero_tomo' => $prod->numero_tomo,
                        'cantidad' => $detalle->cantidad
                    ];
                }
            }
            session()->put('carrito', $carritoSesion);
        }
    }
}