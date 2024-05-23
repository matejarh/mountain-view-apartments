<script setup>
import { icons } from '@/icons'
defineProps({
    item: Object
})
</script>

<template>
    <div class="">
        {{ item?.owner.name }}
        {{ __('Deleted Review') }}
    </div>
</template>
