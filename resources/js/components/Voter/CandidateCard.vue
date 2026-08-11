<script setup lang="ts">
import { computed } from 'vue';
import type { Candidate } from '@/types';

const props = withDefaults(defineProps<{
    candidate: Candidate;
    selected?: boolean;
    isBlank?: boolean;
}>(), {
    selected: false,
    isBlank: false,
});

const emit = defineEmits<{
    select: [candidate: Candidate];
    viewProfile: [candidate: Candidate];
}>();

const fullName = computed(() =>
    `${props.candidate.name} ${props.candidate.last_name ?? ''}`.trim(),
);

function handleKeydown(event: KeyboardEvent) {
    if (event.key === 'Enter' || event.key === ' ') {
        event.preventDefault();
        emit('select', props.candidate);
    }
}

function handlePhotoClick(event: Event) {
    event.stopPropagation();
    if (!props.isBlank) {
        emit('viewProfile', props.candidate);
    }
}
</script>

<template>
    <div
        tabindex="0"
        role="button"
        :aria-label="`Seleccionar a ${fullName}`"
        :aria-pressed="selected"
        class="group flex items-center gap-4 rounded-2xl border-2 p-4 transition-all duration-200 cursor-pointer"
        :class="selected
            ? 'border-[#bd1622] bg-[#bd1622]/5 shadow-md'
            : 'border-gray-200 bg-white hover:border-gray-300 hover:shadow-sm'"
        @click="emit('select', candidate)"
        @keydown="handleKeydown"
    >
        <!-- Candidate Photo -->
        <div
            class="relative shrink-0"
            :class="!isBlank ? 'cursor-pointer' : ''"
            @click="handlePhotoClick"
        >
            <template v-if="!isBlank">
                <img
                    v-if="candidate.photo_path"
                    :src="`/storage/${candidate.photo_path}`"
                    :alt="fullName"
                    class="h-16 w-16 rounded-2xl object-cover"
                    loading="lazy"
                />
                <div
                    v-else
                    class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-br from-[#bd1622] to-[#e23036] text-xl font-bold text-white"
                >
                    {{ fullName.charAt(0) }}
                </div>
            </template>
            <template v-else>
                <div
                    class="flex h-16 w-16 items-center justify-center rounded-2xl bg-gray-100 text-gray-400"
                >
                    <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="4" width="20" height="16" rx="2" />
                        <path d="M12 11v4" />
                        <path d="M10 13h4" />
                        <path d="M8 4V2" />
                        <path d="M16 4V2" />
                    </svg>
                </div>
            </template>
        </div>

        <!-- Candidate Info -->
        <div class="min-w-0 flex-1">
            <h3 class="text-base font-bold text-gray-900">
                {{ fullName }}
            </h3>
            <p
                v-if="candidate.position"
                class="text-sm font-medium text-[#bd1622]"
            >
                {{ candidate.position }}
            </p>
            <p
                v-if="candidate.description"
                class="mt-1 text-sm text-gray-500 italic line-clamp-2"
            >
                "{{ candidate.description }}"
            </p>
        </div>

        <!-- Radio Button -->
        <div class="shrink-0">
            <div
                class="flex h-6 w-6 items-center justify-center rounded-full border-2 transition-colors"
                :class="selected
                    ? 'border-[#bd1622] bg-[#bd1622]'
                    : 'border-gray-300 group-hover:border-gray-400'"
            >
                <div
                    v-if="selected"
                    class="h-2.5 w-2.5 rounded-full bg-white"
                />
            </div>
        </div>
    </div>
</template>
