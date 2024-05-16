<script setup>
import { Head, Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { ref } from 'vue';
import PetsIcon from '@/Icons/PetsIcon.vue';
/* import MapCard from '@/Components/MapCard.vue'; */
import MapCard from './Welcome/_partials/MapCard.vue';
import HeroSection from './Welcome/_partials/HeroSection.vue';
import BookNowSection from './Welcome/_partials/BookNowSection.vue';
import OurAccomodationsSection from './Welcome/_partials/OurAccomodationsSection.vue';
import FacilitiesBlock from './Welcome/_partials/FacilitiesBlock.vue';

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
            <HeroSection id="hero" />
            <BookNowSection id="booknow" />
            <!-- <div class="spacer h-48 w-full"></div> -->
            <OurAccomodationsSection id="accomodations"  />
            <div class="spacer h-48 w-full"></div>
            <FacilitiesBlock />
            <div class="spacer h-48 w-full"></div>

        </div>
    </DefaultLayout>

</template>
