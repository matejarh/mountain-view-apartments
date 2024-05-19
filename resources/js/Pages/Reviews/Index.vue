<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import ReviewCard from '@/Components/_default/Reviews/ReviewCard.vue'
import HeroSection from './_partials/HeroSection.vue';
import ShapedSection from '@/Components/_default/ShapedSection.vue';
import Wrapper from '@/Components/_default/Wrapper.vue';
</script>

<template>
    <DefaultLayout :title="$page.props.seo?.title" :description="$page.props.seo?.description"
        :keywords="$page.props.seo?.keywords">

        <div class="space-y-0">
            <HeroSection />
            <ShapedSection :color="{dark:'primary-900', light:'primary-700'}">
                <div class="py-8 lg:py-16 mx-auto max-w-screen-md px-4">

                    <ReviewCard v-for="review in $page.props.reviews.data" :key="review.id" :review="review"></ReviewCard>
                </div>

            </ShapedSection>

        </div>
    </DefaultLayout>
</template>
