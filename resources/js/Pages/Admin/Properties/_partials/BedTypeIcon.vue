<script setup>
import { computed, defineAsyncComponent, ref } from 'vue';

const props = defineProps({
    icon: String,
})

const icon = computed(() => defineAsyncComponent(() => import(`../../../../Icons/${props.icon}.vue`)))

</script>

<template>
    <component :is="icon" class="w-8 h-8" />
</template>
