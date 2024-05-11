<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import HeroSection from './_partials/HeroSection.vue';


</script>

<template>
    <DefaultLayout :title="$page.props.property?.title[$page.props.locale]"
        :description="$page.props.property?.description[$page.props.locale]"
        :keywords="$page.props.property?.keywords[$page.props.locale]">

        <div class="space-y-0">
            <HeroSection />
        </div>
    </DefaultLayout>
</template>
