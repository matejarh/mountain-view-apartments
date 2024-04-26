<script setup>
import GridSection from '@/Components/GridSection.vue';
import Welcome from '@/Components/Welcome.vue';
import FullLayout from '@/Layouts/FullLayout.vue';
import Index from './Users/Index.vue';

const props = defineProps({
    users: Object,
    links: String,
    filters: Object,
})
</script>

<template>
    <FullLayout :title="__('Users')">


        <Index />
        <!-- <Welcome /> -->
        <!-- <GridSection /> -->

    </FullLayout>
</template>
