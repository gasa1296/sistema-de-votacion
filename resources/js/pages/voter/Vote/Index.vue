<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import CandidateCard from '@/components/Voter/CandidateCard.vue';
import ConfirmVoteDialog from '@/components/Voter/ConfirmVoteDialog.vue';
import ElectionStatusBanner from '@/components/Voter/ElectionStatusBanner.vue';
import VoterTopBar from '@/components/VoterTopBar.vue';
import type { Candidate, Election, Turnout, User } from '../../../types';

interface ResultItem {
    name: string;
    votes: number;
    percentage: number;
}

const props = defineProps<{
    election: Election;
    candidates: Candidate[];
    hasVoted: boolean;
    user: User;
    turnout: Turnout;
    results?: ResultItem[];
}>();

const maxVotes = computed(() =>
    Math.max(...(props.results ?? []).map((r) => r.votes), 1),
);

const selectedCandidate = ref<Candidate | null>(null);
const showConfirmDialog = ref(false);
const searchQuery = ref('');
const selectedPosition = ref<string>('all');

const uniquePositions = computed(() => {
    const positions = new Set(
        props.candidates.map((c) => c.position).filter(Boolean),
    );

    return Array.from(positions);
});

const filteredCandidates = computed(() => {
    return props.candidates.filter((candidate) => {
        const full = `${candidate.name} ${candidate.last_name ?? ''} ${candidate.position ?? ''} ${candidate.description ?? ''}`.toLowerCase();
        const matchesSearch =
            searchQuery.value.trim() === '' ||
            full.includes(searchQuery.value.toLowerCase().trim());
        const matchesPosition =
            selectedPosition.value === 'all' ||
            candidate.position === selectedPosition.value;

        return matchesSearch && matchesPosition;
    });
});

function selectCandidate(candidate: Candidate) {
    selectedCandidate.value = candidate;
    showConfirmDialog.value = true;
}

function closeDialog() {
    selectedCandidate.value = null;
    showConfirmDialog.value = false;
}

