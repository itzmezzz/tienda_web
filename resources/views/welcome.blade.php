<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Manga House</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* RESET & BASE */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #121212;
            padding: 20px;
            color: #e2e2e2;
        }

        /* CARD PRINCIPAL */
        .card {
            position: relative;
            background-color: #1a1a1a;
            width: 100%;
            max-width: 450px;
            padding: 48px;
            border: 1px solid #2d2d2d;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
            animation: fadeIn 0.6s ease-out forwards;
        }

        .brand-line {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, #ff4d4d, #b33939);
        }

        header {
            text-align: center;
            margin-bottom: 32px;
        }

        .subtitle {
            font-size: 11px;
            font-weight: 900;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            display: block;
            margin-bottom: 8px;
        }

        h1 {
            font-size: 38px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: -0.025em;
        }

        /* FORMULARIO */
        .form-group {
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            background-color: #242424;
            border: 1px solid #333;
            padding: 14px 16px;
            color: #fff;
            font-size: 15px;
            transition: all 0.2s ease;
        }

        input:focus {
            outline: none;
            border-color: #ff4d4d;
            background-color: #2a2a2a;
        }

        /* BOTÓN PRINCIPAL */
        .btn-login {
            width: 100%;
            background-color: #ff4d4d;
            color: #ffffff;
            padding: 16px;
            border: none;
            font-size: 14px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            background-color: #ff1a1a;
            transform: translateY(-1px);
        }

        /* GOOGLE LOGIN */
        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 30px 0;
            color: #444;
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .separator::before, .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #2d2d2d;
        }

        .separator:not(:empty)::before { margin-right: 1em; }
        .separator:not(:empty)::after { margin-left: 1em; }

        .btn-google {
            width: 100%;
            background-color: transparent;
            border: 1px solid #333;
            color: #ccc;
            padding: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .btn-google:hover {
            background-color: #242424;
            border-color: #444;
            color: #fff;
        }

        /* FOOTER & LINKS */
        .card-footer {
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #2d2d2d;
            text-align: center;
            font-size: 14px;
            color: #666;
        }

        .link-alt {
            color: #ff4d4d;
            text-decoration: none;
            font-weight: 700;
            margin-left: 5px;
        }

        .link-alt:hover {
            text-decoration: underline;
        }

        /* ALERTAS BACKEND */
        .alert-error {
            background: rgba(251, 113, 133, 0.1);
            border: 1px solid rgba(251, 113, 133, 0.2);
            color: #fb7185;
            padding: 12px;
            font-size: 12px;
            margin-bottom: 20px;
            text-align: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 480px) {
            .card { padding: 32px 24px; min-height: 100vh; border: none; }
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="brand-line"></div>
        
        <header>
            <span class="subtitle">Bienvenido de nuevo</span>
            <h1>Manga House</h1>
        </header>

        @if ($errors->any())
            <div class="alert-error">
                <i class="fas fa-exclamation-circle mr-1"></i> 
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <div class="form-group">
                <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Contraseña" required>
            </div>

            <button type="submit" class="btn-login">
                Iniciar sesión
            </button>
        </form>

        <div class="separator">O ingresa con</div>

        <a href="{{ route('google.login') }}" class="btn-google">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20" height="20">
                <path fill="#EA4335" d="M24 9.5c3.4 0 6.4 1.2 8.8 3.2l6.6-6.6C35.7 2.3 30.2 0 24 0 14.6 0 6.6 5.4 2.7 13.3l7.7 6C12.1 13.3 17.6 9.5 24 9.5z"/>
                <path fill="#4285F4" d="M46.1 24.5c0-1.6-.1-2.7-.4-3.9H24v7.3h12.7c-.3 1.8-1.7 4.5-4.8 6.3l7.4 5.8c4.3-4 6.8-9.8 6.8-15.5z"/>
                <path fill="#FBBC05" d="M10.4 28.6c-.5-1.4-.8-2.9-.8-4.6s.3-3.2.8-4.6l-7.7-6C1 16.7 0 20.2 0 24s1 7.3 2.7 10.6l7.7-6z"/>
                <path fill="#34A853" d="M24 48c6.2 0 11.4-2 15.2-5.5l-7.4-5.8c-2 1.4-4.7 2.4-7.8 2.4-6.4 0-11.9-3.8-13.9-9.3l-7.7 6C6.6 42.6 14.6 48 24 48z"/>
            </svg>
            Google
        </a>

        <div class="card-footer">
            ¿No tienes cuenta? 
            <a href="{{ route('register.form') }}" class="link-alt">Registrarme</a>
        </div>
    </div>

</body>
</html>