<script setup>
defineEmits(['clicked'])
</script>

<template>
    <div class="grid grid-cols-3 gap-1">
        <img v-for="image in $page.props.property.galleries[0].images" :src="image.thumb_url" @click="$emit('clicked', image)" class="cursor-pointer rounded-lg" />
    </div>
</template>
