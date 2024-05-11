<script setup>
import AnimatedLayout from '@/Components/AnimatedLayout.vue';
import FacilityItem from './FacilityItem.vue';
import AttachedBathroomIcon from '@/Icons/AttachedBathroomIcon.vue';
import BalconyIcon from '@/Icons/BalconyIcon.vue';
import HeatingIcon from '@/Icons/HeatingIcon.vue';
import AirConditionIcon from '@/Icons/AirConditionIcon.vue';
import FullyEquipedKitchenIcon from '@/Icons/FullyEquipedKitchenIcon.vue';
import FreeWiFiIcon from '@/Icons/FreeWiFiIcon.vue';
import CableChannelsIcon from '@/Icons/CableChannelsIcon.vue';
import FreeParkingIcon from '@/Icons/FreeParkingIcon.vue';
import ShapeBottom from '@/Components/_default/ShapeBottom.vue';
import ShapeTop from '@/Components/_default/ShapeTop.vue';


</script>

<template>
    <AnimatedLayout min-height="min-h-[224px]" :delay="100">

        <section class="relative bg-primary-700 dark:bg-primary-900">
            <div class="py-8 lg:py-16 mx-auto max-w-screen-xl px-4">
                <h2
                    class="mb-8 lg:mb-16 text-3xl font-extrabold tracking-tight leading-tight text-center text-white dark:text-white md:text-4xl">
                    {{__('All apartmants include')}}</h2>
                <div
                    class="grid grid-cols-2 gap-8 text-gray-500 sm:gap-12 md:grid-cols-3 lg:grid-cols-6 dark:text-gray-400">
                    <FacilityItem>
                        <template #image>
                            <AttachedBathroomIcon class="h-14 w-14 hover:text-gray-900 dark:hover:text-white" />
                        </template>
                        {{ __("Attached bathroom") }}
                    </FacilityItem>
                    <FacilityItem>
                        <template #image>
                            <BalconyIcon class="h-14 w-14 hover:text-gray-900 dark:hover:text-white" />
                        </template>
                        {{ __("Balcony") }}<br> {{__('or')}} {{ __('Patio') }}
                    </FacilityItem>
                    <FacilityItem>
                        <template #image>
                            <div class="flex">
                                <HeatingIcon class="h-14 w-14 hover:text-gray-900 dark:hover:text-white" />
                                <AirConditionIcon class="h-14 w-14 hover:text-gray-900 dark:hover:text-white" />
                            </div>
                        </template>
                        {{ __("Heating") }} {{__('and')}} <br>{{ __("Air condition") }}
                    </FacilityItem>

                    <FacilityItem>
                        <template #image>
                            <FullyEquipedKitchenIcon class="h-14 w-14 hover:text-gray-900 dark:hover:text-white" />
                        </template>
                        {{ __("Fully equiped kitchen") }}
                    </FacilityItem>
                    <FacilityItem>
                        <template #image>
                            <FreeWiFiIcon class="h-14 w-14 hover:text-gray-900 dark:hover:text-white" />
                        </template>
                        {{ __("Free Wi-Fi") }}
                    </FacilityItem>
                    <FacilityItem>
                        <template #image>
                            <CableChannelsIcon class="h-14 w-14 hover:text-gray-900 dark:hover:text-white" />
                        </template>
                        {{ __("Cable channels") }}
                    </FacilityItem>
                    <FacilityItem>
                        <template #image>
                            <FreeParkingIcon class="h-14 w-14 hover:text-gray-900 dark:hover:text-white" />
                        </template>
                        {{ __("Free parking") }}
                    </FacilityItem>

                </div>
            </div>
            <ShapeBottom
                class="absolute inset-y-full z-10 left-0 right-0 top-0 w-full rotate-180 text-primary-700 dark:text-primary-900 " />
            <ShapeTop
                class="absolute inset-y-full z-10 left-0 right-0 w-full bottom-1/2 text-primary-700 dark:text-primary-900 " />
        </section>
    </AnimatedLayout>
</template>
