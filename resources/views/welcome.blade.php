<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión | Manga House</title>
    
    <link rel="stylesheet" href="{{ asset('src/output.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="min-h-screen flex items-center justify-center bg-[#0a0a0a] bg-[url('/src/manga-bg.png')] bg-fixed bg-cover bg-blend-multiply py-10 px-4">

    <div class="bg-black/90 w-full max-w-[450px] border-2 border-orange-600 p-8 md:p-12 shadow-[0_0_25px_rgba(234,88,12,0.3)] backdrop-blur-sm relative">
        
        <div class="absolute top-0 left-0 w-full h-1 bg-orange-600"></div>

        <header class="text-center mb-10">
            <span class="text-[10px] font-black text-zinc-500 tracking-[0.4em] uppercase mb-2 block">Bienvenido de nuevo</span>
            <h1 class="text-4xl font-black text-white tracking-tighter italic uppercase">Manga <span class="text-orange-600">House</span></h1>
            <div class="h-1 w-16 bg-orange-600 mx-auto mt-3"></div>
        </header>

        @if ($errors->any())
            <div class="bg-red-900/20 border border-red-500 text-red-500 px-4 py-3 text-xs font-bold mb-6 text-center uppercase tracking-widest">
                <i class="fas fa-exclamation-circle mr-3"></i> 
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            
            <div class="form-group">
                <label class="block text-[12px] font-black text-orange-600 uppercase tracking-widest mb-2 ml-1">Iniciar sesion</label>
                <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required autofocus
                    style="text-transform: none !important; letter-spacing: normal !important;"
                    class="w-full bg-zinc-900 border border-zinc-800 p-4 rounded-sm text-white text-sm focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition placeholder:text-zinc-700 font-medium">
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Contraseña" required
                    style="text-transform: none !important; letter-spacing: normal !important;"
                    class="w-full bg-zinc-900 border border-zinc-800 p-4 rounded-sm text-white text-sm focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition placeholder:text-zinc-700 font-medium">
            </div>

            <button type="submit" class="w-full bg-orange-600 text-black font-black py-4 uppercase tracking-[0.2em] text-sm hover:bg-white transition-all duration-300 shadow-lg active:scale-95">
                Iniciar Sesión
            </button>
        </form>

        <div class="relative my-10">
            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-zinc-800"></div></div>
            <div class="relative flex justify-center text-[10px] uppercase"><span class="bg-black px-4 text-zinc-500 font-black tracking-widest">Acceso Rápido</span></div>
        </div>

        <a href="{{ route('google.login') }}" class="flex items-center justify-center gap-3 w-full border border-zinc-800 bg-zinc-900/50 px-4 py-3 hover:bg-zinc-800 hover:border-zinc-700 transition-all duration-300 group">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20" height="20">
                <path fill="#EA4335" d="M24 9.5c3.4 0 6.4 1.2 8.8 3.2l6.6-6.6C35.7 2.3 30.2 0 24 0 14.6 0 6.6 5.4 2.7 13.3l7.7 6C12.1 13.3 17.6 9.5 24 9.5z"/>
                <path fill="#4285F4" d="M46.1 24.5c0-1.6-.1-2.7-.4-3.9H24v7.3h12.7c-.3 1.8-1.7 4.5-4.8 6.3l7.4 5.8c4.3-4 6.8-9.8 6.8-15.5z"/>
                <path fill="#FBBC05" d="M10.4 28.6c-.5-1.4-.8-2.9-.8-4.6s.3-3.2.8-4.6l-7.7-6C1 16.7 0 20.2 0 24s1 7.3 2.7 10.6l7.7-6z"/>
                <path fill="#34A853" d="M24 48c6.2 0 11.4-2 15.2-5.5l-7.4-5.8c-2 1.4-4.7 2.4-7.8 2.4-6.4 0-11.9-3.8-13.9-9.3l-7.7 6C6.6 42.6 14.6 48 24 48z"/>
            </svg>
            <span class="font-black text-[10px] text-white uppercase tracking-widest group-hover:text-orange-500 transition-colors">Entrar con Google</span>
        </a>

        <div class="mt-10 pt-6 border-t border-zinc-900 text-center text-[13px] font-bold text-zinc-500 uppercase tracking-tighter">
            ¿Aún no tienes cuenta? 
            <a href="{{ route('register.form') }}" class="text-orange-500 hover:text-white transition-colors underline decoration-2 underline-offset-2 ml-2">REGISTRARME</a>
        </div>
    </div>

</body>
</html>