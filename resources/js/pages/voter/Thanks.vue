<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import StatusPage from '@/components/Voter/StatusPage.vue';
</script>

<template>
    <StatusPage
        tone="success"
        icon="check"
        title="¡Gracias por votar!"
        description="Tu voto ha sido registrado exitosamente. Tu participación es importante para nosotros."
        note="Recibirás una confirmación en tu correo electrónico."
    >
        <template #actions>
            <Link href="/resultados" class="btn-primary w-full sm:w-auto">
                Ver resultados
                <svg
                    class="h-4 w-4"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <polyline points="12 5 19 12 12 19" />
                </svg>
            </Link>
        </template>
    </StatusPage>
</template>
