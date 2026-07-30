<script setup lang="ts">
import { useForm } from '@inertiajs/vue3';
import VoterTopBar from '../../components/VoterTopBar.vue';

defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

function submit() {
    form.post('/olvide-contrasena');
}
</script>

<template>
    <div class="flex min-h-screen flex-col bg-linear-to-br from-gray-50 via-white to-brand-50/40">
        <VoterTopBar />
        <div class="flex flex-1 flex-col items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
            <div class="w-full max-w-sm">
                <div class="mb-8 text-center">
                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-linear-to-br from-brand-500 to-brand-700 text-white shadow-lg shadow-brand-500/20">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                            <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                        </svg>
                    </div>
                    <h1 class="mt-5 text-2xl font-bold tracking-tight text-gray-900">
                        Olvidaste tu contraseña
                    </h1>
                    <p class="mt-1.5 text-sm text-gray-500">
                        Ingresa tu correo y te enviaremos un enlace para restablecerla
                    </p>
                </div>

                <div v-if="status" class="mb-4 rounded-lg bg-green-50 p-4 text-sm text-green-700">
                    {{ status }}
                </div>

                <div class="card p-6 sm:p-8">
                    <form @submit.prevent="submit" class="space-y-5" novalidate>
                        <div>
                            <label for="email" class="mb-1.5 block text-sm font-medium text-gray-700">
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
                                :class="{ 'border-red-300 focus:border-red-500 focus:ring-red-500/20': form.errors.email }"
                            />
                            <p v-if="form.errors.email" class="mt-1.5 text-sm text-red-600">
                                {{ form.errors.email }}
                            </p>
                        </div>

                        <button type="submit" :disabled="form.processing" class="btn-primary w-full py-2.5">
                            <svg v-if="form.processing" class="h-4 w-4 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" />
                            </svg>
                            <span>{{ form.processing ? 'Enviando...' : 'Enviar enlace' }}</span>
                        </button>
                    </form>

                    <div class="mt-4 text-center">
                        <a href="/login" class="text-sm text-brand-600 hover:text-brand-500">
                            Volver al inicio de sesión
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
