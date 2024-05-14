<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    images: Array,
})

const featured = ref({image: props.images[0], key: 0})

onMounted(() => {
    //featured.value = { image: props.images[0], key: 0 }
})
</script>

<template>
    <div class="grid gap-4">
        <div>
            <img class="h-auto max-w-full rounded-lg cursor-zoom-in transition-all" :src="featured.image?.photo_url"
                :alt="featured.image?.title" @click="$emit('clicked', featured)">
        </div>
        <div class="relative w-full overflow-y-auto scrollbar-thin rounded-lg ">
            <div class="relative flex flex-nowrap">
                <div v-for="image, key in images" :key="image.id" @click="featured = { image: image, key: key }"
                    class="cursor-pointer w-32 flex-shrink-0 brightness-90 hover:brightness-105 transition-all ease-out duration-150">
                    <img class="h-auto max-w-full rounded-0" :src="image?.thumb_url" :alt="image?.title">
                </div>
            </div>

        </div>
    </div>
</template>
