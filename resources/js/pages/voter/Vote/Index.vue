<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import CandidateCard from '@/components/Voter/CandidateCard.vue';
import CandidateProfile from '@/components/Voter/CandidateProfile.vue';
import ConfirmVoteDialog from '@/components/Voter/ConfirmVoteDialog.vue';
import VoterTopBar from '@/components/VoterTopBar.vue';
import type { Candidate, Election, Turnout, User } from '../../../types';

interface ResultItem {
    name: string;
    votes: number;
    percentage: number;
    photo_path?: string;
}

const props = defineProps<{
    election: Election;
    candidates: Candidate[];
    hasVoted: boolean;
    user: User;
    turnout: Turnout;
    results?: ResultItem[];
}>();

const selectedCandidate = ref<Candidate | null>(null);
const showConfirmDialog = ref(false);
const showProfileModal = ref(false);
const profileCandidate = ref<Candidate | null>(null);
const currentStep = ref(1);

const blankVote: Candidate = {
    id: 0,
    name: 'Voto en blanco',
    position: '',
    description: 'Si prefieres no elegir ningún candidato.',
};

function selectCandidate(candidate: Candidate) {
    selectedCandidate.value = candidate;
}

function continueToConfirm() {
    if (selectedCandidate.value) {
        currentStep.value = 2;
        showConfirmDialog.value = true;
    }
}

function closeConfirmDialog() {
    showConfirmDialog.value = false;
    currentStep.value = 1;
}

function openProfile(candidate: Candidate) {
    profileCandidate.value = candidate;
    showProfileModal.value = true;
}

function closeProfile() {
    showProfileModal.value = false;
    profileCandidate.value = null;
}
</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <VoterTopBar />

        <!-- Secret Vote Banner -->
        <div class="bg-[#bd1622] px-4 py-3 text-center">
            <div class="flex items-center justify-center gap-2 text-sm text-white">
                <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
                <span>
                    <strong>Tu voto es secreto</strong>
                    <span class="text-white/80"> y solamente podrás votar una vez.</span>
                </span>
            </div>
        </div>

        <div class="mx-auto max-w-2xl px-4 py-6">
            <!-- State: Has Voted - Success -->
            <div v-if="hasVoted" class="space-y-6">
                <div class="text-center">
                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100">
                        <svg class="h-10 w-10 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                    </div>
                    <h1 class="mt-6 text-2xl font-bold text-gray-900">
                        ¡Tu voto ha sido registrado!
                    </h1>
                    <p class="mt-2 text-sm text-gray-600">
                        Gracias por participar en la Elección de Presidente 2026.
                    </p>
                </div>

                <div class="flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4">
                    <svg class="mt-0.5 h-5 w-5 shrink-0 text-emerald-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                    <p class="text-sm text-emerald-800">
                        Tu voto ha sido registrado exitosamente y es 100% secreto.
                    </p>
                </div>

                <div class="space-y-3">
                    <Link
                        href="/logout"
                        method="post"
                        as="button"
                        class="flex w-full items-center justify-center gap-2 rounded-2xl border-2 border-[#bd1622] px-6 py-4 text-base font-bold text-[#bd1622] transition-colors hover:bg-[#bd1622]/5"
                    >
                        Cerrar sesión
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                    </Link>
                    <p class="text-center text-sm text-gray-500">
                        Tu participación fortalece nuestra comunidad.
                    </p>
                </div>
            </div>

            <!-- State: Active Voting -->
            <div v-else class="space-y-6">
                <!-- Stepper -->
                <div class="flex items-center justify-center gap-4 py-4">
                    <div class="flex items-center gap-2">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-full text-sm font-bold"
                            :class="currentStep === 1
                                ? 'bg-[#bd1622] text-white'
                                : 'bg-gray-200 text-gray-600'"
                        >
                            1
                        </div>
                        <span
                            class="text-sm font-semibold"
                            :class="currentStep === 1 ? 'text-[#bd1622]' : 'text-gray-500'"
                        >
                            Selecciona candidato
                        </span>
                    </div>
                    <div class="h-0.5 w-8 bg-gray-200" />
                    <div class="flex items-center gap-2">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-full text-sm font-bold"
                            :class="currentStep === 2
                                ? 'bg-[#bd1622] text-white'
                                : 'bg-gray-200 text-gray-600'"
                        >
                            2
                        </div>
                        <span
                            class="text-sm font-semibold"
                            :class="currentStep === 2 ? 'text-[#bd1622]' : 'text-gray-500'"
                        >
                            Confirmar voto
                        </span>
                    </div>
                </div>

                <!-- Title -->
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        Selecciona a tu candidato
                    </h1>
                    <p class="mt-1 text-sm text-gray-600">
                        Explora las opciones y elige al candidato de tu preferencia.
                    </p>
                </div>

                <!-- Candidates List -->
                <div class="space-y-3">
                    <CandidateCard
                        v-for="candidate in candidates"
                        :key="candidate.id"
                        :candidate="candidate"
                        :selected="selectedCandidate?.id === candidate.id"
                        @select="selectCandidate"
                        @view-profile="openProfile"
                    />

                    <!-- Voto en Blanco -->
                    <CandidateCard
                        :candidate="blankVote"
                        :selected="selectedCandidate?.id === 0"
                        :is-blank="true"
                        @select="selectCandidate"
                    />
                </div>

                <!-- Continue Button -->
                <button
                    type="button"
                    class="flex w-full items-center justify-center gap-2 rounded-2xl px-6 py-4 text-base font-bold transition-all"
                    :class="selectedCandidate
                        ? 'bg-[#bd1622] text-white shadow-lg hover:bg-[#a3121d]'
                        : 'bg-gray-200 text-gray-400 cursor-not-allowed'"
                    :disabled="!selectedCandidate"
                    @click="continueToConfirm"
                >
                    Continuar
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="5" y1="12" x2="19" y2="12" />
                        <polyline points="12 5 19 12 12 19" />
                    </svg>
                </button>

                <!-- Footer -->
                <div class="flex items-center justify-center gap-2 py-4 text-xs text-gray-500">
                    <svg class="h-4 w-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                        <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                    </svg>
                    Tu voto es 100% secreto y seguro
                </div>
            </div>
        </div>

        <!-- Confirmation Dialog -->
        <ConfirmVoteDialog
            :show="showConfirmDialog"
            :candidate="selectedCandidate"
            @close="closeConfirmDialog"
        />

        <!-- Candidate Profile Modal -->
        <CandidateProfile
            :show="showProfileModal"
            :candidate="profileCandidate"
            @close="closeProfile"
        />
    </div>
</template>
