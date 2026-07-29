<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import type { User } from './types';

const page = usePage();
const user = computed(() => page.props.user as User | undefined);
const electionName = computed(
    () =>
        (page.props.election as { name?: string } | undefined)?.name ??
        'Sistema de Votación',
);

const mobileMenuOpen = ref(false);

const userInitials = computed(() => {
    if (!user.value) {
        return '';
    }

    const first = user.value.name?.charAt(0) ?? '';
    const last = user.value.last_name?.charAt(0) ?? '';

    return `${first}${last}`.toUpperCase();
});

const userFullName = computed(() => {
    if (!user.value) {
        return '';
    }

    return `${user.value.name} ${user.value.last_name ?? ''}`.trim();
});
</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <header
            class="sticky top-0 z-40 border-b border-gray-200/80 bg-white/80 backdrop-blur-md"
        >
            <div
                class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6 lg:px-8"
            >
                <Link
                    href="/"
                    class="flex items-center gap-2.5 rounded-md text-gray-900 transition-opacity hover:opacity-80"
                >
                    <span
                        class="flex h-9 w-9 items-center justify-center rounded-lg bg-linear-to-br from-brand-500 to-brand-700 text-white shadow-sm"
                    >
                        <svg
                            class="h-5 w-5"
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
                    </span>
                    <span class="text-base font-semibold tracking-tight">
                        {{ electionName }}
                    </span>
                </Link>

                <nav v-if="user" class="flex items-center gap-2">
                    <div class="hidden items-center gap-3 sm:flex">
                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-100 text-sm font-semibold text-brand-700"
                        >
                            {{ userInitials }}
                        </div>
                        <span
                            class="text-sm font-medium text-gray-700"
                        >
                            {{ userFullName }}
                        </span>
                    </div>

                    <Link
                        href="/logout"
                        method="post"
                        as="button"
                        class="btn-ghost"
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
                            <path
                                d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"
                            />
                        </svg>
                        <span class="hidden sm:inline">Cerrar sesión</span>
                    </Link>

                    <button
                        type="button"
                        class="btn-ghost sm:hidden"
                        :aria-expanded="mobileMenuOpen"
                        aria-controls="mobile-user-menu"
                        @click="mobileMenuOpen = !mobileMenuOpen"
                    >
                        <span class="sr-only">Abrir menú de usuario</span>
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
                            <circle cx="12" cy="12" r="1" />
                            <circle cx="12" cy="5" r="1" />
                            <circle cx="12" cy="19" r="1" />
                        </svg>
                    </button>
                </nav>
            </div>

            <Transition
                enter-active-class="transition duration-150 ease-out"
                enter-from-class="opacity-0 -translate-y-1"
                enter-to-class="opacity-100 translate-y-0"
                leave-active-class="transition duration-100 ease-in"
                leave-from-class="opacity-100 translate-y-0"
                leave-to-class="opacity-0 -translate-y-1"
            >
                <div
                    v-if="mobileMenuOpen && user"
                    id="mobile-user-menu"
                    class="border-t border-gray-200 bg-white px-4 py-3 sm:hidden"
                >
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full bg-brand-100 text-sm font-semibold text-brand-700"
                        >
                            {{ userInitials }}
                        </div>
                        <div>
                            <p
                                class="text-sm font-semibold text-gray-900"
                            >
                                {{ userFullName }}
                            </p>
                            <p class="text-xs text-gray-500">
                                Votante
                            </p>
                        </div>
                    </div>
                </div>
            </Transition>
        </header>

        <main
            class="mx-auto max-w-6xl px-4 py-8 sm:px-6 sm:py-10 lg:px-8 lg:py-12"
        >
            <slot />
        </main>

        <footer
            class="border-t border-gray-200 bg-white py-6"
        >
            <p class="text-center text-xs text-gray-500">
                © {{ new Date().getFullYear() }} {{ electionName }}. Todos los
                derechos reservados.
            </p>
        </footer>
    </div>
</template>
