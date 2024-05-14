<script setup>
import { computed, ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3'
import _ from 'lodash';
import FullLayout from '@/Layouts/FullLayout.vue';
import ActionSection from '@/Components/ActionSection.vue';
import MapCard from './_partials/MapCard.vue';
import FacilityIcon from './_partials/FacilityIcon.vue';
import EditForm from './_partials/EditForm.vue';
import ManageFacilitiesDialog from './_partials/ManageFacilitiesDialog.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ManageGalleriesDialog from './_partials/ManageGalleriesDialog.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';
import PinIcon from '@/Icons/PinIcon.vue';
import AvailabilityCalendar from './_partials/AvailabilityCalendar.vue';

const props = defineProps({
    property: Object,
})

const showFacilitiesDialog = ref(false)
const showAttachGalleryDialog = ref(false)

const facilitiesWithIcons = computed(() => {
    // return _.filter(props.property.facilities, ['has_icon_file', true])
    return props.property.facilities.filter(facility => facility.has_icon_file);
})

const facilitiesWithoutIcons = computed(() => {
    return props.property.facilities.filter(facility => !facility.has_icon_file);

    //return _.filter(props.property.facilities, ['has_icon_file', false])
})

const detachForm = useForm({})

const detach = (gallery) => {
    detachForm.put(route('admin.properties.detach.gallery', { gallery: gallery, property: props.property }), {

    })
}


</script>

<template>
    <FullLayout :title="__('Gallery')">
        <ActionSection :fullwidth="true" :back="'admin.properties.index'">
            <template #title>
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <span>
                        {{ $page.props.property.title[$page.props.locale] }}
                    </span>
                    <span class="text-base">
                        {{ $page.props.property.type }}
                    </span>
                </div>
            </template>
            <template #description>
                <div class="whitespace-pre-wrap" v-html="$page.props.property.description[$page.props.locale]">
                </div>

            </template>

            <template #content>
                <div class="lg:grid lg:grid-cols-1 xl:grid-cols-3 lg:gap-8 xl:gap-16">
                    <div class=" mx-auto flex flex-col space-y-4">
                        <PrimaryButton @click="showAttachGalleryDialog = true"
                            v-if="$page.props.property.galleries.length <= 0">{{__('attach gallery')}}</PrimaryButton>

                        <div class="" v-if="$page.props.property.galleries.length > 0">
                            <div class="grid grid-cols-3" v-for="gallery in $page.props.property.galleries"
                                :key="gallery.id">
                                <div class="flex justify-between space-x-2 mb-2 col-span-3">
                                    <PrimaryButton type="button"
                                        v-if="$page.props.property.galleries.length > 0"
                                        class="w-full"
                                        :class="{ 'opacity-25': detachForm.processing || detachForm.recentlySuccessful }"
                                        :disabled="detachForm.processing || detachForm.recentlySuccessful" @click="detach(gallery)">
                                        <div class="flex items-center">
                                            <SpinnerIcon v-show="detachForm.processing"
                                                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                                            {{ detachForm.processing ? __('removing') + '...' : detachForm.recentlySuccessful ?
                                            __('removed') : __('Remove Gallery') }}

                                        </div>
                                    </PrimaryButton>

                                    <PrimaryButton class="w-full"
                                        @click="router.visit(route('admin.galleries.show', gallery))"
                                        v-if="$page.props.property.galleries.length > 0">{{__('Edit Gallery')}}</PrimaryButton>
                                </div>
                                <div class="" v-for="image in gallery.images" :key="image.id">
                                    <img :src="image.thumb_url" class="w-full h-auto" :alt="image.name" />
                                </div>
                            </div>
                        </div>


                        <PrimaryButton @click="showFacilitiesDialog = true">{{__('manage facilities')}}</PrimaryButton>
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
                            <PinIcon class="w-5 h-5 "/>
                        </div>
                        <MapCard :property="$page.props.property" />

                        <!-- <AvailabilityCalendar /> -->

                    </div>
                    <div class="right xl:col-span-2">
                        <EditForm />

                    </div>


                </div>


            </template>
        </ActionSection>
        <ManageFacilitiesDialog :show="showFacilitiesDialog" @close="showFacilitiesDialog = false"
            :property="property" />
        <ManageGalleriesDialog :show="showAttachGalleryDialog" @close="showAttachGalleryDialog = false"
            :property="property" />
    </FullLayout>
</template>
