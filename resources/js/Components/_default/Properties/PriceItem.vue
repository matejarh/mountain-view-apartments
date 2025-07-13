<script setup>
import { icons } from "@/icons"

defineProps({
    price: Object,
})
</script>

<template>
    <li class="flex justify-between items-center">
        <span class="flex items-center">
            <div class="flex">
                <icons.UserIcon class="w-5 h-5" v-for="(n, key) in parseInt(price.guests)" :key="key" />

            </div>
            =
            {{ parseFloat(price.price).toFixed(2).toLocaleString($page.props.locale) }} €
        </span>
    </li>
</template>
