<script setup>
import { computed, ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3'
import { icons } from '@/icons';
import FullLayout from '@/Layouts/FullLayout.vue';
import ActionSection from '@/Components/ActionSection.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import MapCard from '@/Components/Properties/MapCard.vue';
import PricesList from '@/Components/Properties/PricesList.vue';
import FacilityIcon from '@/Components/Properties/FacilityIcon.vue';
import EditForm from './_partials/EditForm.vue';
import ManageFacilitiesDialog from './_partials/ManageFacilitiesDialog.vue';
import ManagePricesDialog from './_partials/ManagePricesDialog.vue';
import ManageUnavailableDatesDialog from './_partials/ManageUnavailableDatesDialog.vue';
import ManageGalleriesDialog from './_partials/ManageGalleriesDialog.vue';

const props = defineProps({
    property: Object,
})

const showFacilitiesDialog = ref(false)
const showAttachGalleryDialog = ref(false)
const showPricesDialog = ref(false)
const showUnavailableDatesDialog = ref(false)

const facilitiesWithIcons = computed(() => {
    return props.property.facilities.filter(facility => facility.has_icon_file);
})

const facilitiesWithoutIcons = computed(() => {
    return props.property.facilities.filter(facility => !facility.has_icon_file);

})

const detachForm = useForm({})

const detach = (gallery) => {
    detachForm.put(route('admin.properties.detach.gallery', { gallery: gallery, property: props.property }), {

    })
}


</script>

<template>
    <FullLayout :title="__('Property info')">
        <ActionSection :fullwidth="true" :back="'admin.properties.index'">
            <template #title>
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <span>
                        {{ $page.props?.property.title[$page.props?.locale] }}
                    </span>
                    <span class="text-base">
                        {{ __($page.props?.property.type) }}
                    </span>
                </div>
            </template>

            <template #content>
                <div class="lg:grid lg:grid-cols-1 xl:grid-cols-3 lg:gap-8 xl:gap-16">
                    <div class="w-full mx-auto flex flex-col space-y-4">
                        <PrimaryButton type="button" @click="showAttachGalleryDialog = true"
                            v-if="$page.props?.property.galleries.length <= 0">{{__('Attach gallery')}}</PrimaryButton>

                        <div class="" v-if="$page.props?.property.galleries.length > 0">
                            <div class="grid grid-cols-4 gap-1" v-for="gallery in $page.props?.property.galleries"
                                :key="gallery.id">
                                <div class="flex justify-between space-x-2 mb-2 col-span-full">
                                    <PrimaryButton type="button"
                                        v-if="$page.props?.property.galleries.length > 0"
                                        class="w-full"
                                        :class="{ 'opacity-25': detachForm.processing || detachForm.recentlySuccessful }"
                                        :disabled="detachForm.processing || detachForm.recentlySuccessful" @click="detach(gallery)">
                                        <div class="flex items-center">
                                            <icons.SpinnerIcon v-show="detachForm.processing"
                                                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                                            {{ detachForm.processing ? __('removing') + '...' : detachForm.recentlySuccessful ?
                                            __('removed') : __('Remove Gallery') }}

                                        </div>
                                    </PrimaryButton>

                                    <PrimaryButton type="button" class="w-full"
                                        @click="router.visit(route('admin.galleries.show', gallery))"
                                        v-if="$page.props?.property.galleries.length > 0">{{__('Edit Gallery')}}</PrimaryButton>
                                </div>
                                <div class="" v-for="image in gallery.images" :key="image.id">
                                    <div class="">
                                        <img :src="image.thumb_url" class="max-w-full h-auto rounded-lg" :alt="image.name" />

                                    </div>
                                </div>
                            </div>
                        </div>


                        <PrimaryButton type="button" @click="showFacilitiesDialog = true">{{__('manage facilities')}}</PrimaryButton>

                        <div class="grid grid-cols-3 sm:grid-cols-5 lg:grid-cols-4 gap-4 ">

                            <div class="w-full text-center mx-auto" v-for="facility, key in facilitiesWithIcons"
                                :key="facility.id">
                                <FacilityIcon :facility="facility" v-if="facility.has_icon_file" />
                            </div>



                        </div>
                        <ul class="flex flex-wrap items-center">

                            <li class=" bg-primary-800 text-white text-xs font-medium me-2 px-2.5 py-0.5 mb-2 rounded dark:bg-primary-700 dark:text-white  "
                                v-for="facility, key in facilitiesWithoutIcons" :key="facility.id">
                                {{ __(facility.name) }}
                            </li>

                        </ul>
                        <div class="flex items-center space-x-2">
                            <a :href="property.google_maps_link" target="_blank" >{{__('Travel directions')}}</a>
                            <icons.PinIcon class="w-5 h-5 "/>
                        </div>
                        <MapCard :property="$page.props?.property" />
                        <PrimaryButton type="button" @click="showPricesDialog = true">{{__('Manage Prices')}}</PrimaryButton>
                        <PricesList  />
                        <PrimaryButton type="button" @click="showUnavailableDatesDialog = true">{{__('Manage Unavailable Dates')}}</PrimaryButton>
                        <!-- <AvailabilityCalendar /> -->

                    </div>
                    <div class="right xl:col-span-2">
                        <EditForm @manage-prices="showPricesDialog = true" />
                    </div>


                </div>


            </template>
        </ActionSection>
        <ManageFacilitiesDialog :show="showFacilitiesDialog" @close="showFacilitiesDialog = false"
            :property="property" />
        <ManageGalleriesDialog :show="showAttachGalleryDialog" @close="showAttachGalleryDialog = false"
            :property="property" />
        <ManagePricesDialog :show="showPricesDialog" @close="showPricesDialog = false"
            :property="property" />
        <ManageUnavailableDatesDialog :show="showUnavailableDatesDialog" @close="showUnavailableDatesDialog = false"
            :property="property" />
    </FullLayout>
</template>
