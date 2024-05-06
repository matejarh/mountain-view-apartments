<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { ref } from 'vue';
import PetsIcon from '@/Icons/PetsIcon.vue';

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
            <div :class="{ 'animate-shake': disabled }" class="mx-auto max-w-screen-lg">
                <button @click="warnDisabled">Click me</button>
                <span v-if="disabled">This feature is disabled!</span>
            </div>

            <PetsIcon class="w-20 h-20 text-red-500 block mx-auto"/>
        </div>
    </DefaultLayout>

</template>
