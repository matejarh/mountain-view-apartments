<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
</script>

<template>
    <DefaultLayout :title="$page.props.seo?.title"
        :description="$page.props.seo?.description"
        :keywords="$page.props.seo?.keywords">

        <div class="space-y-0">

        </div>
    </DefaultLayout>
</template>
