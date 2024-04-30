<script setup>
import { ref, onBeforeMount, watchEffect, watch } from 'vue';
import ActionSection from '@/Components/ActionSection.vue';
import { usePage } from '@inertiajs/vue3';
import DesktopIcon from '@/Icons/DesktopIcon.vue';
import MobileIcon from '@/Icons/MobileIcon.vue';
import TabletIcon from '@/Icons/TabletIcon.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';

const activities = ref({})

const page = usePage()

const fetch = () => {
    axios.get(route('activities'))
        .then(response => {
            activities.value = response.data
        })
}

watchEffect(async () => {
    // console.log(page.props.locale)
    fetch()

})

onBeforeMount(() => {
})
</script>

<template>
    <ActionSection>
        <template #title>
            {{ __('Activity Log') }}
        </template>

        <template #description>
            {{ __('History of activity made by this account.') }}
        </template>

        <template #content>

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                <div class="p-4 relative" v-if="Object.keys(activities).length !== 0 && activities.constructor === Object">
                    <div class="relative" v-for="activities, key in activities">
                        <div class="flex mb-6 space-x-2">
                            <div class=" z-0 w-full border-b "></div>
                            <p class="transform translate-y-1/2 bg-white dark:bg-gray-900">
                                {{ key }}

                            </p>
                            <div class=" z-0 w-full border-b "></div>

                        </div>

                        <div class="md:flex justify-between space-x-2" v-for="activity, key in activities">
                            <div class="w-full flex justify-between">
                                <div class="w-full">

                                    {{ activity.created_at_diff_for_humans }}
                                </div>
                                <div class="w-full">

                                    {{ __(activity.type) }}
                                </div>

                            </div>

                            <div class="agent flex w-full space-x-2 items-center">
                                <DesktopIcon v-if="activity.agent.is_desktop" class="w-6 h-6" />
                                <MobileIcon v-else-if="activity.agent.is_mobile" class="w-6 h-6" />
                                <TabletIcon v-else-if="activity.agent.is_tablet" class="w-6 h-6" />
                                <DesktopIcon v-else class="w-6 h-6" />
                                <span>

                                    {{ __(activity.agent.platform) }}
                                </span>
                                <span>

                                    {{ __(activity.agent.browser) }}
                                </span>
                                <span>

                                    {{ __(activity.location.ip) }}
                                </span>
                            </div>

                            <div class="w-full md:text-right" v-if="activity.type === 'created_login'">
                                <template v-if="activity.subject.location">
                                    {{ activity.subject.location.cityName }},
                                    {{ activity.subject.location.countryName }}

                                </template>
                                <template v-else>
                                    {{__('no location')}}
                                </template>

                            </div>
                            <div class="w-full md:text-right" v-if="activity.type === 'updated_user'">
                                <template v-if="activity.location">
                                    {{ activity.location.cityName }},
                                    {{ activity.location.countryName }}

                                </template>
                                <template v-else>
                                    {{__('no location')}}
                                </template>

                            </div>
                            <div class="w-full md:text-right" v-if="activity.type === 'created_logout'">
                                <template v-if="activity.location">
                                    {{ activity.location.cityName }},
                                    {{ activity.location.countryName }}

                                </template>
                                <template v-else>
                                    {{__('no location')}}
                                </template>

                            </div>
                        </div>


                    </div>
                </div>
                <div class="inline-flex items-center justify-center w-full px-4 py-2 font-semibold leading-6 text-sm  transition ease-in-out duration-150 cursor-not-allowed" v-else>
                    <SpinnerIcon class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-900 dark:text-white"/>
                </div>

            </div>

        </template>

    </ActionSection>
</template>
