<script setup lang="ts">
import StatusPage from '@/components/Voter/StatusPage.vue';
</script>

<template>
    <StatusPage
        tone="warning"
        icon="clock"
        title="Elección no disponible"
        description="La elección aún no ha comenzado. Por favor, espera a que se abra el periodo de votación."
        note="Te notificaremos por correo electrónico cuando la votación esté disponible."
    />
</template>
