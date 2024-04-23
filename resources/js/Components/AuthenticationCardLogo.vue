<script setup>
import { Link } from '@inertiajs/vue3';
import LogoComponent from './LogoComponent.vue';
</script>

<template>
    <Link :href="'/'">
        <LogoComponent />
    </Link>
</template>
