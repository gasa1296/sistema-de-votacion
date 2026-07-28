<script setup lang="ts">
interface Election {
    id: number
    name: string
    status: string
}

defineProps<{
    election: Election
    hasVoted: boolean
}>()
</script>

<template>
    <div
        class="rounded-lg p-4"
        :class="{
            'bg-green-50 dark:bg-green-900/20': election.status === 'open' && !hasVoted,
            'bg-blue-50 dark:bg-blue-900/20': election.status === 'open' && hasVoted,
            'bg-yellow-50 dark:bg-yellow-900/20': election.status === 'pending',
            'bg-red-50 dark:bg-red-900/20': election.status === 'closed',
        }"
    >
        <div class="flex items-center gap-3">
            <div
                class="flex h-10 w-10 items-center justify-center rounded-full"
                :class="{
                    'bg-green-100 dark:bg-green-800': election.status === 'open' && !hasVoted,
                    'bg-blue-100 dark:bg-blue-800': election.status === 'open' && hasVoted,
                    'bg-yellow-100 dark:bg-yellow-800': election.status === 'pending',
                    'bg-red-100 dark:bg-red-800': election.status === 'closed',
                }"
            >
                <svg
                    v-if="election.status === 'open' && !hasVoted"
                    class="h-5 w-5 text-green-600 dark:text-green-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <svg
                    v-else-if="election.status === 'open' && hasVoted"
                    class="h-5 w-5 text-blue-600 dark:text-blue-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <svg
                    v-else-if="election.status === 'pending'"
                    class="h-5 w-5 text-yellow-600 dark:text-yellow-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <svg
                    v-else
                    class="h-5 w-5 text-red-600 dark:text-red-400"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
            </div>
            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">
                    {{ election.name }}
                </h3>
                <p
                    class="text-sm"
                    :class="{
                        'text-green-700 dark:text-green-300': election.status === 'open' && !hasVoted,
                        'text-blue-700 dark:text-blue-300': election.status === 'open' && hasVoted,
                        'text-yellow-700 dark:text-yellow-300': election.status === 'pending',
                        'text-red-700 dark:text-red-300': election.status === 'closed',
                    }"
                >
                    <span v-if="election.status === 'open' && !hasVoted">Elección abierta — Selecciona tu candidato</span>
                    <span v-else-if="election.status === 'open' && hasVoted">Ya has votado en esta elección</span>
                    <span v-else-if="election.status === 'pending'">Elección pendiente — Aún no ha comenzado</span>
                    <span v-else>Elección cerrada</span>
                </p>
            </div>
        </div>
    </div>
</template>
