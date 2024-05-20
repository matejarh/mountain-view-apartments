<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import HeroSection from '@/Pages/Page/_partials/HeroSection.vue';
import ContentSection from '@/Pages/Page/_partials/ContentSection.vue';


</script>

<template>
    <DefaultLayout :title="$page.props?.page?.title[$page.props.locale]"
        :description="$page.props?.page?.description[$page.props.locale]"
        :keywords="$page.props?.page?.keywords[$page.props.locale]"
        :noindex="false">

        <div class="space-y-0">
            <HeroSection />
           <!--  <div class="spacer h-48 w-full"></div> -->
            <ContentSection id="content-section" />
        </div>
    </DefaultLayout>
</template>
