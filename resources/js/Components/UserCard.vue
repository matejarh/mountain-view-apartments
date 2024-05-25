<script setup>
import { icons } from '@/icons';
import Dropdown from './Dropdown.vue';
import PrimaryButton from './PrimaryButton.vue';

defineProps({
    user: Object,
})
</script>

<template>


    <div
        class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex justify-end px-4 pt-4">
            <Dropdown align="left">
                <template #trigger>
                    <button id="dropdownButton" data-dropdown-toggle="dropdown"
                        class="inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-1.5"
                        type="button">
                        <span class="sr-only">Open dropdown</span>
                        <icons.DotsIcon class="w-5 h-5" />
                    </button>

                </template>

                <!-- Dropdown menu -->
                <template #content>
                    <ul class="py-2" aria-labelledby="dropdownButton">
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Export
                                Data</a>
                        </li>
                        <li>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-bittersweet-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete</a>
                        </li>
                    </ul>
                </template>
            </Dropdown>
        </div>
        <div class="flex flex-col items-center pb-10">
            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" :src="user?.profile_photo_url"
                :alt="`${user.name} image`" />
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ user.name }}</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ user.email }}</span>
            <div class="flex mt-4 md:mt-6">
                <!-- <a href="#"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-primary-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-600 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Add
                    friend</a> -->
                <PrimaryButton type="button">Send Message</PrimaryButton>
            </div>
        </div>
    </div>

</template>
