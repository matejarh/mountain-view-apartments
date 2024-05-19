<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import ReviewCard from '@/Components/_default/Reviews/ReviewCard.vue'
import HeroSection from './_partials/HeroSection.vue';
import CreateReviewForm from './_partials/CreateReviewForm.vue';
import ShapedSection from '@/Components/_default/ShapedSection.vue';
import Wrapper from '@/Components/_default/Wrapper.vue';
</script>

<template>
    <DefaultLayout :title="$page.props.seo?.title" :description="$page.props.seo?.description"
        :keywords="$page.props.seo?.keywords">

        <div class="space-y-0">
            <HeroSection />
            <ShapedSection :color="{dark:'primary-800', light:'primary-700'}">
                <Wrapper size="md">
                    <CreateReviewForm />
                </Wrapper>


                <div class="spacer h-48 w-full"></div>
            </ShapedSection>

        </div>
    </DefaultLayout>
</template>
