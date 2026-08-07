<script setup lang="ts">
import { computed } from 'vue';
import type { Candidate } from '@/types';

const props = defineProps<{
    show: boolean;
    candidate: Candidate | null;
}>();

const emit = defineEmits<{
    close: [];
}>();

const fullName = computed(() => {
    if (!props.candidate) return '';
    return `${props.candidate.name} ${props.candidate.last_name ?? ''}`.trim();
});
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
                @click.self="emit('close')"
            >
                <!-- Backdrop -->
                <div
                    class="absolute inset-0 bg-gray-950/60 backdrop-blur-sm"
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
                        class="relative max-h-[85vh] w-full max-w-lg overflow-y-auto rounded-3xl bg-white shadow-2xl"
                    >
                        <!-- Header -->
                        <div class="sticky top-0 z-10 flex items-center gap-3 border-b border-gray-100 bg-white/95 backdrop-blur-sm px-6 py-4">
                            <button
                                type="button"
                                class="flex h-10 w-10 items-center justify-center rounded-xl text-gray-500 transition-colors hover:bg-gray-100 hover:text-gray-700"
                                @click="emit('close')"
                            >
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="19" y1="12" x2="5" y2="12" />
                                    <polyline points="12 19 5 12 12 5" />
                                </svg>
                            </button>
                            <h2 class="text-lg font-bold text-gray-900">
                                Perfil del candidato
                            </h2>
                        </div>

                        <!-- Candidate Photo -->
                        <div v-if="candidate" class="px-6 pt-6">
                            <div class="flex flex-col items-center text-center">
                                <img
                                    v-if="candidate.photo_path"
                                    :src="`/storage/${candidate.photo_path}`"
                                    :alt="fullName"
                                    class="h-32 w-32 rounded-3xl object-cover shadow-lg"
                                />
                                <div
                                    v-else
                                    class="flex h-32 w-32 items-center justify-center rounded-3xl bg-gradient-to-br from-[#1e3a5f] to-[#2d5a8e] text-5xl font-bold text-white shadow-lg"
                                >
                                    {{ fullName.charAt(0) }}
                                </div>

                                <h3 class="mt-4 text-2xl font-bold text-gray-900">
                                    {{ fullName }}
                                </h3>
                                <p class="mt-1 text-base font-semibold text-[#1e3a5f]">
                                    {{ candidate.position }}
                                </p>
                                <p
                                    v-if="candidate.description"
                                    class="mt-2 text-sm text-gray-500 italic max-w-sm"
                                >
                                    "{{ candidate.description }}"
                                </p>
                            </div>
                        </div>

                        <!-- About Section -->
                        <div v-if="candidate" class="px-6 pt-6">
                            <h4 class="text-lg font-bold text-gray-900">
                                Sobre {{ fullName }}
                            </h4>
                            <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                                {{ candidate.description || 'Este candidato no ha proporcionado una descripción.' }}
                            </p>
                        </div>

                        <!-- Proposals Section -->
                        <div v-if="candidate?.main_proposals?.length" class="px-6 pt-6 pb-8">
                            <h4 class="text-lg font-bold text-gray-900">
                                Propuestas principales
                            </h4>
                            <div class="mt-4 space-y-4">
                                <div
                                    v-for="(proposal, index) in candidate.main_proposals"
                                    :key="index"
                                    class="flex items-start gap-3"
                                >
                                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-[#1e3a5f]/10 text-[#1e3a5f]">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                            <polyline points="14 2 14 8 20 8" />
                                            <line x1="16" y1="13" x2="8" y2="13" />
                                            <line x1="16" y1="17" x2="8" y2="17" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ proposal.title }}</p>
                                        <p class="mt-0.5 text-sm text-gray-500">{{ proposal.description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Close Button -->
                        <div class="border-t border-gray-100 px-6 py-4">
                            <button
                                type="button"
                                class="w-full rounded-2xl border-2 border-gray-200 px-6 py-3.5 text-base font-semibold text-gray-700 transition-colors hover:border-gray-300 hover:bg-gray-50"
                                @click="emit('close')"
                            >
                                Cerrar
                            </button>
                        </div>
                    </div>
                </Transition>
            </div>
        </Transition>
    </Teleport>
</template>
