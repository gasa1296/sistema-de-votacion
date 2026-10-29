import { router } from '@inertiajs/vue3';
import { onMounted, onUnmounted } from 'vue';

export function useElectionPoll(intervalMs = 10000) {
    let pollTimer: ReturnType<typeof setInterval> | null = null;

    async function checkElectionStatus() {
        try {
            const res = await fetch('/api/election-status', {
                headers: {
                    Accept: 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });

            if (res.ok) {
                const data = await res.json();

                if (data.is_open) {
                    if (pollTimer) {
                        clearInterval(pollTimer);
                        pollTimer = null;
                    }

                    router.visit('/');
                }
            }
        } catch {
            // Silently ignore polling network errors
        }
    }

    onMounted(() => {
        pollTimer = setInterval(checkElectionStatus, intervalMs);
    });

    onUnmounted(() => {
        if (pollTimer) {
            clearInterval(pollTimer);
            pollTimer = null;
        }
    });
}
