<x-mail::message>
# Voto registrado

Hola {{ $name }} {{ $lastName ?? '' }},

Tu voto en la elección **{{ $electionName }}** fue registrado correctamente.

<x-mail::panel>
**Candidato:** {{ $candidateName }}

**Cargo:** {{ $position }}

**Fecha:** {{ $votedAt }}
</x-mail::panel>

<x-mail::panel :color="'success'">
Tu voto es confidencial. Este correo es solo una confirmación de que fue emitido.
</x-mail::panel>

Gracias por participar,<br>
{{ config('app.name') }}
</x-mail::message>
