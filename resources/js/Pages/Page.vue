<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import HeroSection from '@/Pages/Page/_partials/HeroSection.vue';
import ContentSection from '@/Pages/Page/_partials/ContentSection.vue';
import ShapedSection from '@/Components/_default/ShapedSection.vue';
import Heading2White from '@/Components/_default/Heading2White.vue';


</script>

<template>
    <DefaultLayout :title="$page.props?.page?.title[$page.props?.locale]"
        :description="$page.props?.page?.description[$page.props?.locale]"
        :keywords="$page.props?.page?.keywords[$page.props?.locale]"
        :noindex="false">

        <div class="space-y-0">
            <HeroSection />
            <ShapedSection :color="{ dark: 'primary-900', light: 'primary-700' }">
                <!-- <div class="h-96 w-full"></div> -->
                <div class=" mx-auto max-w-screen-md px-4">

                    <Heading2White class="text-center">
                        {{ $page.props?.page?.title[$page.props?.locale]  }}

                    </Heading2White>

                    <!-- <ReviewCard v-for="review in $page.props?.reviews.data" :key="review.id" :review="review">
                    </ReviewCard> -->
                </div>

            </ShapedSection>
           <!--  <div class="spacer h-48 w-full"></div> -->
            <ContentSection id="content-section" />
        </div>
    </DefaultLayout>
</template>
