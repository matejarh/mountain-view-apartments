<script setup>
import FullLayout from '@/Layouts/FullLayout.vue';
import DeleteUserForm from '@/Pages/Profile/Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from '@/Pages/Profile/Partials/LogoutOtherBrowserSessionsForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import TabsSection from '@/Components/TabsSection.vue';
import TabButton from '@/Components/TabButton.vue';
import TwoFactorAuthenticationForm from '@/Pages/Profile/Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm from '@/Pages/Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '@/Pages/Profile/Partials/UpdateProfileInformationForm.vue';
import { computed, defineComponent, h, ref, useSlots } from 'vue';
import ActivityTable from './Partials/ActivityTable.vue';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { usePage } from '@inertiajs/vue3';
import EmptyDiv from '@/Components/EmptyDiv.vue';
import Wrapper from '@/Components/_default/Wrapper.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array,
});

const page = usePage()

const layout = computed(() => {
    if (page.props.auth.user) {
        return page.props.auth.user.is_admin ? FullLayout : DefaultLayout
    }
    return DefaultLayout
})



const show = ref('profile')

const slots = useSlots()

const component = computed(() => {
    if (page.props.auth.user) {
        return page.props.auth.user.is_admin ? EmptyDiv : Wrapper
    }
    return EmptyDiv
})
</script>

<template>
    <component :is="layout" :title="__('Profile')">
        <template #header>

            {{ __('Profile') }}

        </template>

        <component :is="component" :class="{'sm:pt-36':!$page.props.auth.user.is_admin}">
            <TabsSection :confirms-two-factor-authentication="confirmsTwoFactorAuthentication" :sessions="sessions">
                <template #buttons>
                    <TabButton for="profile" @clicked="show = 'profile'" :show="show">
                        <template #icon>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                            </svg>
                        </template>
                        {{ __('Profile Information') }}
                    </TabButton>
                    <TabButton for="password" @clicked="show = 'password'" :show="show">
                        <template #icon>

                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M15 7a2 2 0 1 1 4 0v4a1 1 0 1 0 2 0V7a4 4 0 0 0-8 0v3H5a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2V7Zm-5 6a1 1 0 0 1 1 1v3a1 1 0 1 1-2 0v-3a1 1 0 0 1 1-1Z"
                                    clip-rule="evenodd" />
                            </svg>


                        </template>
                        {{ __('Update Password') }}
                    </TabButton>
                    <TabButton for="two_factor" @clicked="show = 'two_factor'" :show="show">
                        <template #icon>
                            <svg xmlns="http://www.w3.org/2000/svg" widt fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M21 12a28.076 28.076 0 0 1-1.091 9M7.231 4.37a8.994 8.994 0 0 1 12.88 3.73M2.958 15S3 14.577 3 12a8.949 8.949 0 0 1 1.735-5.307m12.84 3.088A5.98 5.98 0 0 1 18 12a30 30 0 0 1-.464 6.232M6 12a6 6 0 0 1 9.352-4.974M4 21a5.964 5.964 0 0 1 1.01-3.328 5.15 5.15 0 0 0 .786-1.926m8.66 2.486a13.96 13.96 0 0 1-.962 2.683M7.5 19.336C9 17.092 9 14.845 9 12a3 3 0 1 1 6 0c0 .749 0 1.521-.031 2.311M12 12c0 3 0 6-2 9" />
                            </svg>

                        </template>
                        {{ __('Two Factor Authentication') }}
                    </TabButton>
                    <TabButton for="sessions" @clicked="show = 'sessions'" :show="show">
                        <template #icon>
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 8a1 1 0 0 0-1 1v10H9a1 1 0 1 0 0 2h11a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1h-8Zm4 10a2 2 0 1 1 0-4 2 2 0 0 1 0 4Z"
                                    clip-rule="evenodd" />
                                <path fill-rule="evenodd"
                                    d="M5 3a2 2 0 0 0-2 2v6h6V9a3 3 0 0 1 3-3h8c.35 0 .687.06 1 .17V5a2 2 0 0 0-2-2H5Zm4 10H3v2a2 2 0 0 0 2 2h4v-4Z"
                                    clip-rule="evenodd" />
                            </svg>


                        </template>
                        {{ __('Browser Sessions') }}
                    </TabButton>
                    <TabButton for="activity" @clicked="show = 'activity'" :show="show">
                        <template #icon>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M8 5a1 1 0 0 1 1-1h11a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-1a1 1 0 1 1 0-2h1V6H9a1 1 0 0 1-1-1Z"
                                    clip-rule="evenodd" />
                                <path fill-rule="evenodd"
                                    d="M4 7a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2H4Zm0 11v-5.5h11V18H4Z"
                                    clip-rule="evenodd" />
                            </svg>

                        </template>
                        {{ __('Activity Log') }}
                    </TabButton>
                    <TabButton for="delete_account" @clicked="show = 'delete_account'" :show="show">
                        <template #icon>
                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M5 8a4 4 0 1 1 8 0 4 4 0 0 1-8 0Zm-2 9a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v1a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-1Zm13-6a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4Z"
                                    clip-rule="evenodd" />
                            </svg>


                        </template>
                        {{ __('Delete Account') }}
                    </TabButton>
                </template>
                <template #content>
                    <div v-if="$page.props.jetstream.canUpdateProfileInformation && show === 'profile'">
                        <UpdateProfileInformationForm :user="$page.props.auth.user" />
                    </div>
                    <div v-if="$page.props.jetstream.canUpdatePassword && show === 'password'">
                        <UpdatePasswordForm />
                    </div>
                    <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication && show === 'two_factor'">
                        <TwoFactorAuthenticationForm :requires-confirmation="confirmsTwoFactorAuthentication" />
                    </div>
                    <div v-if="show === 'sessions'">
                        <LogoutOtherBrowserSessionsForm :sessions="sessions" />
                    </div>
                    <div v-if="show === 'activity'">
                        <ActivityTable />
                    </div>
                    <div v-if="$page.props.jetstream.hasAccountDeletionFeatures && show === 'delete_account'">
                        <DeleteUserForm />
                    </div>
                </template>
            </TabsSection>
        </component>

    </component>
</template>
