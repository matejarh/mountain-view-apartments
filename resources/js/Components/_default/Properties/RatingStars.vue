<script setup>
import StarEmptyIcon from '@/Icons/StarEmptyIcon.vue';
import StarFullIcon from '@/Icons/StarFullIcon.vue';
import StarHalfFullIcon from '@/Icons/StarHalfFullIcon.vue';
import { computed } from 'vue';

const props = defineProps({
    property: Object,
    score: {
        type: Number,
        default: null,
    },
    size: {
        default: 'normal',
        type: String,
    },
    withoutText: {
        default: false,
        type: Boolean,
    },
    onDark: {
        default: false,
        type: Boolean,
    },
})

const score = props.score ? props.score : props.property?.average_review_score
const maxStars = 5

const starComponents = computed(() => {
    const components = [];
    const fullStarsCount = Math.floor(score);
    const hasHalfStar = score % 1 !== 0;
    const emptyStarsCount = maxStars - Math.ceil(score);

    for (let i = 0; i < fullStarsCount; i++) {
        components.push(StarFullIcon);
    }
    if (hasHalfStar) {
        components.push(StarHalfFullIcon);
    }
    for (let i = 0; i < emptyStarsCount; i++) {
        components.push(StarEmptyIcon);
    }

    return components;
});

const sizeClasses = computed(() => {
    return [
        props.size === 'normal' ? 'w-4 h-4' :
        props.size === 'large' ? 'w-8 h-8' : 'w-6 h-6'
     ]
})

const onDarkLinkClasses = computed(() => {
    return [
        props.onDark ? 'text-gray-100 dark:text-white' : 'text-gray-900  dark:text-white'
    ]
})
const onDarkTextClasses = computed(() => {
    return [
        props.onDark ? 'text-gray-300 dark:text-gray-200' : 'text-gray-500 dark:text-gray-400'
    ]
})

</script>

<template>
    <div class="flex items-center gap-2 mt-2 sm:mt-0">
        <div class="flex items-center gap-1">
            <component v-for="(icon, index) in starComponents" :is="icon" :key="index" class=""
                :class="[(icon === StarEmptyIcon ? 'text-gray-200' : 'text-yellow-300'), sizeClasses]" />
        </div>
        <p v-if="!withoutText" class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400" :class="onDarkTextClasses" >
            ({{ property?.average_review_score }})
        </p>
        <inertia-link v-if="!withoutText" :href="route('reviews.index', { property: property, lang: $page.props?.locale })" :class="onDarkLinkClasses" class="text-sm font-medium leading-none  underline hover:no-underline ">
            {{ property?.reviews.length }} {{ __('Review', property?.reviews.length) }}
        </inertia-link>
    </div>
</template>
