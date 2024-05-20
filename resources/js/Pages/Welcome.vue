<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { ref } from 'vue';
import HeroSection from './Welcome/_partials/HeroSection.vue';
import BookNowSection from './Welcome/_partials/BookNowSection.vue';
import OurAccomodationsSection from './Welcome/_partials/OurAccomodationsSection.vue';
import FacilitiesBlock from './Welcome/_partials/FacilitiesBlock.vue';
import VideoSection from './Welcome/_partials/VideoSection.vue';
import SpecialOfferSection from './Welcome/_partials/SpecialOfferSection.vue';
import MapSection from './Welcome/_partials/MapSection.vue';
import DiscoverSection from './Welcome/_partials/DiscoverSection.vue';
import ShapedSection from '@/Components/_default/ShapedSection.vue';
import ReviewsSection from './Welcome/_partials/ReviewsSection.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});

const disabled = ref(false)

function warnDisabled() {
    disabled.value = true
    setTimeout(() => {
        disabled.value = false
    }, 1500)
}

</script>

<template>
    <DefaultLayout :title="$page.props.page?.title[$page.props.locale]"
        :description="$page.props.page?.description[$page.props.locale]"
        :keywords="$page.props.page?.keywords[$page.props.locale]">

        <div class="space-y-0">
            <HeroSection id="hero" class="z-10" />
            <!-- <div class="spacer h-48 w-full"></div> -->
            <ShapedSection :color="{light:'white', dark: 'gray-900'}" class="z-20" ><h3 class="mb-4 text-3xl text-center font-extrabold tracking-tight leading-none text-gray-900 md:text-4xl lg:text-5xl dark:text-white">{{ __('Find Us On The Map') }}</h3></ShapedSection>
            <MapSection id="map" :properties="$page.props.accomodations" class="z-0" />
            <ShapedSection :color="{light:'primary-700', dark: 'primary-900'}" ></ShapedSection>
            <DiscoverSection id="discover" />
            <SpecialOfferSection id="offers" />
            <ReviewsSection id="reviews" />
            <VideoSection id="video" />
            <!-- <MapTest :properties="$page.props.accomodations" /> -->
<!--             <OurAccomodationsSection id="accomodations"  />
            <FacilitiesBlock /> -->

<!--             <BookNowSection id="booknow" /> -->



        </div>
    </DefaultLayout>

</template>
