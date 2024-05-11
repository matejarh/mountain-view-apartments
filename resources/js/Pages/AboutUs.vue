<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import HeroSection from './AboutUs/_partials/HeroSection.vue';


</script>

<template>
    <DefaultLayout :title="$page.props.page?.title[$page.props.locale]"
        :description="$page.props.page?.description[$page.props.locale]"
        :keywords="$page.props.page?.keywords[$page.props.locale]">

        <div class="space-y-0">
            <HeroSection />
            <div class="spacer h-48 w-full"></div>
        </div>
    </DefaultLayout>
</template>
