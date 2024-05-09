<script setup>
import { computed } from 'vue';

defineProps({
    orientation: {
        default: 'horizontal',
        type: String,
    },
})

const translate = computed(() => {
    return 'translateY(50px)'
})
</script>

<template>
    <TransitionGroup name="list" tag="ul">
        <slot />
    </TransitionGroup>

</template>

<style scoped>
.list-move,
/* apply transition to moving elements */
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateY(50px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-leave-active {
    position: absolute;
}
</style>
