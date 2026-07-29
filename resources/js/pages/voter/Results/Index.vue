<script setup lang="ts">
import { Link, usePoll } from '@inertiajs/vue3';
import { computed } from 'vue';

interface ResultItem {
    name: string;
    votes: number;
    percentage: number;
    photo_path?: string;
    position: string;
}

const props = defineProps<{
    election: { id: number; name: string; status: string };
    results: ResultItem[];
}>();

const maxVotes = computed(() =>
    Math.max(...props.results.map((r) => r.votes), 1),
);

usePoll(5000, { only: ['results'] });
</script>

<template>
    <div class="mx-auto max-w-2xl space-y-8 px-4 py-10 sm:px-6 sm:py-16">
        <!-- Header -->
        <div class="text-center">
            <div
                class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-linear-to-br from-brand-500 to-brand-700 text-white shadow-lg shadow-brand-500/20"
            >
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="18" y1="20" x2="18" y2="10" />
                    <line x1="12" y1="20" x2="12" y2="4" />
                    <line x1="6" y1="20" x2="6" y2="14" />
                </svg>
            </div>
            <h1 class="mt-5 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                Resultados de la Elección
            </h1>
            <p class="mt-2 text-sm text-gray-500">
                {{ election.name }}
            </p>
            <span
                class="mt-3 inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold"
                :class="election.status === 'open' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600'"
            >
                {{ election.status === 'open' ? 'En curso' : 'Finalizada' }}
            </span>
        </div>

        <!-- Results Chart -->
        <div class="space-y-4">
            <div
                v-for="item in results"
                :key="item.name"
                class="rounded-2xl border border-gray-200/80 bg-white p-5 shadow-sm"
            >
                <div class="flex items-center justify-between gap-3">
                    <div class="flex items-center gap-3 min-w-0">
                        <img
                            v-if="item.photo_path"
                            :src="`/storage/${item.photo_path}`"
                            :alt="item.name"
                            class="h-10 w-10 shrink-0 rounded-xl object-cover ring-2 ring-gray-100"
                        />
                        <div class="min-w-0">
                            <p class="truncate font-bold text-gray-900">
                                {{ item.name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ item.position }}
                            </p>
                        </div>
                    </div>
                    <span class="shrink-0 text-sm font-semibold text-gray-700">
                        {{ item.votes }} votos
                    </span>
                </div>
                <div class="mt-3 h-3 w-full overflow-hidden rounded-full bg-gray-100">
                    <div
                        class="h-full rounded-full bg-linear-to-r from-brand-400 to-brand-600 transition-all duration-700"
                        :style="{ width: `${(item.votes / maxVotes) * 100}%` }"
                    />
                </div>
                <p class="mt-1.5 text-right text-xs font-semibold text-brand-600">
                    {{ item.percentage }}%
                </p>
            </div>
        </div>

        <!-- Back link -->
        <div class="text-center">
            <Link href="/" class="btn-secondary">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="19" y1="12" x2="5" y2="12" />
                    <polyline points="12 19 5 12 12 5" />
                </svg>
                Volver a la votación
            </Link>
        </div>
    </div>
</template>