function clearFilters() {
    searchQuery.value = '';
    selectedPosition.value = 'all';
}
</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <VoterTopBar />

        <div class="space-y-8">

        <!-- User Welcome Hero Card -->
        <div
            class="relative overflow-hidden rounded-3xl border border-gray-200/80 bg-linear-to-br from-white via-brand-50/20 to-indigo-50/40 p-6 shadow-sm sm:p-8 m-4"
        >
            <div
                class="absolute -top-12 -right-12 h-48 w-48 rounded-full bg-brand-400/10 blur-3xl"
            />
            <div
                class="relative flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between"
            >
                <div>
                    <div class="flex items-center gap-2 text-xs font-semibold text-brand-600">
                        <span class="inline-block h-2 w-2 rounded-full bg-brand-500" />
                        Portal de Votación Digital
                    </div>
                    <h1
                        class="mt-1 text-2xl font-black tracking-tight text-gray-900 sm:text-3xl"
                    >
                        Hola, {{ user.name }} {{ user.last_name ?? '' }} 👋
                    </h1>
                    <p class="mt-1 text-sm text-gray-600">
                        Bienvenido al proceso de votación oficial. Tu participación garantiza una decisión democrática y transparente.
                    </p>
                </div>

                <div class="flex shrink-0 flex-wrap items-center gap-2">
                    <div
                        class="inline-flex items-center gap-1.5 rounded-full border border-gray-200 bg-white/80 px-3 py-1.5 text-xs font-medium text-gray-700 shadow-xs backdrop-blur-md"
                    >
                        <svg
                            class="h-3.5 w-3.5 text-emerald-500"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2.5"
                        >
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                        </svg>
                        Voto 100% Confidencial
                    </div>
                </div>
            </div>
        </div>

        <!-- Election Status Header Banner -->
        <ElectionStatusBanner :election="election" :has-voted="hasVoted" />

        <!-- Election Turnout / Live Progress -->
        <div class="m-4">
            <div
                class="grid grid-cols-1 divide-y divide-gray-200 overflow-hidden rounded-2xl border border-gray-200/80 bg-white shadow-sm sm:grid-cols-3 sm:divide-x sm:divide-y-0"
            >
                <div class="p-4 sm:p-5">
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-500">
                        Votantes registrados
                    </p>
                    <p class="mt-1 text-2xl font-black text-gray-900">
                        {{ turnout.total_voters.toLocaleString() }}
                    </p>
                </div>
                <div class="p-4 sm:p-5">
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-500">
                        Votos emitidos
                    </p>
                    <p class="mt-1 text-2xl font-black text-gray-900">
                        {{ turnout.total_votes.toLocaleString() }}
                    </p>
                </div>
                <div class="p-4 sm:p-5">
                    <p class="text-xs font-medium uppercase tracking-wider text-gray-500">
                        Participación
                    </p>
                    <p class="mt-1 text-2xl font-black text-brand-600">
                        {{ turnout.percentage }}%
                    </p>
                    <div
                        class="mt-2 h-2 w-full overflow-hidden rounded-full bg-gray-100"
                    >
                        <div
                            class="h-full rounded-full bg-linear-to-r from-brand-400 to-brand-600 transition-all duration-700"
                            :style="{ width: `${Math.min(turnout.percentage, 100)}%` }"
                        />
                    </div>
                </div>
            </div>
        </div>

        <!-- State 1: User Has Voted -->
        <div v-if="hasVoted" class="mx-auto max-w-2xl space-y-6">
            <div
                class="relative overflow-hidden rounded-3xl border border-emerald-200/80 bg-linear-to-b from-emerald-50/90 to-white p-8 text-center shadow-lg sm:p-12"
            >
                <div
                    class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl bg-linear-to-br from-emerald-400 to-emerald-600 text-white shadow-lg shadow-emerald-500/20"
                >
                    <svg
                        class="h-10 w-10"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="3"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                </div>

                <h2
                    class="mt-6 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl"
                >
                    ¡Tu voto ha sido registrado!
                </h2>
                <p class="mx-auto mt-3 max-w-md text-sm leading-relaxed text-gray-600">
                    Gracias por formar parte de esta elección. Tu voto ha sido procesado de manera segura, anónima e inalterable.
                </p>

                <!-- Results Chart -->
                <div
                    v-if="results && results.length > 0"
                    class="mt-8 space-y-3 text-left"
                >
                    <h2
                        class="text-center text-sm font-semibold uppercase tracking-wider text-gray-500"
                    >
                        Resultados parciales
                    </h2>
                    <div
                        v-for="item in results"
                        :key="item.name"
                        class="rounded-xl border border-gray-100 bg-white p-3 shadow-xs"
                    >
                        <div class="flex items-center justify-between gap-2 text-sm">
                            <span class="truncate font-medium text-gray-900">
                                {{ item.name }}
                            </span>
                            <span class="shrink-0 text-xs font-semibold text-gray-500">
                                {{ item.votes }} votos ({{ item.percentage }}%)
                            </span>
                        </div>
                        <div class="mt-1.5 h-2.5 w-full overflow-hidden rounded-full bg-gray-100">
                            <div
                                class="h-full rounded-full bg-linear-to-r from-brand-400 to-brand-600 transition-all duration-700"
                                :style="{ width: `${(item.votes / maxVotes) * 100}%` }"
                            />
                        </div>
                    </div>
                </div>

                <div
                    class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row"
                >
                    <Link
                        href="/resultados"
                        class="btn-primary w-full shadow-md sm:w-auto"
                    >
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <line x1="18" y1="20" x2="18" y2="10" />
                            <line x1="12" y1="20" x2="12" y2="4" />
                            <line x1="6" y1="20" x2="6" y2="14" />
                        </svg>
                        Ver Resultados en Vivo
                    </Link>
                </div>
            </div>
        </div>

        <!-- State 2: Active Voting Mode -->
        <section v-else aria-labelledby="candidates-heading" class="space-y-6 m-4">
            <!-- Header and Filter Bar -->
            <div
                class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between"
            >
                <div>
                    <h2
                        id="candidates-heading"
                        class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl"
                    >
                        Selecciona tu candidato
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Explora las candidaturas y presiona "Votar" sobre la opción que elijas.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">

                    <!-- Position Filter dropdown if multiple positions exist -->
                    <div v-if="uniquePositions.length > 1">
                        <select
                            v-model="selectedPosition"
                            class="input cursor-pointer text-sm"
                        >
                            <option value="all">Todas las posiciones</option>
                            <option
                                v-for="pos in uniquePositions"
                                :key="pos"
                                :value="pos"
                            >
                                {{ pos }}
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Empty candidates in system -->
            <div
                v-if="candidates.length === 0"
                class="rounded-3xl border border-dashed border-gray-300 bg-white p-12 text-center shadow-xs"
            >
                <div
                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-gray-400"
                >
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                </div>
                <h3 class="mt-4 text-base font-bold text-gray-900">
                    No hay candidatos postulados
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Aún no se han habilitado candidatos para esta elección.
                </p>
            </div>

            <!-- Empty filter search result -->
            <div
                v-else-if="filteredCandidates.length === 0"
                class="rounded-3xl border border-gray-200 bg-white p-10 text-center shadow-xs"
            >
                <p class="text-sm font-medium text-gray-700">
                    No se encontraron candidatos que coincidan con la búsqueda.
                </p>
                <button
                    type="button"
                    class="btn-secondary mt-4"
                    @click="clearFilters"
                >
                    Limpiar filtros
                </button>
            </div>

            <!-- Candidates Grid -->
            <div
                v-else
                class="flex flex-wrap justify-center gap-6"
            >
                <CandidateCard
                    v-for="candidate in filteredCandidates"
                    :key="candidate.id"
                    :candidate="candidate"
                    @select="selectCandidate"
                />
            </div>
        </section>

        <!-- Confirmation Dialog -->
        <ConfirmVoteDialog
            :show="showConfirmDialog"
            :candidate="selectedCandidate"
            @close="closeDialog"
        />
        </div>
    </div>
</template>
