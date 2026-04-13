<h1>Verifica tu correo</h1>
<p>Te enviamos un enlace, revisa tu email.</p>

@if ($errors->any())
    <p style="color:red">{{ $errors->first() }}</p>
@endif

<form method="POST" action="{{ route('verification.send') }}">
    @csrf
    <button type="submit">Reenviar correo</button>
</form>