<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

</script>

<template>
    <DefaultLayout :title="__('Welcome')">
        <div class="space-y-0 ">

        </div>
    </DefaultLayout>

</template>
