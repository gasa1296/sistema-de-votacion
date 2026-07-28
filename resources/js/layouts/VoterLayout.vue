<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

interface User {
    id: number
    name: string
    last_name?: string
    role: string
}

const page = usePage()
const user = computed(() => page.props.user as User | undefined)
const electionName = computed(() => (page.props.election as any)?.name || 'Sistema de Votación')
</script>

<template>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900">
        <nav class="border-b border-gray-200 bg-white dark:border-gray-700 dark:bg-gray-800">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                    <div class="flex items-center gap-3">
                        <Link href="/" class="flex items-center gap-2">
                            <svg class="h-8 w-8 text-amber-500" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                            </svg>
                            <span class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ electionName }}
                            </span>
                        </Link>
                    </div>

                    <div v-if="user" class="flex items-center gap-4">
                        <span class="text-sm text-gray-600 dark:text-gray-300">
                            {{ user.name }} {{ user.last_name }}
                        </span>
                        <Link
                            href="/logout"
                            method="post"
                            as="button"
                            class="rounded-md px-3 py-1.5 text-sm text-gray-600 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700"
                        >
                            Cerrar sesión
                        </Link>
                    </div>
                </div>
            </div>
        </nav>

        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <slot />
        </main>
    </div>
</template>
