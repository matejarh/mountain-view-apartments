<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import AccomodationsDropdownItem from './AccomodationsDropdownItem.vue';
import { onMounted, ref } from 'vue';
import MountainCityIcon from '@/Icons/MountainCityIcon.vue';
import { usePropertyStore } from '@/stores/property';

defineProps({
    direction: { type: String, default: 'up' },
    selectedProperty: { type: Object, default: null },
})

defineEmits(['selected'])

const selected = ref(null)

const properties = usePropertyStore()

</script>

<template>
    <div class="">
        <Dropdown width="full" >
            <template #trigger>
                <span v-if="selectedProperty"
                    class="inline-flex leading-tight w-full transition duration-300 ease-out  items-center font-medium  p-2.5 text-lg bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-800  text-gray-950 dark:text-gray-100 rounded-lg cursor-pointer hover:border-gray-300 dark:hover:border-gray-700 dark:hover:text-white">

                    <img :src="selectedProperty?.avatar_url" class="w-auto h-7 rounded-sm me-3">
                    {{ selectedProperty?.title[$page.props?.locale] }}
                </span>
                <span v-else
                    class="inline-flex items-center w-full transition duration-300 ease-out font-medium p-2.5 text-lg bg-white dark:bg-gray-950  border border-gray-200 dark:border-gray-800  text-gray-300 dark:text-gray-600 rounded-lg cursor-pointer hover:border-gray-300 dark:hover:border-gray-700 dark:hover:text-white">
                    <MountainCityIcon class="w-5 rounded-sm me-3" />
                    {{ __('Select apartmant') }}
                </span>
            </template>
            <template #content>
                <ul class="py-2 font-medium w-full" role="none">

                    <AccomodationsDropdownItem v-for="accomodation, key in properties.list" :key="accomodation.id" :accomodation="accomodation"
                        @selected="$emit('selected', accomodation)" />
                </ul>
            </template>
        </Dropdown>
    </div>
</template>

