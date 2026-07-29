<script setup lang="ts">
import { computed } from 'vue';
import type { Candidate } from '@/types';

const props = defineProps<{
    candidate: Candidate;
}>();

const emit = defineEmits<{
    select: [candidate: Candidate];
}>();

const fullName = computed(() =>
    `${props.candidate.name} ${props.candidate.last_name ?? ''}`.trim(),
);

const avatarGradients = [
    'from-indigo-500 to-purple-600',
    'from-blue-500 to-cyan-600',
    'from-emerald-500 to-teal-600',
    'from-rose-500 to-pink-600',
    'from-amber-500 to-orange-600',
    'from-violet-500 to-fuchsia-600',
];

const avatarGradient = computed(
    () => avatarGradients[props.candidate.id % avatarGradients.length],
);

function handleKeydown(event: KeyboardEvent) {
    if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        emit('select', props.candidate);
    }
}
</script>

<template>
    <article
        tabindex="0"
        role="button"
        :aria-label="`Seleccionar a ${fullName}`"
        class="group relative flex h-full w-full max-w-sm cursor-pointer flex-col overflow-hidden rounded-2xl border border-gray-200/80 bg-white p-6 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-brand-300 hover:shadow-xl focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-brand-500"
        @click="emit('select', candidate)"
        @keydown="handleKeydown"
    >
        <!-- Top decorative gradient bar -->
        <div
            class="absolute top-0 inset-x-0 h-1.5 bg-linear-to-r transition-opacity duration-300 opacity-60 group-hover:opacity-100"
            :class="avatarGradient"
        />

        <div class="flex items-start gap-4 pt-1">
            <div class="relative shrink-0">
                <img
                    v-if="candidate.photo_path"
                    :src="`/storage/${candidate.photo_path}`"
                    :alt="fullName"
                    class="h-16 w-16 rounded-2xl object-cover shadow-sm ring-2 ring-gray-100 transition-transform duration-300 group-hover:scale-105"
                    loading="lazy"
                />

                <!-- Selection Check Indicator dot -->
                <div
                    class="absolute -bottom-1 -right-1 flex h-6 w-6 items-center justify-center rounded-full bg-white text-gray-400 shadow-sm transition-colors group-hover:bg-brand-600 group-hover:text-white"
                >
                    <svg
                        class="h-3.5 w-3.5"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="3"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <polyline points="20 6 9 17 4 12" />
                    </svg>
                </div>
            </div>

            <div class="min-w-0 flex-1">
                <span
                    class="inline-flex items-center rounded-full bg-brand-50 px-2.5 py-0.5 text-xs font-semibold text-brand-700"
                >
                    {{ candidate.position }}
                </span>
                <h3
                    class="mt-1.5 truncate text-lg font-bold text-gray-900 transition-colors group-hover:text-brand-600"
                >
                    {{ fullName }}
                </h3>
            </div>
        </div>

        <p
            v-if="candidate.description"
            class="mt-4 line-clamp-3 text-sm leading-relaxed text-gray-600"
        >
            {{ candidate.description }}
        </p>

        <div
            class="mt-auto flex items-center justify-between pt-4"
        >
            <span
                class="inline-flex items-center gap-1.5 rounded-lg bg-gray-50 px-3 py-1.5 text-xs font-semibold text-gray-700 transition-all duration-200 group-hover:bg-brand-600 group-hover:text-white"
            >
                Votar
                <svg
                    class="h-3.5 w-3.5 transition-transform duration-200 group-hover:translate-x-0.5"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <line x1="5" y1="12" x2="19" y2="12" />
                    <polyline points="12 5 19 12 12 19" />
                </svg>
            </span>
        </div>
    </article>
</template>

