<script setup>
import PriceItem from './PriceItem.vue';
import DiscountItem from './DiscountItem.vue';
</script>

<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div :class="{'border-amazon-500 dark:border-amazon-400 bg-amazon-200 bg-opacity-20 dark:bg-amazon-400 dark:bg-opacity-25' : item.is_active}" v-for="item, key in $page.props.property.prices.sort((a, b) => new Date(b.from) - new Date(a.from))"
            :key="key"
            class="max-w-full p-4 bg-white border border-gray-200 overflow-hidden rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700  transition duration-150 ease-out">
            <div class="flex justify-between items-center">
                <h5 class="text-md font-semibold">
                    {{ new Date(item.from).toLocaleDateString($page.props.locale) }}
                    -
                    {{ new Date(item.to).toLocaleDateString($page.props.locale) }}
                </h5>

            </div>

            <div class="flex items-center justify-between mt-1">
                <p>{{ __('Min Nights') }} {{ item.min_days }}</p>
                <p>{{ __('Max Nights') }} {{ item.max_days }}</p>

            </div>

            <TransitionGroup name="list" tag="ul" class="relative mt-2" key="discountsGroup"
                v-if="item.discounts && item.discounts.length > 0">
                <DiscountItem v-for="discount, key in item.discounts" :key="discount" :discount="discount" />
            </TransitionGroup>

            <ul class="mt-2">
                <PriceItem v-for="price, key in item.prices" :key="key" :price="price" />
            </ul>

        </div>

    </div>
</template>
