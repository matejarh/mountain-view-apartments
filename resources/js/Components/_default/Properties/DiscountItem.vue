<script setup>
defineProps({
    discount: Object,
})
</script>

<template>
    <li class="flex justify-between items-center">
        <span class="flex items-center text-sm">
            {{ discount.discount }}
            {{ __('discount') }}
            {{ __('for') }}
            {{ discount.days }}
            {{ __('night', discount.days) }}
            {{ __('or more') }}
        </span>
    </li>
</template>
