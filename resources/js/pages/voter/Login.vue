<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import VoterTopBar from '../../components/VoterTopBar.vue';

const showPassword = ref(false);

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
        class="flex min-h-screen flex-col bg-linear-to-br from-gray-50 via-white to-brand-50/40"
    >
        <VoterTopBar />
        <div
            class="flex flex-1 flex-col items-center justify-center px-4 py-12 sm:px-6 lg:px-8"
        >
        <div class="w-full max-w-sm">
            <div class="mb-8 text-center">
                <img
                    src="/logo.svg"
                    alt="Logo"
                    class="mx-auto h-16 w-auto"
                />
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
                            <a href="/olvide-contrasena" class="text-sm text-brand-600 hover:text-brand-500">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>
                        <div class="relative">
                            <input
                                id="password"
                                v-model="form.password"
                                :type="showPassword ? 'text' : 'password'"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="input pr-10"
                                :class="{
                                    'border-red-300 focus:border-red-500 focus:ring-red-500/20':
                                        form.errors.password,
                                }"
                            />
                            <button
                                type="button"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 transition-colors hover:text-gray-600"
                                tabindex="-1"
                                :aria-label="showPassword ? 'Ocultar contraseña' : 'Mostrar contraseña'"
                                @click="showPassword = !showPassword"
                            >
                                <!-- Eye (hidden) -->
                                <svg
                                    v-if="showPassword"
                                    class="h-5 w-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94" />
                                    <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19" />
                                    <line x1="1" y1="1" x2="23" y2="23" />
                                    <path d="M14.12 14.12a3 3 0 1 1-4.24-4.24" />
                                </svg>
                                <!-- Eye (visible) -->
                                <svg
                                    v-else
                                    class="h-5 w-5"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    aria-hidden="true"
                                >
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
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
    </div>
</template>
