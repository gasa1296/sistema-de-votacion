<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'

defineProps<{
    election?: { name: string; status: string }
}>()

const form = useForm({
    email: '',
    password: '',
    remember: false,
})

function submit() {
    form.post('/login')
}
</script>

<template>
    <div class="flex min-h-screen items-center justify-center bg-gray-50 px-4 dark:bg-gray-900">
        <div class="w-full max-w-md">
            <div class="mb-8 text-center">
                <svg class="mx-auto h-12 w-12 text-amber-500" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                </svg>
                <h1 class="mt-4 text-2xl font-bold text-gray-900 dark:text-white">
                    Votación Virtual
                </h1>
                <p v-if="election" class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ election.name }}
                </p>
            </div>

            <div class="rounded-lg bg-white p-8 shadow-md dark:bg-gray-800">
                <form @submit.prevent="submit" class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Email
                        </label>
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            required
                            autocomplete="email"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-amber-500 focus:ring-amber-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            :class="{ 'border-red-500': form.errors.email }"
                        />
                        <p v-if="form.errors.email" class="mt-1 text-sm text-red-500">
                            {{ form.errors.email }}
                        </p>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Contraseña
                        </label>
                        <input
                            id="password"
                            v-model="form.password"
                            type="password"
                            required
                            autocomplete="current-password"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-amber-500 focus:ring-amber-500 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                            :class="{ 'border-red-500': form.errors.password }"
                        />
                        <p v-if="form.errors.password" class="mt-1 text-sm text-red-500">
                            {{ form.errors.password }}
                        </p>
                    </div>

                    <div class="flex items-center">
                        <input
                            id="remember"
                            v-model="form.remember"
                            type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-amber-500 focus:ring-amber-500"
                        />
                        <label for="remember" class="ml-2 text-sm text-gray-600 dark:text-gray-300">
                            Recordarme
                        </label>
                    </div>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="w-full rounded-md bg-amber-500 px-4 py-2 text-white hover:bg-amber-600 focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 focus:outline-none disabled:opacity-50"
                    >
                        <span v-if="form.processing">Ingresando...</span>
                        <span v-else>Ingresar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
