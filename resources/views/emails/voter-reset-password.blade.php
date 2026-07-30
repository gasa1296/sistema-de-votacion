<x-mail::message>
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
