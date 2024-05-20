<script setup>
const props = defineProps({
    href: {
        type:String,
        default:null,
    },
    as: {
        type:String,
        default:'li',
    },
    active: {
        type: [String, Boolean],
        default:false,
    },

})

defineEmits(['clicked'])
</script>

<template>
    <component :is="as" v-if="href">
        <inertia-link @click="$emit('clicked')" :href="href"
        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
            :class="{'bg-gray-100 dark:bg-gray-700' : $page.url === active}">

            <div class="text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
            :class="{'text-gray-900 dark:text-white' : $page.url === active}">
                <slot name="icon" />
            </div>

            <span class="ms-3"><slot /></span>
        </inertia-link>
    </component>

    <component :is="as" v-else>
        <button @click="$emit('clicked')"
        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
            :class="{'bg-gray-100 hover:bg-gray-700' : $page.url === active}">

            <div class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
            :class="{'text-gray-900 dark:text-white' : $page.url === active}">
                <slot name="icon" />
            </div>

            <span class="ms-3"><slot /></span>
        </button>
    </component>
</template>
