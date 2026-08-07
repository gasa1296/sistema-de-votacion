<script setup lang="ts">
import { Link, usePoll } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import VoterTopBar from '@/components/VoterTopBar.vue';

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
    turnout: { total_voters: number; total_votes: number; percentage: number };
}>();

const lastUpdated = ref(new Date().toLocaleTimeString('es-ES', {
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
}));

const maxVotes = computed(() =>
    Math.max(...props.results.map((r) => r.votes), 1),
);

const barColors = [
    { bar: 'bg-[#1e3a5f]', badge: 'bg-[#1e3a5f]/10 text-[#1e3a5f]' },
    { bar: 'bg-amber-500', badge: 'bg-amber-50 text-amber-700' },
    { bar: 'bg-emerald-500', badge: 'bg-emerald-50 text-emerald-700' },
    { bar: 'bg-rose-500', badge: 'bg-rose-50 text-rose-700' },
    { bar: 'bg-violet-500', badge: 'bg-violet-50 text-violet-700' },
    { bar: 'bg-gray-400', badge: 'bg-gray-100 text-gray-600' },
];

function getColor(index: number) {
    return barColors[index % barColors.length];
}

usePoll(5000, {
    only: ['results', 'turnout'],
    onFinish: () => {
        lastUpdated.value = new Date().toLocaleTimeString('es-ES', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
        });
    },
});
</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <VoterTopBar />

        <div class="mx-auto max-w-2xl px-4 py-6">
            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center gap-2">
                    <h1 class="text-xl font-bold text-gray-900">
                        Resultados en tiempo real
                    </h1>
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 4 23 10 17 10" />
                        <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10" />
                    </svg>
                </div>
                <p class="mt-1 text-sm text-gray-500">
                    Actualizado: {{ lastUpdated }}
                </p>
            </div>

            <!-- Stats Cards -->
            <div class="mb-6 grid grid-cols-2 gap-4">
                <!-- Participación -->
                <div class="rounded-2xl border border-gray-200 bg-white p-4 text-center shadow-sm">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-[#1e3a5f]/10 text-[#1e3a5f]">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <p class="mt-3 text-3xl font-bold text-gray-900">
                        {{ turnout.percentage }}%
                    </p>
                    <p class="mt-1 text-xs font-medium text-gray-500">
                        Participación
                    </p>
                    <p class="text-xs text-gray-400">
                        {{ turnout.total_votes }} de {{ turnout.total_voters.toLocaleString() }}
                    </p>
                </div>
                <!-- Votos emitidos -->
                <div class="rounded-2xl border border-gray-200 bg-white p-4 text-center shadow-sm">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-[#1e3a5f]/10 text-[#1e3a5f]">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 11l3 3L22 4M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                        </svg>
                    </div>
                    <p class="mt-3 text-3xl font-bold text-gray-900">
                        {{ turnout.total_votes }}
                    </p>
                    <p class="mt-1 text-xs font-medium text-gray-500">
                        Votos emitidos
                    </p>
                    <p class="text-xs text-gray-400">
                        de {{ turnout.total_voters.toLocaleString() }}
                    </p>
                </div>
            </div>

            <!-- Votes by Candidate -->
            <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm">
                <h2 class="mb-4 text-base font-bold text-gray-900">
                    Votos por candidato
                </h2>
                <div class="space-y-4">
                    <div
                        v-for="(item, index) in results"
                        :key="item.name"
                    >
                        <div class="flex items-center gap-3">
                            <!-- Photo -->
                            <img
                                v-if="item.photo_path"
                                :src="`/storage/${item.photo_path}`"
                                :alt="item.name"
                                class="h-10 w-10 shrink-0 rounded-xl object-cover"
                            />
                            <div
                                v-else
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-[#1e3a5f] to-[#2d5a8e] text-sm font-bold text-white"
                            >
                                {{ item.name.charAt(0) }}
                            </div>

                            <!-- Name & Bar -->
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center justify-between gap-2">
                                    <p class="truncate text-sm font-semibold text-gray-900">
                                        {{ item.name }}
                                    </p>
                                </div>
                                <div class="mt-1.5 h-3 w-full overflow-hidden rounded-full bg-gray-100">
                                    <div
                                        class="h-full rounded-full transition-all duration-700"
                                        :class="getColor(index).bar"
                                        :style="{ width: `${(item.votes / maxVotes) * 100}%` }"
                                    />
                                </div>
                                <div class="mt-1.5 flex items-center justify-between">
                                    <!-- Vote count badge -->
                                    <span
                                        class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-bold"
                                        :class="getColor(index).badge"
                                    >
                                        {{ item.votes }}
                                    </span>
                                    <span class="text-sm font-bold text-gray-900">
                                        {{ item.percentage }}%
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Auto-refresh Note -->
            <div class="mt-4 flex items-center justify-center gap-2 text-xs text-gray-500">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="23 4 23 10 17 10" />
                    <path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10" />
                </svg>
                Los resultados se actualizarán automáticamente cada 15 segundos.
            </div>

            <!-- Back Link -->
            <div class="mt-6 text-center">
                <Link href="/" class="inline-flex items-center gap-2 text-sm font-semibold text-[#1e3a5f] hover:underline">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="19" y1="12" x2="5" y2="12" />
                        <polyline points="12 19 5 12 12 5" />
                    </svg>
                    Volver a la votación
                </Link>
            </div>
        </div>
    </div>
</template>
