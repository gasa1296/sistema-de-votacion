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
            <Link
                href="/logout"
                method="post"
                as="button"
                class="btn-primary w-full sm:w-auto"
            >
                Cerrar sesión
            </Link>
        </template>
    </StatusPage>
</template>
