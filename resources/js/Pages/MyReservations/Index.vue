<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import ShapedSection from '@/Components/_default/ShapedSection.vue';
import Heading2White from '@/Components/_default/Heading2White.vue';
import Wrapper from '@/Components/_default/Wrapper.vue';
</script>

<template>
    <DefaultLayout :title="$page.props?.seo?.title" :description="$page.props?.seo?.description"
        :keywords="$page.props?.seo?.keywords">

        <div class="space-y-0">

            <ShapedSection :color="{ dark: 'primary-900', light: 'primary-700' }">
                <!-- <div class="h-96 w-full"></div> -->
                <div class="pt-8 xl:pt-48 mx-auto max-w-screen-md px-4">

                    <Heading2White class="text-center" v-if="$page.props?.reservations.data.length > 0">
                        {{ __('My Reservations')  }}

                    </Heading2White>

                    <p class="mb-4 text-2xl text-center font-extrabold tracking-tight leading-none text-white md:text-3xl lg:text-2xl" v-else>
                        {{ __('No reservations yet') }}
                    </p>

                </div>

            </ShapedSection>

        </div>
    </DefaultLayout>
</template>
