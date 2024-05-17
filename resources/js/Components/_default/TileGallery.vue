<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    images: Array,
})

defineEmits(['clicked'])

const groupedImages = computed(() => {
    return groupArrayIntoThreeGroups(props.images);
})

const groupArrayIntoThreeGroups = (array) => {
    const groups = [[], [], []];
    const groupSize = Math.ceil(array.length / 3);

    for (let i = 0; i < array.length; i++) {
        const groupIndex = Math.floor(i / groupSize);
        groups[groupIndex].push({image:array[i],key:i});
    }

    return groups;
}
</script>

<template>
    <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-3 gap-4">
        <div class="grid gap-4" v-for="group, key in groupedImages" :key="key">
            <div v-for="image in group" :key="image.id" @click="$emit('clicked', { image: image.image, key: image.key })" class="brightness-90 hover:brightness-105 transition-all ease-out duration-150">
                <img class="h-auto w-full rounded-lg shadow-lg"
                    :src="image.image.tile_url" :alt="image.image.name">
            </div>
        </div>
    </div>
</template>
