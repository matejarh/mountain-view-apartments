<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import AccomodationsDropdownItem from './AccomodationsDropdownItem.vue';
import { ref } from 'vue';
import MountainCityIcon from '@/Icons/MountainCityIcon.vue';

defineProps({ direction: { type: String, default: 'up' } })

const selected = ref(null)

</script>

<template>
    <div class="">
        <Dropdown width="full" >
            <template #trigger>
                <span v-if="selected"
                    class="inline-flex leading-tight w-full transition duration-300 ease-out  items-center font-medium  p-2.5 text-lg bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-800  text-gray-950 dark:text-gray-100 rounded-lg cursor-pointer hover:border-gray-300 dark:hover:border-gray-700 dark:hover:text-white">

                    <img :src="selected?.avatar_url" class="w-10 rounded-sm me-3">
                    {{ selected?.name }}
                </span>
                <span v-else
                    class="inline-flex items-center w-full transition duration-300 ease-out font-medium p-2.5 text-lg bg-white dark:bg-gray-950  border border-gray-200 dark:border-gray-800  text-gray-300 dark:text-gray-600 rounded-lg cursor-pointer hover:border-gray-300 dark:hover:border-gray-700 dark:hover:text-white">
                    <MountainCityIcon class="w-5 rounded-sm me-3" />
                    {{ __('Select accomodation') }}
                </span>
            </template>
            <template #content>
                <ul class="py-2 font-medium w-full" role="none">

                    <AccomodationsDropdownItem v-for="accomodation, key in $page.props.accomodations" :key="accomodation.id" :accomodation="accomodation"
                        @selected="selected = accomodation ,$emit('selected', accomodation)" />
                </ul>
            </template>
        </Dropdown>
    </div>
</template>

