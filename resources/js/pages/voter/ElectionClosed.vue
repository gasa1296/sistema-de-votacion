<script setup lang="ts">
import StatusPage from '@/components/Voter/StatusPage.vue';
import { useElectionPoll } from '@/composables/useElectionPoll';

useElectionPoll(10000);
</script>

<template>
    <StatusPage
        tone="danger"
        icon="ban"
        title="Elección cerrada"
        description="No hay elecciones abiertas en este momento. Por favor, intenta más tarde."
    />
</template>
