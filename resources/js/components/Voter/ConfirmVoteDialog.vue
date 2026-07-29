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
    if (!props.candidate) {
        return '';
    }

    return `${props.candidate.name} ${props.candidate.last_name ?? ''}`.trim();
});


const dialogTitleId = 'confirm-vote-title';
const dialogDescriptionId = 'confirm-vote-description';

watch(
    () => props.show,
    (open) => {
        if (!open) {
            processing.value = false;
        }
    },
);

function confirm() {
    if (!props.candidate) {
        return;
    }

    processing.value = true;
    router.post(
        '/votar',
        { candidate_id: props.candidate.id },
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
                class="fixed inset-0 z-50 flex items-end justify-center p-4 sm:items-center"
                role="dialog"
                aria-modal="true"
                :aria-labelledby="dialogTitleId"
                :aria-describedby="dialogDescriptionId"
                @keydown="handleBackdropKeydown"
            >
                <div
                    class="absolute inset-0 bg-gray-950/70 backdrop-blur-md transition-opacity"
                    aria-hidden="true"
                    @click="emit('close')"
                />

                <Transition
                    enter-active-class="transition duration-200 ease-out"
                    enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-active-class="transition duration-150 ease-in"
                    leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                >
                    <div
                        v-if="show"
                        class="relative w-full max-w-lg overflow-hidden rounded-3xl bg-white shadow-2xl ring-1 ring-black/5"
                    >
                        <!-- Modal Header -->
                        <div
                            class="flex items-center justify-between border-b border-gray-100 bg-gray-50/50 px-6 py-4 "
                        >
                            <div class="flex items-center gap-3">
                                <div
                                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-brand-100 text-brand-600"
                                    aria-hidden="true"
                                >
                                    <svg
                                        class="h-5 w-5"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2.5"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    >
                                        <path
                                            d="M9 11l3 3L22 4M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"
                                        />
                                    </svg>
                                </div>
                                <div>
                                    <h3
                                        :id="dialogTitleId"
                                        class="text-lg font-bold text-gray-900 "
                                    >
                                        Confirmar Selección
                                    </h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        Paso final para emitir tu voto
                                    </p>
                                </div>
                            </div>
                            <button
                                type="button"
                                class="rounded-xl p-2 text-gray-400 transition-colors hover:bg-gray-200/60 hover:text-gray-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-500"
                                aria-label="Cerrar"
                                @click="emit('close')"
                            >
                                <svg
                                    class="h-5 w-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <line x1="18" y1="6" x2="6" y2="18" />
                                    <line x1="6" y1="6" x2="18" y2="18" />
                                </svg>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="p-6">
                            <p
                                :id="dialogDescriptionId"
                                class="text-sm text-gray-600"
                            >
                                Estás a punto de emitir tu voto formal por el siguiente candidato:
                            </p>

                            <!-- Candidate Card Preview -->
                            <div
                                v-if="candidate"
                                class="mt-4 flex items-center gap-4 rounded-2xl border border-brand-200/60 bg-linear-to-r from-brand-50/50 to-indigo-50/30 p-4"
                            >
                                <img
                                    v-if="candidate.photo_path"
                                    :src="`/storage/${candidate.photo_path}`"
                                    :alt="fullName"
                                    class="h-14 w-14 shrink-0 rounded-2xl object-cover ring-2 ring-brand-300"
                                />
                                <div class="min-w-0 flex-1">
                                    <span
                                        class="inline-block text-xs font-semibold uppercase tracking-wider text-brand-700"
                                    >
                                        {{ candidate.position }}
                                    </span>
                                    <p
                                        class="truncate text-base font-bold text-gray-900"
                                    >
                                        {{ fullName }}
                                    </p>
                                </div>
                                <div class="shrink-0">
                                    <span
                                        class="flex h-8 w-8 items-center justify-center rounded-full bg-brand-600 text-white shadow-sm"
                                    >
                                        <svg
                                            class="h-4 w-4"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="3"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        >
                                            <polyline points="20 6 9 17 4 12" />
                                        </svg>
                                    </span>
                                </div>
                            </div>

                            <!-- Security Warning -->
                            <div
                                class="mt-4 flex items-start gap-3 rounded-xl border border-amber-200/80 bg-amber-50/70 p-3.5 text-xs text-amber-900"
                                role="note"
                            >
                                <svg
                                    class="mt-0.5 h-4 w-4 shrink-0 text-amber-600"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <path
                                        d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"
                                    />
                                    <line x1="12" y1="9" x2="12" y2="13" />
                                    <line x1="12" y1="17" x2="12.01" y2="17" />
                                </svg>
                                <p class="leading-relaxed">
                                    <strong>Importante:</strong> Solo puedes emitir un único voto por elección. Esta decisión es permanente y no se podrá modificar posteriormente.
                                </p>
                            </div>
                        </div>

                        <!-- Modal Actions Footer -->
                        <div
                            class="flex flex-col-reverse gap-2 border-t border-gray-100 bg-gray-50/80 px-6 py-4 sm:flex-row sm:justify-end sm:gap-3"
                        >
                            <button
                                type="button"
                                class="btn-secondary w-full sm:w-auto"
                                :disabled="processing"
                                @click="emit('close')"
                            >
                                Cancelar
                            </button>
                            <button
                                type="button"
                                class="btn-primary w-full shadow-md sm:w-auto"
                                :disabled="processing"
                                @click="confirm"
                            >
                                <svg
                                    v-if="processing"
                                    class="h-4 w-4 animate-spin"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    aria-hidden="true"
                                >
                                    <circle
                                        class="opacity-25"
                                        cx="12"
                                        cy="12"
                                        r="10"
                                        stroke="currentColor"
                                        stroke-width="4"
                                    />
                                    <path
                                        class="opacity-75"
                                        fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                                    />
                                </svg>
                                <svg
                                    v-else
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2.5"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <polyline points="20 6 9 17 4 12" />
                                </svg>
                                <span>{{
                                    processing
                                        ? 'Emitiendo voto...'
                                        : 'Confirmar y Votar'
                                }}</span>
                            </button>
                        </div>
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>

