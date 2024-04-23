<script setup>
import ApearDisapearFadeTransition from '@/Transitions/ApearDisapearFadeTransition.vue';
import { computed, onMounted, onUnmounted, ref } from 'vue';

const props = defineProps({
    align: {
        type: String,
        default: 'right',
    },
    width: {
        type: String,
        default: '48',
    },
    contentClasses: {
        type: Array,
        default: () => ['py-1', 'bg-white dark:bg-gray-700'],
    },
});

const show=ref(false)

const closeOnEscape = (e) => {
    if (show.value && e.key === 'Escape') {
        show.value = false;
    }
};

const widthClass = computed(() => {
    return {
        '48': 'w-48',
        '56': 'w-56',
        '64': 'w-64',
        '96': 'w-96',
    }[props.width.toString()];
});

const alignmentClasses = computed(() => {
    if (props.align === 'left') {
        return 'ltr:origin-top-left rtl:origin-top-right start-0';
    }

    if (props.align === 'right') {
        return 'ltr:origin-top-right rtl:origin-top-left end-0';
    }

    return 'origin-top';
});

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));
</script>

<template>
    <div class="relative">
        <button type="button" @click="show=!show"
            class="flex mx-3 text-sm dark:bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
            >
            <slot name="trigger" />

        </button>

        <div v-show="show" class="fixed inset-0 z-40" @click="show = false" />

        <ApearDisapearFadeTransition>

            <div v-show="show"
            class="absolute overflow-hidden z-50 my-4 text-base list-none bg-white  divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
            :class="[alignmentClasses, widthClass]"
            id="dropdown">
                <slot />
            </div>
        </ApearDisapearFadeTransition>

    </div>
</template>
