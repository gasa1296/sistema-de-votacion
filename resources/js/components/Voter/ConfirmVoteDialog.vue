<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import { ref } from 'vue'

interface Candidate {
    id: number
    name: string
    last_name?: string
    position: string
}

const props = defineProps<{
    show: boolean
    candidate: Candidate | null
}>()

const emit = defineEmits<{
    close: []
}>()

const processing = ref(false)

function confirm() {
    if (!props.candidate) {
        return
    }

    processing.value = true
    router.post('/votar', { candidate_id: props.candidate.id }, {
        onFinish: () => {
            processing.value = false
            emit('close')
        },
    })
}
</script>

<template>
    <Teleport to="body">
        <Transition
            enter-active-class="duration-200 ease-out"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="duration-150 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center p-4">
                <div class="fixed inset-0 bg-black/50" @click="emit('close')" />

                <Transition
                    enter-active-class="duration-200 ease-out"
                    enter-from-class="scale-95 opacity-0"
                    enter-to-class="scale-100 opacity-100"
                    leave-active-class="duration-150 ease-in"
                    leave-from-class="scale-100 opacity-100"
                    leave-to-class="scale-95 opacity-0"
                >
                    <div
                        v-if="show"
                        class="relative w-full max-w-md rounded-lg bg-white p-6 shadow-xl dark:bg-gray-800"
                    >
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Confirmar voto
                        </h3>

                        <p class="mt-4 text-gray-600 dark:text-gray-300">
                            Estás a punto de votar por:
                        </p>

                        <div v-if="candidate" class="mt-4 rounded-lg bg-gray-50 p-4 dark:bg-gray-700">
                            <p class="font-semibold text-gray-900 dark:text-white">
                                {{ candidate.name }} {{ candidate.last_name }}
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ candidate.position }}
                            </p>
                        </div>

                        <p class="mt-4 text-sm text-red-600 dark:text-red-400">
                            Esta acción no se puede deshacer. Solo puedes votar una vez.
                        </p>

                        <div class="mt-6 flex justify-end gap-3">
                            <button
                                type="button"
                                class="rounded-md px-4 py-2 text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600"
                                @click="emit('close')"
                            >
                                Cancelar
                            </button>
                            <button
                                type="button"
                                :disabled="processing"
                                class="rounded-md bg-amber-500 px-4 py-2 text-white hover:bg-amber-600 disabled:opacity-50"
                                @click="confirm"
                            >
                                <span v-if="processing">Confirmando...</span>
                                <span v-else>Confirmar voto</span>
                            </button>
                        </div>
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>
