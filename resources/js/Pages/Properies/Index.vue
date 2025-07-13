<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import PropertyCard from '@/Components/_default/PropertyCard.vue';
import Wrapper from '@/Components/_default/Wrapper.vue';
import { computed, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import PillItem from '@/Components/_default/Properties/PillItem.vue';
import AccordianComponent from '@/Components/_default/AccordianComponent.vue';
import FaqSection from './_partials/FaqSection.vue';
import ShapedSection from '@/Components/_default/ShapedSection.vue';
import Heading2White from '@/Components/_default/Heading2White.vue';

const filter = ref('.')

const page = usePage()
const filtered = computed(() => {
    const searchPattern = new RegExp(filter.value, 'i')
    return page.props?.properties.data.filter(property => searchPattern.test(property.address))
})

const navItems = ref([
    { name: 'Show', line2: 'All', value: '.' },
    { name: 'Bled', line2: 'Slovenija', value: 'bled' },
    { name: 'Nassfeld', line2: 'Austria', value: 'hermagor' },
])


</script>

<template>
    <DefaultLayout :title="$page.props?.seo?.title" :description="$page.props?.seo?.description"
        :keywords="$page.props?.seo?.keywords" :noindex="false">

        <div class="space-y-0">
            <ShapedSection :color="{ dark: 'primary-900', light: 'primary-700' }">
                <!-- <div class="h-96 w-full"></div> -->
                <div class="pt-8 xl:pt-48 mx-auto max-w-screen-md px-4">

                    <Heading2White class="text-center" v-if="page.props?.properties.data.length > 0">
                        {{ __('Our Apartments')  }}
                    </Heading2White>

                    <p class="mb-4 text-2xl text-center font-extrabold tracking-tight leading-none text-white md:text-3xl lg:text-2xl" v-else>
                        {{ __('No apartments yet') }}
                    </p>
                    <!-- <ReviewCard v-for="review in $page.props?.reviews.data" :key="review.id" :review="review">
                    </ReviewCard> -->
                </div>

            </ShapedSection>

            <Wrapper>
                <ul
                    class="flex flex-wrap justify-center text-sm font-medium text-center bg-gray-50 dark:bg-gray-900 rounded-lg p-2 text-gray-500 dark:text-gray-400 mb-4">
                    <PillItem v-for="item, key in navItems" :key="key" :item="item" :filter="filter"
                        @clicked="item => filter = item.value" />
                </ul>

                <TransitionGroup name="list" tag="ul" class=" grid grid-cols-1 gap-4 md:gap-4 lg:gap-6 2xl:gap-8">
                    <PropertyCard class="mx-auto" :property="property" v-for="property, key in filtered" :key="key">
                    </PropertyCard>
                </TransitionGroup>

                <!-- <FaqSection /> -->
            </Wrapper>
        </div>
    </DefaultLayout>
</template>

<style scoped>
.list-move,
/* apply transition to moving elements */
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateY(50px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-leave-active {
    position: absolute;
}
</style>
