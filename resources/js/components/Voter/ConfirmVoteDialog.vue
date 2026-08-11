<script setup lang="ts">
import { router } from '@inertiajs/vue3';
import { computed, ref, watch } from 'vue';
import type { Candidate } from '@/types';

const props = defineProps<{
    show: boolean;
    candidate: Candidate | null;
}>();

const emit = defineEmits<{
    close: [];
}>();

const processing = ref(false);

const fullName = computed(() => {
    if (!props.candidate) return '';
    return `${props.candidate.name} ${props.candidate.last_name ?? ''}`.trim();
});

const dialogTitleId = 'confirm-vote-title';
const dialogDescriptionId = 'confirm-vote-description';

watch(
    () => props.show,
    (open) => {
        if (!open) processing.value = false;
    },
);

function confirm() {
    if (!props.candidate) return;
    processing.value = true;
    router.post(
        '/votar',
        { candidate_id: props.candidate.id === 0 ? null : props.candidate.id },
        {
            onFinish: () => {
                processing.value = false;
                emit('close');
            },
        },
    );
}

function handleBackdropKeydown(event: KeyboardEvent) {
    if (event.key === 'Escape' && props.show) {
        emit('close');
    }
}
</script>

<template>
    <Teleport to="body">
        <Transition
            enter-active-class="transition duration-200 ease-out"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="transition duration-150 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-if="show"
                class="fixed inset-0 z-50 flex items-center justify-center p-4"
                role="dialog"
                aria-modal="true"
                :aria-labelledby="dialogTitleId"
                :aria-describedby="dialogDescriptionId"
                @keydown="handleBackdropKeydown"
            >
                <!-- Backdrop -->
                <div
                    class="absolute inset-0 bg-gray-950/60 backdrop-blur-sm transition-opacity"
                    aria-hidden="true"
                    @click="emit('close')"
                />

                <!-- Modal Content -->
                <Transition
                    enter-active-class="transition duration-200 ease-out"
                    enter-from-class="opacity-0 scale-95"
                    enter-to-class="opacity-100 scale-100"
                    leave-active-class="transition duration-150 ease-in"
                    leave-from-class="opacity-100 scale-100"
                    leave-to-class="opacity-0 scale-95"
                >
                    <div
                        v-if="show"
                        class="relative w-full max-w-md overflow-hidden rounded-3xl bg-white shadow-2xl"
                    >
                        <!-- Header with icon -->
                        <div class="px-6 pt-8 text-center">
                            <div
                                class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#1e3a5f]/10"
                            >
                                <svg
                                    class="h-8 w-8 text-[#1e3a5f]"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path d="M9 11l3 3L22 4M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11" />
                                </svg>
                            </div>
                            <h3
                                :id="dialogTitleId"
                                class="mt-4 text-2xl font-bold text-gray-900"
                            >
                                Confirma tu voto
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Has seleccionado a:
                            </p>
                        </div>

                        <!-- Candidate Card -->
                        <div
                            v-if="candidate"
                            class="mx-6 mt-6 flex items-center gap-4 rounded-2xl border border-gray-200 bg-gray-50 p-4"
                        >
                            <img
                                v-if="candidate.photo_path"
                                :src="`/storage/${candidate.photo_path}`"
                                :alt="fullName"
                                class="h-16 w-16 shrink-0 rounded-2xl object-cover"
                            />
                            <div class="min-w-0 flex-1">
                                <p class="text-lg font-bold text-gray-900">
                                    {{ fullName }}
                                </p>
                                <p class="text-sm font-medium text-[#1e3a5f]">
                                    {{ candidate.position }}
                                </p>
                                <p
                                    v-if="candidate.description"
                                    class="mt-1 text-sm text-gray-500 italic line-clamp-2"
                                >
                                    "{{ candidate.description }}"
                                </p>
                            </div>
                        </div>

                        <!-- Warning Note -->
                        <div
                            class="mx-6 mt-4 flex items-start gap-3 rounded-xl bg-amber-50 p-4"
                            role="note"
                        >
                            <svg
                                class="mt-0.5 h-5 w-5 shrink-0 text-amber-500"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                            <div class="text-sm text-amber-800">
                                <p class="font-semibold">Una vez confirmado, no podrás cambiar tu voto.</p>
                                <p class="mt-0.5 text-amber-700">Asegúrate de haber seleccionado a tu candidato.</p>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex flex-col gap-3 px-6 py-6">
                            <button
                                type="button"
                                class="flex w-full items-center justify-center gap-2 rounded-2xl bg-[#bd1622] px-6 py-4 text-base font-bold text-white shadow-lg transition-colors hover:bg-[#a3121d] disabled:opacity-50"
                                :disabled="processing"
                                @click="confirm"
                            >
                                <svg
                                    v-if="processing"
                                    class="h-5 w-5 animate-spin"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                >
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                                </svg>
                                <svg
                                    v-else
                                    class="h-5 w-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                                </svg>
                                <span>{{ processing ? 'Emitiendo voto...' : 'Confirmar voto' }}</span>
                            </button>
                            <button
                                type="button"
                                class="w-full rounded-2xl border-2 border-gray-200 px-6 py-3.5 text-base font-semibold text-gray-700 transition-colors hover:border-gray-300 hover:bg-gray-50 disabled:opacity-50"
                                :disabled="processing"
                                @click="emit('close')"
                            >
                                Cancelar
                            </button>
                        </div>
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>
