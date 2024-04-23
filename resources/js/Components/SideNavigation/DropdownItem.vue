<script setup>
import { Link } from '@inertiajs/vue3';
import { onBeforeMount, ref } from 'vue';

const props = defineProps({
    href:String,
})
const active = ref(false)

onBeforeMount(() => {
    active.value = window.location.href === props.href
})
</script>

<template>
    <li>
        <Link :href="href"
        :class="{'bg-gray-100 dark:bg-gray-700': $page.url.startsWith(props.href)}"
            class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-l-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"><slot /></Link>
    </li>
</template>
