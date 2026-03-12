<form method="POST" action="{{ route('login') }}">
@csrf

<input type="email" name="email" placeholder="Correo electrónico" required>

<input type="password" name="password" placeholder="Contraseña" required>

<button type="submit">Iniciar sesión</button>

</form>

<a href="{{ route('login.google') }}">Iniciar sesión con Google</a>

<p>
¿No tienes cuenta?
<a">Registrarme</a>
</p>