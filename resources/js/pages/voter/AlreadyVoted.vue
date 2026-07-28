<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="flex min-h-[60vh] items-center justify-center">
        <div class="text-center">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/20">
                <svg class="h-8 w-8 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h1 class="mt-6 text-3xl font-bold text-gray-900 dark:text-white">
                Ya has votado
            </h1>
            <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">
                Has emitido tu voto en esta elección. Cada votante solo puede votar una vez.
            </p>
            <div class="mt-8">
                <Link
                    href="/resultados"
                    class="inline-flex items-center rounded-md bg-amber-500 px-4 py-2 text-white hover:bg-amber-600"
                >
                    Ver resultados
                </Link>
            </div>
        </div>
    </div>
</template>
