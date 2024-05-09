<script setup>
import { computed, defineAsyncComponent, ref } from 'vue';

const props = defineProps({
    facility: Object,
})

const icon = computed(() => props.facility.has_icon_file ? defineAsyncComponent(() => import(`../../../../Icons/${props.facility.icon}.vue`)) : '')

</script>

<template>
    <div class="flex flex-col  items-center h-full ">
        <component v-if="facility.has_icon_file"  :is="icon" class="w-12 h-12" />
        <h4 class="text-sm leading-tight">{{ facility.name }}</h4>
    </div>
</template>
