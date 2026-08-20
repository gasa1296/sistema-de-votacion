@php
    try {
        $logoSrc = $message->embed(public_path(config('app.logo')));
    } catch (\Throwable $e) {
        $logoSrc = asset(config('app.logo'));
    }
@endphp

<x-mail::message>
<div align="center" style="text-align: center; margin-bottom: 24px;">
    <img src="{{ $logoSrc }}" alt="{{ config('app.name') }}" width="80" style="display: block; margin: 0 auto; max-width: 80px; height: auto;" />
</div>

# Restablece tu contraseña

Hola **{{ $name }}**,

Recibimos una solicitud para restablecer la contraseña de tu cuenta de votación.

Haz clic en el botón de abajo para crear una nueva contraseña:

<x-mail::button :url="$resetUrl">
Restablecer contraseña
</x-mail::button>

Si no solicitaste este cambio, puedes ignorar este mensaje.

Saludos,<br>
{{ config('app.name') }}
</x-mail::message>
