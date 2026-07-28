<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <div class="flex min-h-[60vh] items-center justify-center">
        <div class="text-center">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/20">
                <svg class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1 class="mt-6 text-3xl font-bold text-gray-900 dark:text-white">
                ¡Gracias por votar!
            </h1>
            <p class="mt-4 text-lg text-gray-500 dark:text-gray-400">
                Tu voto ha sido registrado exitosamente. Tu participación es importante para nosotros.
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
