<script setup>
import FullLayout from '@/Layouts/FullLayout.vue';

const props = defineProps({
    users: Object,
    links: String,
    filters: Object,
})
</script>

<template>
    <FullLayout :title="__('Reviews')">


    </FullLayout>
</template>
