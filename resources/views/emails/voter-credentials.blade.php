<x-mail::message>
# Credenciales de Votación

Hola {{ $name }} {{ $lastName ?? '' }},

Has sido habilitado para votar en la elección: **{{ $electionName }}**

<x-mail::panel>
**Email:** {{ $email }}

**Contraseña temporal:** `{{ $password }}`

**Código de votante:** `{{ $voterCode }}`
</x-mail::panel>

<x-mail::panel :color="'danger'">
**Importante:** Debes cambiar tu contraseña después de iniciar sesión por primera vez.
</x-mail::panel>

Gracias,<br>
{{ config('app.name') }}
</x-mail::message>
