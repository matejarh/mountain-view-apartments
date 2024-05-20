<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import PropertyCard from '@/Components/_default/PropertyCard.vue';
import Wrapper from '@/Components/_default/Wrapper.vue';
import { computed, ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
import PillItem from '@/Components/_default/Properties/PillItem.vue';

const filter = ref('.')

const page = usePage()
const filtered = computed(() => {
    const searchPattern = new RegExp(filter.value, 'i')
    return page.props?.properties.data.filter(property => searchPattern.test(property.address))
})

const items = ref([
    { name: 'All', value: '.' },
    { name: 'Bled', value: 'bled' },
    { name: 'Nassfeld', value: 'hermagor' },
])


</script>

<template>
    <DefaultLayout :title="$page.props.seo?.title" :description="$page.props.seo?.description"
        :keywords="$page.props.seo?.keywords">

        <div class="space-y-0">
            <div class="spacer hidden xl:block h-[10svh] w-full"></div>
            <Wrapper>
                <ul
                    class="flex flex-wrap text-sm font-medium text-center bg-gray-50 dark:bg-gray-900 rounded-lg p-2  text-gray-500 dark:text-gray-400 mb-4">
                    <PillItem v-for="item, key in items" :key="key" :item="item" :filter="filter"
                        @clicked="item => filter = item.value" />
                </ul>

                <TransitionGroup name="list" tag="ul" class=" grid grid-cols-1 gap-4 md:gap-4 lg:gap-6 2xl:gap-8">
                    <PropertyCard class="mx-auto" :property="property" v-for="property, key in filtered" :key="key">
                    </PropertyCard>
                </TransitionGroup>
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
