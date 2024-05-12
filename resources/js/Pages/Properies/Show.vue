<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import HeroSection from './_partials/HeroSection.vue';
import AvailabilityCalendar from './_partials/AvailabilityCalendar.vue';
import InfoSection from './_partials/InfoSection.vue';


</script>

<template>
    <DefaultLayout :title="$page.props.property?.title[$page.props.locale]"
        :description="$page.props.property?.seo_description[$page.props.locale]"
        :keywords="$page.props.property?.keywords[$page.props.locale]">

        <div class="space-y-0">
            <HeroSection />
            <AvailabilityCalendar id="availability" />
            <div class="spacer h-48 w-full"></div>
            <InfoSection id="info" />
            <div class="spacer h-48 w-full"></div>
        </div>
    </DefaultLayout>
</template>
