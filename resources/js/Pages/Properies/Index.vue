<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import PropertyCard from '@/Components/_default/PropertyCard.vue';
import Wrapper from '@/Components/_default/Wrapper.vue';
</script>

<template>
    <DefaultLayout :title="$page.props.seo?.title"
        :description="$page.props.seo?.description"
        :keywords="$page.props.seo?.keywords">

        <div class="space-y-0">
            <div class="spacer h-[10svh] w-full"></div>
            <Wrapper>

                    <TransitionGroup name="list" tag="ul" class=" relative grid grid-cols-1 gap-4 md:gap-4 lg:gap-6 2xl:gap-8">
                        <PropertyCard class="mx-auto" :property="property" v-for="property in $page.props?.properties.data" :key="property.id" ></PropertyCard>
                    </TransitionGroup>
            </Wrapper>
        </div>
    </DefaultLayout>
</template>
