<script setup>
import { icons } from '@/icons'
</script>

<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div v-for="item, key in $page.props.property.prices.sort((a, b) => new Date(b.from) - new Date(a.from))" :key="key"
            class="max-w-full p-4 bg-white border border-gray-200 overflow-hidden rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700  transition duration-150 ease-out">
            <div class="flex justify-between items-center">
                <h5 class="text-md font-semibold">
                    {{ new Date(item.from).toLocaleDateString($page.props.locale) }}
                    -
                    {{ new Date(item.to).toLocaleDateString($page.props.locale) }}
                </h5>

            </div>

            <ul >
                <li v-for="price, key in item.prices" :key="key" class="flex justify-between items-center">
                    <span class="flex items-center">
                        <div class="flex">
                            <icons.UserIcon class="w-5 h-5" v-for="n in parseInt(price.guests)" :key="key" />

                        </div>
                        =
                        {{ parseFloat(price.price).toFixed(2).toLocaleString($page.props.locale) }} €
                    </span>
                </li>
            </ul>

        </div>

    </div>
</template>
