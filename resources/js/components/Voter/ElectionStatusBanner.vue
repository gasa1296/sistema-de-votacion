<script setup lang="ts">
import { computed } from 'vue';
import type { Election } from '@/types';

const props = defineProps<{
    election: Election;
    hasVoted: boolean;
}>();

type Status = 'open' | 'voted' | 'pending' | 'closed';

const status = computed<Status>(() => {
    if (props.election.status === 'open') {
        return props.hasVoted ? 'voted' : 'open';
    }

    return props.election.status === 'pending' ? 'pending' : 'closed';
});

const config = computed(() => {
    switch (status.value) {
        case 'open':
            return {
                container:
                    'bg-emerald-50/80 border-emerald-200/80 backdrop-blur-md shadow-sm dark:bg-emerald-950/40 dark:border-emerald-800/60',
                badge: 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/60 dark:text-emerald-300',
                dot: 'bg-emerald-500',
                title: 'text-emerald-950 dark:text-emerald-50',
                subtitle: 'text-emerald-700 dark:text-emerald-300',
                message: 'Elección abierta — Selecciona tu candidato',
                label: 'En curso',
            };
        case 'voted':
            return {
                container:
                    'bg-brand-50/80 border-brand-200/80 backdrop-blur-md shadow-sm dark:bg-brand-950/40 dark:border-brand-800/60',
                badge: 'bg-brand-100 text-brand-700 dark:bg-brand-900/60 dark:text-brand-300',
                dot: 'bg-brand-500',
                title: 'text-brand-950 dark:text-brand-50',
                subtitle: 'text-brand-700 dark:text-brand-300',
                message: 'Tu voto ha sido procesado e ingresado correctamente',
                label: 'Voto registrado',
            };
        case 'pending':
            return {
                container:
                    'bg-amber-50/80 border-amber-200/80 backdrop-blur-md shadow-sm dark:bg-amber-950/40 dark:border-amber-800/60',
                badge: 'bg-amber-100 text-amber-700 dark:bg-amber-900/60 dark:text-amber-300',
                dot: 'bg-amber-500',
                title: 'text-amber-950 dark:text-amber-50',
                subtitle: 'text-amber-700 dark:text-amber-300',
                message: 'La votación iniciará según el cronograma programado',
                label: 'Próximamente',
            };
        case 'closed':
        default:
            return {
                container:
                    'bg-gray-100/80 border-gray-200/80 backdrop-blur-md shadow-sm dark:bg-gray-900/60 dark:border-gray-800',
                badge: 'bg-gray-200 text-gray-700 dark:bg-gray-800 dark:text-gray-300',
                dot: 'bg-gray-500',
                title: 'text-gray-900 dark:text-gray-100',
                subtitle: 'text-gray-600 dark:text-gray-400',
                message: 'La elección ha finalizado y se ha cerrado la recepción de votos',
                label: 'Finalizada',
            };
    }
});
</script>

<template>
    <div
        class="flex items-center gap-4 rounded-2xl border p-4 transition-all duration-300 sm:p-5 m-4"
        :class="config.container"
        role="status"
    >
        <div
            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl shadow-xs"
            :class="config.badge"
        >
            <span class="relative flex h-3 w-3">
                <span
                    v-if="status === 'open'"
                    class="absolute inline-flex h-full w-full animate-ping rounded-full opacity-75"
                    :class="config.dot"
                />
                <span
                    class="relative inline-flex h-3 w-3 rounded-full"
                    :class="config.dot"
                />
            </span>
        </div>

        <div class="min-w-0 flex-1">
            <div class="flex flex-wrap items-center gap-2.5">
                <h3
                    class="text-base font-bold tracking-tight sm:text-lg"
                    :class="config.title"
                >
                    {{ election.name }}
                </h3>
                <span
                    class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold"
                    :class="config.badge"
                >
                    {{ config.label }}
                </span>
            </div>
            <p class="mt-0.5 text-xs sm:text-sm" :class="config.subtitle">
                {{ config.message }}
            </p>
        </div>
    </div>
</template>

