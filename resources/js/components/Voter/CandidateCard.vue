<script setup lang="ts">
interface Candidate {
    id: number
    name: string
    last_name?: string
    description?: string
    photo_path?: string
    position: string
}

defineProps<{
    candidate: Candidate
}>()

const emit = defineEmits<{
    select: [candidate: Candidate]
}>()
</script>

<template>
    <div
        class="group cursor-pointer rounded-lg border border-gray-200 bg-white p-6 shadow-sm transition-all hover:border-amber-400 hover:shadow-md dark:border-gray-700 dark:bg-gray-800 dark:hover:border-amber-500"
        @click="emit('select', candidate)"
    >
        <div class="flex items-center gap-4">
            <div v-if="candidate.photo_path" class="shrink-0">
                <img
                    :src="`/storage/${candidate.photo_path}`"
                    :alt="`${candidate.name} ${candidate.last_name}`"
                    class="h-20 w-20 rounded-full object-cover ring-2 ring-gray-200 group-hover:ring-amber-400 dark:ring-gray-600"
                />
            </div>
            <div v-else class="flex h-20 w-20 shrink-0 items-center justify-center rounded-full bg-amber-100 dark:bg-amber-900/20">
                <span class="text-2xl font-bold text-amber-600 dark:text-amber-400">
                    {{ candidate.name.charAt(0) }}{{ candidate.last_name?.charAt(0) || '' }}
                </span>
            </div>
            <div class="min-w-0 flex-1">
                <h3 class="truncate text-lg font-semibold text-gray-900 dark:text-white">
                    {{ candidate.name }} {{ candidate.last_name }}
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ candidate.position }}
                </p>
                <p v-if="candidate.description" class="mt-2 line-clamp-2 text-sm text-gray-600 dark:text-gray-300">
                    {{ candidate.description }}
                </p>
            </div>
        </div>
        <div class="mt-4 text-center">
            <span class="text-sm font-medium text-amber-600 opacity-0 transition-opacity group-hover:opacity-100 dark:text-amber-400">
                Seleccionar candidato →
            </span>
        </div>
    </div>
</template>
