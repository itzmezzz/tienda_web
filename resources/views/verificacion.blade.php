<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Correo | MangaHouse</title>
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
            background-color: #121212; /* Fondo oscuro para no cansar la vista */
            padding: 20px;
            color: #e2e2e2;
        }

        /* CARD PRINCIPAL */
        .card {
            position: relative;
            background-color: #1a1a1a;
            width: 100%;
            max-width: 450px;
            min-height: 520px;
            padding: 48px;
            border: 1px solid #2d2d2d;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
            text-align: center;
            display: flex;
            flex-direction: flex-col;
            flex-direction: column;
            animation: fadeIn 0.6s ease-out forwards;
        }

        /* LÍNEA DE MARCA SUPERIOR */
        .brand-line {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, #ff4d4d, #b33939);
        }

        h1 {
            font-size: 40px;
            font-weight: 800;
            margin: 16px 0 32px 0;
            color: #ffffff;
            letter-spacing: -0.025em;
        }

        .icon-container {
            font-size: 48px;
            margin-bottom: 32px;
            color: #ff4d4d;
            filter: drop-shadow(0 0 8px rgba(255, 77, 77, 0.3));
        }

        p {
            font-size: 15px;
            line-height: 1.6;
            color: #a0a0a0;
            margin-bottom: 40px;
        }

        p span {
            color: #ffffff;
            font-weight: 700;
            font-style: italic;
        }

        /* MENSAJES DE BACKEND (LARAVEL) */
        .status-box {
            min-height: 40px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .alert-success {
            color: #34d399;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            background: rgba(52, 211, 153, 0.1);
            padding: 6px 16px;
            border: 1px solid rgba(52, 211, 153, 0.2);
        }

        .alert-error {
            color: #fb7185;
            font-size: 11px;
            font-weight: 900;
            text-transform: uppercase;
            background: rgba(251, 113, 133, 0.1);
            padding: 6px 16px;
            border: 1px solid rgba(251, 113, 133, 0.2);
        }

        /* FOOTER DE LA CARD */
        .footer-actions {
            margin-top: auto;
            padding-top: 32px;
            border-top: 1px solid #2d2d2d;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
        }

        /* BOTÓN REENVIAR */
        .btn-send {
            background-color: #ff4d4d;
            color: #ffffff;
            padding: 14px 32px;
            border: none;
            font-size: 13px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.3);
        }

        .btn-send:hover {
            background-color: #ff1a1a;
            transform: translateY(-1px);
        }

        .btn-send:active {
            transform: scale(0.95);
        }

        /* LINKS SECUNDARIOS */
        .secondary-links {
            text-align: right;
        }

        .label-no-llego {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #555555;
            margin-bottom: 4px;
        }

        .link-nav {
            font-size: 13px;
            color: #cccccc;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .link-nav:hover {
            color: #ff4d4d;
        }

        .btn-logout {
            background: none;
            border: none;
            color: #666666;
            font-size: 11px;
            text-decoration: underline;
            text-underline-offset: 4px;
            cursor: pointer;
            margin-top: 12px;
            transition: color 0.2s;
        }

        .btn-logout:hover {
            color: #ffffff;
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
        
        <h1>Verificar</h1>

        <div class="icon-container">
            <i class="fa-solid fa-envelope-circle-check"></i>
        </div>

        <p>
            Hemos enviado un enlace de confirmación. <br>
            Revísalo para activar tu acceso a <span>MangaHouse</span>.
        </p>

        <div class="status-box">
            @if (session('status') == 'verification-link-sent')
                <div class="alert-success">✔ Enlace enviado</div>
            @endif

            @if ($errors->any())
                <div class="alert-error">{{ $errors->first() }}</div>
            @endif
        </div>

        <div class="footer-actions">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="btn-send">Reenviar</button>
            </form>

            <div class="secondary-links">
                <span class="label-no-llego">¿No llegó?</span>
                <a href="{{ url('/') }}" class="link-nav">Volver al inicio</a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">¿Cerrar sesión?</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>