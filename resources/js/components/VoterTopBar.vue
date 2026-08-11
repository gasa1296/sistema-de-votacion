<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { computed, ref } from 'vue';
import type { User } from '../layouts/types';

const page = usePage();
const user = computed(() => page.props.user as User | undefined);
const election = computed(
    () => page.props.election as { name?: string; description?: string } | undefined,
);
const electionName = computed(() => election.value?.name ?? 'Sistema de Votación');
const electionDescription = computed(() => election.value?.description ?? 'Asamblea General');

const mobileMenuOpen = ref(false);

const userInitials = computed(() => {
    if (!user.value) return '';
    const first = user.value.name?.charAt(0) ?? '';
    const last = user.value.last_name?.charAt(0) ?? '';
    return `${first}${last}`.toUpperCase();
});

const userFullName = computed(() => {
    if (!user.value) return '';
    return `${user.value.name} ${user.value.last_name ?? ''}`.trim();
});
</script>

<template>
    <header class="bg-[#1e3a5f] text-white">
        <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <Link
                href="/"
                class="flex items-center gap-3 rounded-md text-white transition-opacity hover:opacity-90"
            >
                <img
                    src="/logo-anacam.svg"
                    alt="Logo"
                    class="h-9 w-auto"
                />
                <div class="flex flex-col">
                    <span class="text-base font-bold tracking-tight leading-tight">
                        {{ electionName }}
                    </span>
                    <span class="text-xs text-white/70 leading-tight">
                        {{ electionDescription }}
                    </span>
                </div>
            </Link>

            <nav class="flex items-center gap-2">
                <Link
                    href="/resultados"
                    class="flex items-center gap-1.5 rounded-lg bg-white/10 px-3 py-2 text-sm font-medium text-white transition-colors hover:bg-white/20"
                >
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="18" y1="20" x2="18" y2="10" />
                        <line x1="12" y1="20" x2="12" y2="4" />
                        <line x1="6" y1="20" x2="6" y2="14" />
                    </svg>
                    <span class="hidden sm:inline">Resultados</span>
                </Link>

                <template v-if="user">
                    <div class="hidden items-center gap-3 sm:flex">
                        <div
                            class="flex h-9 w-9 items-center justify-center rounded-full bg-white/15 text-sm font-semibold text-white"
                        >
                            {{ userInitials }}
                        </div>
                    </div>

                    <Link
                        href="/logout"
                        method="post"
                        as="button"
                        class="flex items-center gap-1.5 rounded-lg bg-white/10 px-3 py-2 text-sm font-medium text-white transition-colors hover:bg-white/20"
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
                        <span class="hidden sm:inline">Salir</span>
                    </Link>

                    <button
                        type="button"
                        class="flex items-center justify-center rounded-lg bg-white/10 p-2 text-white sm:hidden"
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
                </template>
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
                class="border-t border-white/10 bg-[#1a3252] px-4 py-3 sm:hidden"
            >
                <div class="flex items-center gap-3">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-full bg-white/15 text-sm font-semibold text-white"
                    >
                        {{ userInitials }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">
                            {{ userFullName }}
                        </p>
                        <p class="text-xs text-white/60">
                            Votante
                        </p>
                    </div>
                </div>
            </div>
        </Transition>
    </header>
</template>
