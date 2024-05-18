<script setup>
import DinamicIcon from '@/Components/DinamicIcon.vue';
import Badge from '@/Components/_default/Badge.vue';
import ShapedSection from '@/Components/_default/ShapedSection.vue';
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage()
const facilitiesWithIcons = computed(() => {
    return page.props.property?.facilities.filter(facility => facility.has_icon_file)
})
const facilitiesWithoutIcons = computed(() => {
    return page.props.property?.facilities.filter(facility => !facility.has_icon_file)
})
</script>

<template>
    <ShapedSection :color="{light:'primary-700', dark: 'primary-900'}">
        <div class="py-8 lg:py-16 mx-auto max-w-screen-xl px-4">
            <h2
                class="mb-8 lg:mb-16 text-3xl font-extrabold tracking-tight leading-tight text-center text-white dark:text-white md:text-4xl">
                {{ __('Amenities & Services') }}</h2>
            <div
                class="grid grid-cols-2 sm:grid-cols-3 gap-8 text-gray-500 sm:gap-12 md:grid-cols-4 lg:grid-cols-6 dark:text-gray-400">
                <div class="text-center" v-for="facility in facilitiesWithIcons" :key="facility.id">
                    <DinamicIcon :icon="facility.icon" class="text-white w-20 h-20 mx-auto" />
                    <p class="text-gray-200">{{ __(facility.name) }}</p>
                </div>
                <p class="text-gray-200 my-auto">{{__('And much more')}}...</p>
                <div class="col-span-full flex flex-wrap justify-center space-x-2">
                    <Badge class="mb-2" v-for="facility in facilitiesWithoutIcons" :key="facility.key">
                        {{ __(facility.name) }}
                    </Badge>
                </div>
            </div>

        </div>
    </ShapedSection>




</template>
