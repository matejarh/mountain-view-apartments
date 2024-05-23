<script setup>
import { router, useForm } from '@inertiajs/vue3';
import DropdownItem from './DropdownItem.vue';
import NavDropdown from './NavDropdown.vue';
import {icons} from "@/icons"

const logoutForm = useForm({})
const logout = () => {
    logoutForm.post(route('logout'));
};
</script>

<template>
    <NavDropdown align="right">
        <template #trigger>
            <span class="sr-only">{{__('Open user menu')}}</span>
            <img class="w-8 h-8 rounded-full" :src="$page.props?.auth.user.profile_photo_url" alt="user photo" />
        </template>
        <div class="py-3 px-4 ">
            <span class="block text-sm font-semibold text-gray-900 dark:text-white">{{ $page.props?.auth.user.name
                }}</span>
            <span class="block text-sm text-gray-900 truncate dark:text-white">{{ $page.props?.auth.user.email }}</span>
        </div>
        <ul class="py-1 text-gray-700 dark:text-gray-300">
            <DropdownItem :href="$page.props?.auth.user.is_admin ? route('profile.show') : route('profile.show')">
                {{ __("My Profile") }}
            </DropdownItem>
            <DropdownItem v-if="$page.props?.auth.user.is_admin":href="route('admin.dashboard.show')">
                {{__("Administration")}}
            </DropdownItem>

        </ul>

        <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
            <li>
                <a href="#"
                    class="flex items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    <icons.BookOpenIcon class="mr-2 w-5 h-5 text-gray-400" />
                    My Reviews</a>
            </li>
            <li>
                <inertia-link :href="route('inquiries.index', $page.props.locale)"
                    class="flex items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">

                    <icons.InfoIcon class="mr-2 w-5 h-5 text-gray-400" />
                    My Inquiries</inertia-link>
            </li>
            <!-- <li>
                <a href="#"
                    class="flex justify-between items-center py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    <span class="flex items-center">
                        <svg aria-hidden="true" class="mr-2 w-5 h-5 text-primary-600 dark:text-primary-500"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z"
                                clip-rule="evenodd"></path>
                        </svg>
                        Pro version
                    </span>
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </li> -->
        </ul>
        <ul class="py-1 text-gray-700 dark:text-gray-300 overflow-hidden mb-1">

            <DropdownItem as="button" @clicked="logout">

                {{__("Sign out")}}
            </DropdownItem>
        </ul>
    </NavDropdown>
</template>
