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

