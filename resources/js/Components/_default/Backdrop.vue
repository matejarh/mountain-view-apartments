<script setup>
defineProps({
    show: {
        type: Boolean,
        default: false
    }
})

defineEmits(['close'])
</script>

<template>
    <transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0" enter-to-class="opacity-100"
        leave-active-class="ease-in duration-200" leave-from-class="opacity-100" leave-to-class="opacity-0">
        <div v-show="show" class="fixed backdrop-blur inset-0 transform transition-all" @click="$emit('close')">
            <div class="absolute inset-0 bg-gray-950 opacity-75" />
        </div>
    </transition>
</template>
