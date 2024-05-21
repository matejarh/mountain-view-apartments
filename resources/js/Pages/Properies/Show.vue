<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import HeroSection from './_partials/HeroSection.vue';
import AvailabilityCalendar from './_partials/AvailabilityCalendar.vue';
import InfoSection from './_partials/InfoSection.vue';
import PricesSection from './_partials/PricesSection.vue';
import MapSection from './_partials/MapSection.vue';
import HouseRules from './_partials/HouseRules.vue';
import FacilitiesSection from './_partials/FacilitiesSection.vue';



</script>

<template>
    <DefaultLayout :title="$page.props?.property?.title[$page.props?.locale]"
        :description="$page.props?.property?.seo_description[$page.props?.locale]"
        :keywords="$page.props?.property?.keywords[$page.props?.locale]" :noindex="false">

        <div class="space-y-0">
            <HeroSection />
            <!-- <div class="spacer h-48 w-full"></div> -->
            <InfoSection id="info" class="z-20" />
            <MapSection class="mt-6 h-[28rem] z-0" />
            <AvailabilityCalendar id="availability" class="pb-20" />
            <HouseRules id="rules" class="z-20" />
            <div class="spacer h-48 w-full"></div>
            <FacilitiesSection id="facilities" class="pt-12"/>
            <PricesSection id="prices" class="pt-12"/>
            <div class="spacer h-48 w-full"></div>
        </div>
    </DefaultLayout>
</template>
