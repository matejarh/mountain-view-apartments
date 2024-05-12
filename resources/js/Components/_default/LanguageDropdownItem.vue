<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    language: Object,
})


const path = computed(() => {
    const originalUrl = window?.location.pathname

    const segments = originalUrl.split('/');

    segments.splice(0,2)

    let newPath = `/${props.language?.code}`

    if (segments.length > 0) {
        segments.forEach(segment => {
            newPath += `/${segment}`
        });
    }

    return newPath
})
//defineEmits(['selected'])
</script>

<template>
    <li>
        <inertia-link :href="`${path}`"
            class="block w-full px-4 py-2 text-left text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-600 dark:hover:text-white"
            role="menuitem">
            <!-- @click="$emit('selected', language)"> -->
            <div class="inline-flex items-center justify-start">
                <img :src="language.flag_url" class="h-3.5 w-3.5 rounded-full me-2">
                {{ language.name }}
            </div>
        </inertia-link>
    </li>
</template>
