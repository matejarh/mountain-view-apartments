<script setup>
import FullLayout from '@/Layouts/FullLayout.vue';
import ActionSection from '@/Components/ActionSection.vue';
import FiltersSection from '@/Components/FiltersSection.vue';
import PagesIcon from '@/Icons/PagesIcon.vue';
import PageCard from './_partials/PageCard.vue';
import Tooltip from '@/Components/Tooltip.vue';
import CirclePlusIcon from '@/Icons/CirclePlusIcon.vue';
import { ref } from 'vue';
import CreateDialog from './_partials/CreateDialog.vue';

const showCreateDialog = ref(false)

</script>

<template>
    <FullLayout :title="__('Pages')">
        <ActionSection :fullwidth="true">
            <template #title>
                {{ __('Pages') }}
            </template>

            <template #content>
                <FiltersSection v-show="$page.props.pages.data.length > 0" id="pages-filters" route="admin.pages.index"
                    placeholder="Search for pages" />

                <div class="relative" v-if="$page.props.pages.data.length > 0">
                    <TransitionGroup name="list" tag="ul"
                        class=" relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 4xl:grid-cols-6 gap-4 md:gap-4 lg:gap-6 2xl:gap-8">

                        <PageCard v-for="page, key in $page.props.pages.data" :key="page.id" :page="page" />
                    </TransitionGroup>
                </div>

                <div v-else class="">
                    <div class="w-full text-center cursor-pointer" @click="showCreateDialog = true">
                        <PagesIcon class="text-gray-300 dark:text-gray-400 w-32 h-32 mx-auto" />

                        <p class="text-gray-300 dark:text-gray-400 font-semibold ">{{ __('No pages yet!') }}</p>
                        <p class="text-gray-300 dark:text-gray-400 text-sm">{{ __('To create one, click here') }}</p>
                    </div>
                </div>
            </template>
        </ActionSection>
        <div class=" fixed top-28 sm:top-20 right-4 md:top-20  md:right-4 z-10">

            <Tooltip :text="__('Add New Page')" location="left">

                <button @click="showCreateDialog = true"
                    class=" drop-shadow-lg rounded-full bg-transparent ">
                    <CirclePlusIcon
                        class="w-16 h-16 text-amazon-400 hover:scale-105 hover:rotate-180 active:scale-95 transition " />
                </button>
            </Tooltip>
        </div>
        <CreateDialog :show="showCreateDialog" @close="showCreateDialog = false" />
    </FullLayout>
</template>
