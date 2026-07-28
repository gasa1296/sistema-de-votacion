<script setup lang="ts">
import { ref } from 'vue'
import CandidateCard from '@/components/Voter/CandidateCard.vue'
import ConfirmVoteDialog from '@/components/Voter/ConfirmVoteDialog.vue'
import ElectionStatusBanner from '@/components/Voter/ElectionStatusBanner.vue'

interface Candidate {
    id: number
    name: string
    last_name?: string
    description?: string
    photo_path?: string
    position: string
}

interface Election {
    id: number
    name: string
    status: string
}

defineProps<{
    election: Election
    candidates: Candidate[]
    hasVoted: boolean
    user: { id: number; name: string; last_name?: string }
}>()

const selectedCandidate = ref<Candidate | null>(null)
const showConfirmDialog = ref(false)

function selectCandidate(candidate: Candidate) {
    selectedCandidate.value = candidate
    showConfirmDialog.value = true
}

function closeDialog() {
    selectedCandidate.value = null
    showConfirmDialog.value = false
}
</script>

<template>
    <div>
        <ElectionStatusBanner :election="election" :has-voted="hasVoted" />

        <div v-if="hasVoted" class="mt-8 text-center">
            <div class="rounded-lg bg-green-50 p-8 dark:bg-green-900/20">
                <svg class="mx-auto h-12 w-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <h2 class="mt-4 text-xl font-semibold text-gray-900 dark:text-white">
                    Ya has votado en esta elección
                </h2>
                <p class="mt-2 text-gray-500 dark:text-gray-400">
                    Tu voto ha sido registrado exitosamente.
                </p>
            </div>
        </div>

        <div v-else>
            <h2 class="mb-6 text-2xl font-bold text-gray-900 dark:text-white">
                Selecciona tu candidato
            </h2>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <CandidateCard
                    v-for="candidate in candidates"
                    :key="candidate.id"
                    :candidate="candidate"
                    @select="selectCandidate"
                />
            </div>
        </div>

        <ConfirmVoteDialog
            :show="showConfirmDialog"
            :candidate="selectedCandidate"
            @close="closeDialog"
        />
    </div>
</template>
