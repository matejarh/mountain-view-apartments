<script setup>
defineProps({
    accomodation: Object,
})
defineEmits(['selected'])
</script>

<template>
    <li>
        <button type="button"
            class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
            role="menuitem"
            @click="$emit('selected', accomodation)">
            <div class="inline-flex items-center justify-start">
                <img :src="accomodation.avatar_url" class="h-7 w-auto rounded-sm me-2">
                <div class="leading-tight">
                    <p class="font-base">
                        {{ __(accomodation.type) }}

                    </p>
                    <p class="font-semibold">

                        {{ accomodation.title[$page.props.locale] }}
                    </p>

                </div>
            </div>
        </button>
    </li>
</template>
