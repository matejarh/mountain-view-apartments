<script setup>
import { computed, ref } from 'vue';
import NavDropdown from './NavDropdown.vue';
import NotificationsDropdownItem from './NotificationsDropdownItem.vue';
import { router, useForm, usePage } from '@inertiajs/vue3';
import formatNumber from '@/mixins/numberToKilo';
import { icons } from '@/icons';

const show = ref(false)

const page = usePage()

const active = computed(() => {
    return page.props.notifications.length > 0
})

const readForm = useForm({
    id:null,
})

const read = (notification) => {
    readForm.id = notification.id
    readForm.put(route('admin.notifications.read'), {
        onSuccess: () => {
            router.get(notification.data.link)
        }
    })
}

const readAll = () => {
    readForm.put(route('admin.notifications.read.all'))
}
</script>

<template>

    <NavDropdown :key="'notifications-dropdown'" :id="'notifications-dropdown'" :align="'right'" width="96">
        <template #trigger>
            <span class="sr-only">{{ __('View notifications') }}</span>
            <!-- Bell icon -->
            <div class="relative">
                <icons.BellIcon v-if="!active" class="w-6 h-6" />

                <div v-if="$page.props?.notifications.length > 0"
                    class="absolute inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-bittersweet-500 border-1 border-white rounded-full -top-2 -end-2 dark:border-gray-50">
                    {{ formatNumber($page.props?.notifications.length) }}
                </div>

                <div class="relative w-6 h-6" v-if="active">
                    <icons.BellActiveIcon class="w-6 h-6 animate-ping absolute dark:text-amazon-400 text-amazon-500" />
                    <icons.BellActiveIcon class="w-6 h-6 dark:text-amazon-400 text-amazon-500" />
                </div>
            </div>

        </template>

        <!-- Dropdown menu -->
        <div class="" v-show="true && $page.props?.notifications.length > 0">

            <div
                class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-600 dark:text-gray-300">
                {{__('Notifications')}}
            </div>

            <div>
                <NotificationsDropdownItem v-for="notification, key in $page.props?.notifications" :key="notification.id" :notification="notification" @click="read(notification)" />
                <!-- <div @click="read(notification.id)" :href="notification.data.link" v-for="notification, key in $page.props?.notifications"
                    :key="notification.id"
                    class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                    <div class="flex-shrink-0">
                        <icons.MessageIcon class="w-11 h-11 transform -scale-x-100 text-gray-500  rounded-full" />

                    </div>
                    <div class="pl-3 w-full">
                        <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                            <span class="font-semibold text-gray-900 dark:text-white">{{ __(notification.data.title)
                                }}:</span><br>
                            "{{ __(notification.data.message) }}"
                        </div>
                        <div class="text-xs font-medium text-primary-600 dark:text-primary-500">
                            {{ getFormattedDate(notification.created_at, $page.props.locale) }}
                        </div>
                    </div>
                </div> -->
                <!--             <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                    <div class="flex-shrink-0">
                        <img class="w-11 h-11 rounded-full"
                            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                            alt="Jese Leos avatar" />
                        <div
                            class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-gray-900 rounded-full border border-white dark:border-gray-700">
                            <svg aria-hidden="true" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="pl-3 w-full">
                        <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                            <span class="font-semibold text-gray-900 dark:text-white">Jese leos</span>
                            and
                            <span class="font-medium text-gray-900 dark:text-white">5 others</span>
                            started following you.
                        </div>
                        <div class="text-xs font-medium text-primary-600 dark:text-primary-500">
                            10 minutes ago
                        </div>
                    </div>
                </a>
                <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                    <div class="flex-shrink-0">
                        <img class="w-11 h-11 rounded-full"
                            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/joseph-mcfall.png"
                            alt="Joseph McFall avatar" />
                        <div
                            class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-red-600 rounded-full border border-white dark:border-gray-700">
                            <svg aria-hidden="true" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="pl-3 w-full">
                        <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                            <span class="font-semibold text-gray-900 dark:text-white">Joseph Mcfall</span>
                            and
                            <span class="font-medium text-gray-900 dark:text-white">141 others</span>
                            love your story. See it and view more stories.
                        </div>
                        <div class="text-xs font-medium text-primary-600 dark:text-primary-500">
                            44 minutes ago
                        </div>
                    </div>
                </a>
                <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                    <div class="flex-shrink-0">
                        <img class="w-11 h-11 rounded-full"
                            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/roberta-casas.png"
                            alt="Roberta Casas image" />
                        <div
                            class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-green-400 rounded-full border border-white dark:border-gray-700">
                            <svg aria-hidden="true" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="pl-3 w-full">
                        <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                            <span class="font-semibold text-gray-900 dark:text-white">Leslie
                                Livingston</span>
                            mentioned you in a comment:
                            <span class="font-medium text-primary-600 dark:text-primary-500">@bonnie.green</span>
                            what do you say?
                        </div>
                        <div class="text-xs font-medium text-primary-600 dark:text-primary-500">
                            1 hour ago
                        </div>
                    </div>
                </a>
                <a href="#" class="flex py-3 px-4 hover:bg-gray-100 dark:hover:bg-gray-600">
                    <div class="flex-shrink-0">
                        <img class="w-11 h-11 rounded-full"
                            src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/robert-brown.png"
                            alt="Robert image" />
                        <div
                            class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-purple-500 rounded-full border border-white dark:border-gray-700">
                            <svg aria-hidden="true" class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="pl-3 w-full">
                        <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">
                            <span class="font-semibold text-gray-900 dark:text-white">Robert Brown</span>
                            posted a new video: Glassmorphism - learn how to implement
                            the new design trend.
                        </div>
                        <div class="text-xs font-medium text-primary-600 dark:text-primary-500">
                            3 hours ago
                        </div>
                    </div>
                </a> -->
            </div>

            <button @click="readAll"
                class="block w-full py-2 text-md font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-600 hover:dark:bg-gray-500 dark:text-white dark:hover:underline">
                <div class="inline-flex items-center">
                    <icons.EyeIcon class="mr-2 w-4 h-4 text-gray-500 dark:text-gray-400" />
                    {{__('Read all')}}
                </div>
            </button>
        </div>

    </NavDropdown>
    <!-- Notifications -->
    <!--         <NavButton @click="show = !show" type="button">



        </NavButton> -->


</template>
