<template>
    <div class="carousel__item" @click="">
        <img :src="imageSrc" class="w-auto h-full">
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'

const props = defineProps({
    imageUrl: String,
})

const img = new Image(512, 366)
const imageSrc = ref(null)

onMounted(() => {
    img.src = props?.imageUrl
    img.onload = () => {
        imageSrc.value = props?.imageUrl
    }
})
</script>
