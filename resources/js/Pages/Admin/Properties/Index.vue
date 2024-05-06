<script setup>
import ActionSection from '@/Components/ActionSection.vue'
import Tooltip from '@/Components/Tooltip.vue'
import FullLayout from '@/Layouts/FullLayout.vue';
import PropertyCard from './_partials/PropertyCard.vue';
import CreatePropertyDialog from './_partials/CreatePropertyDialog.vue';
import { ref } from 'vue';
import CirclePlusIcon from '@/Icons/CirclePlusIcon.vue';
import ImageIcon from '@/Icons/ImageIcon.vue';
import FiltersSection from '@/Components/FiltersSection.vue';

const showCreateDialog = ref(false)
const galleryProxy = ref(null)

const handleEdit = (gallery) => {
    galleryProxy.value = gallery
    showCreateDialog.value = true
}
</script>

<template>
    <FullLayout :title="__('Properties')">
        <ActionSection :fullwidth="true">
            <template #title>
                {{ __('Properties') }}
            </template>

            <template #content>
                <FiltersSection v-show="$page.props.properties.data.length > 0" id="properties-filters" route="admin.properties.index" placeholder="Search for properties" />

                <div class="relative" v-if="$page.props.properties.data.length > 0">
                    <TransitionGroup name="list" tag="ul"
                        class=" relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 4xl:grid-cols-6 gap-4 md:gap-4 lg:gap-6 2xl:gap-8">

                        <!-- <PropertyCard v-for="gallery, key in $page.props.properties.data" :key="gallery.id" :gallery="gallery"
                            @edit="handleEdit" /> -->
                    </TransitionGroup>
                </div>

                <div v-else class="">
                    <div class="w-full text-center cursor-pointer" @click="showCreateDialog = true">
                        <ImageIcon class="text-gray-300 dark:text-gray-400 w-32 h-32 mx-auto" />

                        <p class="text-gray-300 dark:text-gray-400 font-semibold ">{{ __('No properties yet!') }}</p>
                        <p class="text-gray-300 dark:text-gray-400 text-sm">{{ __('To create one, click here') }}</p>
                    </div>
                </div>
            </template>

        </ActionSection>
        <div class=" fixed top-28 sm:top-20 right-4 md:top-20  md:right-4 z-10">

            <Tooltip :text="__('Add New Property')" location="left">

                <button @click="galleryProxy = null, showCreateDialog = true"
                    class=" drop-shadow-lg rounded-full bg-transparent ">
                    <CirclePlusIcon
                        class="w-16 h-16 text-amazon-400 hover:scale-105 hover:rotate-180 active:scale-95 transition " />
                </button>
            </Tooltip>
        </div>
        <!-- <CreatePropertyDialog @close="showCreateDialog = false" :show="showCreateDialog" :gallery="galleryProxy" /> -->
    </FullLayout>
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
