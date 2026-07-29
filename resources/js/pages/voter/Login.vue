<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';

defineProps<{
    election?: { name: string; status: string };
}>();

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

function submit() {
    form.post('/login');
}
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center justify-center bg-linear-to-br from-gray-50 via-white to-brand-50/40 px-4 py-12 sm:px-6 lg:px-8"
    >
        <div class="w-full max-w-sm">
            <div class="mb-8 text-center">
                <div
                    class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-linear-to-br from-brand-500 to-brand-700 text-white shadow-lg shadow-brand-500/20"
                >
                    <svg
                        class="h-7 w-7"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2.5"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        aria-hidden="true"
                    >
                        <path
                            d="M9 11l3 3L22 4M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"
                        />
                    </svg>
                </div>
                <h1
                    class="mt-5 text-2xl font-bold tracking-tight text-gray-900"
                >
                    Votación Virtual
                </h1>
                <p
                    v-if="election"
                    class="mt-1.5 text-sm text-gray-500"
                >
                    {{ election.name }}
                </p>
                <p
                    v-else
                    class="mt-1.5 text-sm text-gray-500"
                >
                    Ingresa con tus credenciales para emitir tu voto
                </p>
            </div>

            <div class="card p-6 sm:p-8">
                <form @submit.prevent="submit" class="space-y-5" novalidate>
                    <div>
                        <label
                            for="email"
                            class="mb-1.5 block text-sm font-medium text-gray-700"
                        >
                            Correo electrónico
                        </label>
                        <input
                            id="email"
                            v-model="form.email"
                            type="email"
                            required
                            autocomplete="email"
                            placeholder="tu@correo.com"
                            class="input"
                            :class="{
                                'border-red-300 focus:border-red-500 focus:ring-red-500/20':
                                    form.errors.email,
                            }"
                        />
                        <p
                            v-if="form.errors.email"
                            class="mt-1.5 flex items-center gap-1 text-sm text-red-600"
                        >
                            <svg
                                class="h-4 w-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            {{ form.errors.email }}
                        </p>
                    </div>

                    <div>
                        <div class="mb-1.5 flex items-center justify-between">
                            <label
                                for="password"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Contraseña
                            </label>
                        </div>
                        <input
                            id="password"
                            v-model="form.password"
                            type="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="input"
                            :class="{
                                'border-red-300 focus:border-red-500 focus:ring-red-500/20':
                                    form.errors.password,
                            }"
                        />
                        <p
                            v-if="form.errors.password"
                            class="mt-1.5 flex items-center gap-1 text-sm text-red-600"
                        >
                            <svg
                                class="h-4 w-4"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                aria-hidden="true"
                            >
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="8" x2="12" y2="12" />
                                <line x1="12" y1="16" x2="12.01" y2="16" />
                            </svg>
                            {{ form.errors.password }}
                        </p>
                    </div>

                    <div class="flex items-center">
                        <input
                            id="remember"
                            v-model="form.remember"
                            type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-brand-600 focus:ring-brand-500"
                        />
                        <label
                            for="remember"
                            class="ml-2 text-sm text-gray-600"
                        >
                            Recordarme en este dispositivo
                        </label>
                    </div>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="btn-primary w-full py-2.5"
                    >
                        <svg
                            v-if="form.processing"
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
                        <span>{{
                            form.processing ? 'Ingresando...' : 'Ingresar'
                        }}</span>
                    </button>
                </form>
            </div>

            <p
                class="mt-6 text-center text-xs text-gray-500"
            >
                Tus credenciales fueron enviadas a tu correo electrónico.
            </p>
        </div>
    </div>
</template>
