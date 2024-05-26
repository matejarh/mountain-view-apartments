<script setup>
import ActivityItem from './_partials/ActivityItem.vue';
</script>

<template>
    <ol class="relative border-s border-gray-200 dark:border-gray-700">
        <ActivityItem v-for="activity, key in $page.props?.activities.data" :item="activity" />
    </ol>
</template>
