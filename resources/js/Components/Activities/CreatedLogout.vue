<script setup>
defineProps({
    item: Object
})
</script>

<template>
    <div class="">
        {{ item?.owner.name }}
        {{ __('Logged Out') }}
    </div>
</template>
