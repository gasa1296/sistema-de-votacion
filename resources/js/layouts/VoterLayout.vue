<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import VoterTopBar from '../components/VoterTopBar.vue';

const page = usePage();
const electionName = computed(
    () =>
        (page.props.election as { name?: string } | undefined)?.name ??
        'Sistema de Votación',
);
</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <VoterTopBar />

        <main
            class="mx-auto max-w-6xl px-4 py-8 sm:px-6 sm:py-10 lg:px-8 lg:py-12"
        >
            <slot />
        </main>

        <footer
            class="border-t border-gray-200 bg-white py-6"
        >
            <p class="text-center text-xs text-gray-500">
                © {{ new Date().getFullYear() }} {{ electionName }}. Todos los
                derechos reservados.
            </p>
        </footer>
    </div>
</template>
