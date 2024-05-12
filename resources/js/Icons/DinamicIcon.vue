<script setup>
import { computed, defineAsyncComponent, ref } from 'vue';

const props = defineProps({
    icon: String,
})

const icon = computed(() => defineAsyncComponent(() => import(`./${props.icon}.vue`)))

</script>

<template>
    <component :is="icon"  />
</template>
