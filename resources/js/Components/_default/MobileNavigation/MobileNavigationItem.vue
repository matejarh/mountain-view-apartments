<script setup>
import { useHelperStore } from '@/stores/helpers';
import { computed } from 'vue';

const props = defineProps({
    href: {
        type:String,
        default:null,
    },
    active: {
        type: [String, Boolean],
        default:false,
    },

})

defineEmits(['clicked'])

const url = computed(() => {
    return props.href.replace(location.origin, '')
})
</script>

<template>
    <li>
        <inertia-link @click="$emit('clicked')" v-if="href" :href="href"
        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
            :class="{'bg-gray-100 hover:bg-gray-700' : $page.url === active}">

            <div class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
            :class="{'text-gray-900 dark:text-white' : $page.url === active}">
                <slot name="icon" />
            </div>

            <span class="ms-3"><slot /></span>
        </inertia-link>
    </li>
    <!-- <inertia-link v-if="href" :href="href"
        class="inline-flex flex-col items-center justify-center px-5 border-gray-200 border-x hover:bg-gray-50 dark:hover:bg-gray-800 group dark:border-gray-600"
        :class="{'bg-gray-50 dark:bg-gray-800' : $page.url === active}">
        <div
            class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-deep-cerulean-600 dark:group-hover:text-deep-cerulean-500">
            <slot name="icon" />

        </div>

        <span
            class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-deep-cerulean-600 dark:group-hover:text-deep-cerulean-500">
            <slot />
        </span>
    </inertia-link>
    <button v-else
        class="inline-flex flex-col items-center justify-center px-5 border-gray-200 border-x hover:bg-gray-50 dark:hover:bg-gray-800 group dark:border-gray-600"
        :class="{'bg-gray-50 dark:bg-gray-800' : active}">
        <div
            class="w-5 h-5 mb-2 text-gray-500 dark:text-gray-400 group-hover:text-deep-cerulean-600 dark:group-hover:text-deep-cerulean-500">
            <slot name="icon" />
        </div>

        <span
            class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-deep-cerulean-600 dark:group-hover:text-deep-cerulean-500">
            <slot />
        </span>
    </button> -->
</template>
