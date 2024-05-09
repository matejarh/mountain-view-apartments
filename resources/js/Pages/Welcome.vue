<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { ref } from 'vue';
import PetsIcon from '@/Icons/PetsIcon.vue';
/* import MapCard from '@/Components/MapCard.vue'; */
import MapCard from './Welcome/_partials/MapCard.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

const disabled = ref(false)

function warnDisabled() {
    disabled.value = true
    setTimeout(() => {
        disabled.value = false
    }, 1500)
}

</script>

<template>
    <DefaultLayout :title="__('Welcome')">
        <div class="space-y-0">

        </div>
    </DefaultLayout>

</template>
