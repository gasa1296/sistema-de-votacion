<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import StatusPage from '@/components/Voter/StatusPage.vue';
</script>

<template>
    <StatusPage
        tone="info"
        icon="info"
        title="Ya has votado"
        description="Has emitido tu voto en esta elección. Cada votante solo puede votar una vez."
        note="Si crees que hubo un problema con tu voto, contacta al administrador de la elección."
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
