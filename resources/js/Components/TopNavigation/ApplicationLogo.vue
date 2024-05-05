<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';
import LogoComponent from '@/Components/LogoComponent.vue';

const props = defineProps({
    size: {
        default: 'default',
        type: String,
    }
})

const appName = import.meta.env.VITE_APP_NAME

const appNameSplit = computed(() => {
    return appName.split(' ')
})
</script>

<template>
    <Link :href="route('dashboard.show')" class="flex items-center justify-between mr-4">
        <LogoComponent :scroll-position="150" :show-title="false" :is-administration="true"  />

    </Link>
</template>
