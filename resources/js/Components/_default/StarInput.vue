<template>
    <div class="flex items-center gap-2 mt-2 sm:mt-0">
        <div class="flex items-center gap-1 text-gray-300">
            <component v-for="(icon, index) in starComponents" :is="icon.component" :key="index"
                class="w-4 h-4 cursor-pointer" :class="icon.class" @click="setRating(index + 1)" />
            ({{ modelValue }})
        </div>
    </div>
</template>

<script setup>
import { computed, defineEmits } from 'vue';
import { icons } from '@/icons';

const emit = defineEmits(['update:modelValue']);

const props = defineProps({
    modelValue: {
        type: Number,
        default: 0,
    },
    maxStars: {
        type: Number,
        default: 5,
    },
});

const setRating = (value) => {
    emit('update:modelValue', value);
};

const starComponents = computed(() => {
    const components = [];
    const fullStarsCount = Math.floor(props.modelValue);
    const hasHalfStar = props.modelValue % 1 !== 0;
    const emptyStarsCount = props.maxStars - Math.ceil(props.modelValue);

    for (let i = 0; i < fullStarsCount; i++) {
        components.push({ component: icons.StarFullIcon, class: 'text-yellow-300 w-6 h-6' });
    }
    if (hasHalfStar) {
        components.push({ component: icons.StarHalfFullIcon, class: 'text-yellow-300 w-6 h-6' });
    }
    for (let i = 0; i < emptyStarsCount; i++) {
        components.push({ component: icons.StarEmptyIcon, class: 'text-gray-100 w-6 h-6' });
    }

    return components;
});
</script>
