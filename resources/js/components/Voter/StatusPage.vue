<script setup lang="ts">
import { computed, ref, onMounted, onUnmounted } from 'vue';

interface ResultItem {
    name: string;
    votes: number;
    percentage: number;
    position?: string;
}

const props = withDefaults(
    defineProps<{
        tone?: 'success' | 'info' | 'warning' | 'danger' | 'neutral';
        icon: 'check' | 'info' | 'clock' | 'ban' | 'vote';
        title: string;
        description: string;
        note?: string;
        results?: ResultItem[];
    }>(),
    { tone: 'neutral', results: () => [] },
);

const liveResults = ref<ResultItem[]>([]);

const displayResults = computed<ResultItem[]>(() =>
    liveResults.value.length > 0 ? liveResults.value : props.results,
);

let pollTimer: ReturnType<typeof setInterval> | null = null;

onMounted(() => {
    if (props.results.length > 0) {
        pollTimer = setInterval(async () => {
            try {
                const res = await fetch('/api/results');
                if (res.ok) {
                    const data = await res.json();
                    liveResults.value = data.results ?? [];
                }
            } catch {
                // Polling error — keep last known results
            }
        }, 5000);
    }
});

onUnmounted(() => {
    if (pollTimer) clearInterval(pollTimer);
});

const maxVotes = computed(() =>
    Math.max(...displayResults.value.map((r) => r.votes), 1),
);

const toneClass: Record<
    'success' | 'info' | 'warning' | 'danger' | 'neutral',
    {
        iconBg: string;
        iconText: string;
        noteBg: string;
        noteText: string;
        noteBorder: string;
    }
> = {
    success: {
        iconBg: 'bg-emerald-100 dark:bg-emerald-900/40',
        iconText: 'text-emerald-600 dark:text-emerald-400',
        noteBg: 'bg-emerald-50/70 dark:bg-emerald-950/30',
        noteText: 'text-emerald-800 dark:text-emerald-200',
        noteBorder: 'border-emerald-200/60 dark:border-emerald-900/50',
    },
    info: {
        iconBg: 'bg-brand-100 dark:bg-brand-900/40',
        iconText: 'text-brand-600 dark:text-brand-400',
        noteBg: 'bg-brand-50/70 dark:bg-brand-950/30',
        noteText: 'text-brand-800 dark:text-brand-200',
        noteBorder: 'border-brand-200/60 dark:border-brand-900/50',
    },
    warning: {
        iconBg: 'bg-amber-100 dark:bg-amber-900/40',
        iconText: 'text-amber-600 dark:text-amber-400',
        noteBg: 'bg-amber-50/70 dark:bg-amber-950/30',
        noteText: 'text-amber-800 dark:text-amber-200',
        noteBorder: 'border-amber-200/60 dark:border-amber-900/50',
    },
    danger: {
        iconBg: 'bg-rose-100 dark:bg-rose-900/40',
        iconText: 'text-rose-600 dark:text-rose-400',
        noteBg: 'bg-rose-50/70 dark:bg-rose-950/30',
        noteText: 'text-rose-800 dark:text-rose-200',
        noteBorder: 'border-rose-200/60 dark:border-rose-900/50',
    },
    neutral: {
        iconBg: 'bg-gray-100 dark:bg-gray-800',
        iconText: 'text-gray-600 dark:text-gray-400',
        noteBg: 'bg-gray-50 dark:bg-gray-900/50',
        noteText: 'text-gray-700 dark:text-gray-300',
        noteBorder: 'border-gray-200 dark:border-gray-800',
    },
};
</script>

<template>
    <div class="flex min-h-[60vh] items-center justify-center py-12">
        <div class="w-full max-w-md text-center">
            <div
                class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl shadow-sm"
                :class="toneClass[tone].iconBg"
            >
                <svg
                    v-if="icon === 'check'"
                    class="h-8 w-8"
                    :class="toneClass[tone].iconText"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2.5"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <polyline points="20 6 9 17 4 12" />
                </svg>
                <svg
                    v-else-if="icon === 'info'"
                    class="h-8 w-8"
                    :class="toneClass[tone].iconText"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="16" x2="12" y2="12" />
                    <line x1="12" y1="8" x2="12.01" y2="8" />
                </svg>
                <svg
                    v-else-if="icon === 'clock'"
                    class="h-8 w-8"
                    :class="toneClass[tone].iconText"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
                </svg>
                <svg
                    v-else-if="icon === 'ban'"
                    class="h-8 w-8"
                    :class="toneClass[tone].iconText"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <circle cx="12" cy="12" r="10" />
                    <line x1="4.93" y1="4.93" x2="19.07" y2="19.07" />
                </svg>
                <svg
                    v-else
                    class="h-8 w-8"
                    :class="toneClass[tone].iconText"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
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
                class="mt-6 text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl dark:text-white"
            >
                {{ title }}
            </h1>
            <p
                class="mt-3 text-sm text-gray-600 sm:text-base dark:text-gray-400"
            >
                {{ description }}
            </p>

            <div
                v-if="note"
                class="mt-6 rounded-xl border p-4 text-left text-sm"
                :class="[
                    toneClass[tone].noteBg,
                    toneClass[tone].noteBorder,
                    toneClass[tone].noteText,
                ]"
                role="note"
            >
                {{ note }}
            </div>

            <!-- Results Chart -->
            <div
                v-if="displayResults.length > 0"
                class="mt-8 space-y-3 text-left"
            >
                <h2
                    class="text-center text-sm font-semibold uppercase tracking-wider text-gray-500"
                >
                    Resultados parciales
                </h2>
                <div
                    v-for="item in displayResults"
                    :key="item.name"
                    class="rounded-xl border border-gray-100 bg-white p-3 shadow-xs"
                >
                    <div class="flex items-center justify-between gap-2 text-sm">
                        <span class="truncate font-medium text-gray-900">
                            {{ item.name }}
                        </span>
                        <span class="shrink-0 text-xs font-semibold text-gray-500">
                            {{ item.votes }} votos ({{ item.percentage }}%)
                        </span>
                    </div>
                    <div class="mt-1.5 h-2.5 w-full overflow-hidden rounded-full bg-gray-100">
                        <div
                            class="h-full rounded-full bg-linear-to-r from-brand-400 to-brand-600 transition-all duration-700"
                            :style="{ width: `${(item.votes / maxVotes) * 100}%` }"
                        />
                    </div>
                </div>
            </div>

            <div
                v-if="$slots.actions"
                class="mt-8 flex flex-col items-center gap-3 sm:flex-row sm:justify-center"
            >
                <slot name="actions" />
            </div>
        </div>
    </div>
</template>
