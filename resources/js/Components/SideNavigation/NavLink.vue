<script setup>
import { Link } from '@inertiajs/vue3';
import { onBeforeMount, ref } from 'vue';

const props = defineProps({
    href:String
})

const active = ref(false)

onBeforeMount(() => {
    active.value = window.location.href === props.href
})
</script>

<template>
    <li>
        <Link :href="href"
            :class="{'bg-primary-600 hover:bg-primary-500 text-white dark:bg-primary-800 dark:hover:bg-primary-900': active}"
            class="flex items-center transition-color p-2 text-base font-medium text-gray-900 rounded-lg md:rounded-r-none dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <div v-if="$slots.icon"

             class="w-6 h-6 text-gray-500 transition-color duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
             :class="{'text-white group-hover:text-white dark:text-white dark:group-hover:text-white  ': active}"
             >

                <slot name="icon" />

            </div>

            <span class="ml-3"><slot /></span>
        </Link>
    </li>
</template>
