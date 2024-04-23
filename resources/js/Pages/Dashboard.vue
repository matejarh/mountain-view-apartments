<script setup>
import GridSection from '@/Components/GridSection.vue';
import Welcome from '@/Components/Welcome.vue';
import FullLayout from '@/Layouts/FullLayout.vue';
</script>

<template>
    <FullLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __("Dashboard") }}
            </h2>
        </template>


        <!-- <Welcome /> -->
        <GridSection />

    </FullLayout>
</template>
