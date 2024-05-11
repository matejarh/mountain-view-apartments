<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    enterActiveClass: {
        default: 'animate__animated animate__zoomInDown',
        type: String
    },
    leaveActiveClass: {
        default: 'animate__animated animate__zoomOutUp',
        type: String
    },
    minHeight: {
        default: 'min-h-[20vh]',
        type: String,
    },
    delay: {
        type: Number,
        default: 0,
    }
})

const target = ref();
const animate = ref(false);

const observer = new IntersectionObserver(([entry]) => {
    const { isIntersecting } = entry;
    if (isIntersecting) {
        if (props.delay > 0) {
            setTimeout(() => {
                animate.value = isIntersecting;

            }, props.delay);
        } else {
            animate.value = isIntersecting;

        }
    }
}, {
    threshold: 0.8
});

onMounted(() => {
    observer.observe(target.value);
});
</script>

<template>
    <div ref="target" :class="minHeight">
        <Transition :enter-active-class="enterActiveClass" :leave-active-class="leaveActiveClass"
         >
            <div v-if="animate">
                <slot />
            </div>
        </Transition>

    </div>
</template>
