<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import VoterTopBar from '@/components/VoterTopBar.vue';
</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <VoterTopBar />

        <div class="bg-[#bd1622] px-4 py-3 text-center">
            <div class="flex items-center justify-center gap-2 text-sm text-white">
                <svg
                    class="h-4 w-4 shrink-0"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <rect x="3" y="11" width="18" height="11" rx="2" />
                    <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                </svg>
                <span>
                    <strong>Tu voto es secreto</strong>
                    <span class="text-white/80"> y solamente podrás votar una vez.</span>
                </span>
            </div>
        </div>

        <div class="mx-auto max-w-2xl px-4 py-6">
            <div class="space-y-6">
                <div class="text-center">
                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-emerald-100">
                        <svg
                            class="h-10 w-10 text-emerald-500"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="3"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
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
                    <svg
                        class="mt-0.5 h-5 w-5 shrink-0 text-emerald-500"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                        <polyline points="22 4 12 14.01 9 11.01" />
                    </svg>
                    <p class="text-sm text-emerald-800">
                        Tu voto ha sido registrado exitosamente y es 100% secreto.
                    </p>
                </div>

                <div class="space-y-3">
                    <Link
                        href="/resultados"
                        as="button"
                        class="flex w-full items-center justify-center gap-2 rounded-2xl border-2 border-[#bd1622] px-6 py-4 text-base font-bold text-[#bd1622] transition-colors hover:bg-[#bd1622]/5"
                    >
                        Resultados
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <line x1="18" y1="20" x2="18" y2="10" />
                            <line x1="12" y1="20" x2="12" y2="4" />
                            <line x1="6" y1="20" x2="6" y2="14" />
                        </svg>
                    </Link>
                </div>

                <div class="space-y-3">
                    <Link
                        href="/logout"
                        method="post"
                        as="button"
                        class="flex w-full items-center justify-center gap-2 rounded-2xl border-2 border-[#bd1622] px-6 py-4 text-base font-bold text-[#bd1622] transition-colors hover:bg-[#bd1622]/5"
                    >
                        Cerrar sesión
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
                            <rect x="3" y="11" width="18" height="11" rx="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                    </Link>
                    <p class="text-center text-sm text-gray-500">
                        Tu participación fortalece nuestra comunidad.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
