<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    page:Object,
})

const page = usePage()

const extrasKey = computed(() => {

    return page.props?.page.name.toLocaleLowerCase().replace(' ', '_')
})
</script>

<template>
    <div class=" dark:text-white py-28">
        <article class="md:max-w-screen-lg mx-auto format p-4 bg-gray-50 dark:bg-gray-800 rounded-lg" v-html="$page.props.page.extras[extrasKey].text[$page.props.locale]"></article>
        <!-- {{ $page.props.page.extras[$page.props.page.slug.replace('-','_')] }} -->
    </div>
</template>
