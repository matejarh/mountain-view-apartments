<script setup>
defineProps({
    isLast: {
        type: Boolean,
        default: false
    },
    isFirst: {
        type: Boolean,
        default: false
    },
    isShowing: {
        type: Boolean,
        default: false
    }

})
</script>

<template>
    <h2>
        <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200  focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
            :class="[{ 'border-b-0' : !isLast && isShowing }, {'rounded-t-xl' : isFirst}]" >
            <span><slot /></span>

            <svg data-accordion-icon class="w-6 h-6  shrink-0 transition-transform  " :class="{'rotate-180' : isShowing}" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </h2>
</template>
