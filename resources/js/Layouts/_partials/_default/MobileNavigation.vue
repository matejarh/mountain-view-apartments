<script setup>
import MobileNavigationItem from '@/Components/_default/MobileNavigation/MobileNavigationItem.vue'
import HomeIcon from '@/Icons/HomeIcon.vue'
import BookOpenIcon from '@/Icons/BookOpenIcon.vue'
import LandmarkIcon from '@/Icons/LandmarkIcon.vue';
import PaperPlane from '@/Icons/PaperPlane.vue';
import { useHelperStore } from '@/stores/helpers';
import MobileThemeSwitch from '@/Components/_default/MobileThemeSwitch.vue';
import HamburgerButton from '@/Components/_default/MobileNavigation/HamburgerButton.vue';
import LanguageDropdown from '@/Components/_default/LanguageDropdown.vue';
import CloseIcon from '@/Icons/CloseIcon.vue';
import NavLink from '@/Components/NavLink.vue';
import ReservationInquiry from '@/Components/_default/ReservationInquiry.vue';
import CalendarIcon from '@/Icons/CalendarIcon.vue';
import AdjustmentsIcon from '@/Icons/AdjustmentsIcon.vue';
import UserIcon from '@/Icons/UserIcon.vue';
import SignOutIcon from '@/Icons/SignOutIcon.vue';
import { useForm } from '@inertiajs/vue3';


const helpers = useHelperStore()

const logoutForm = useForm({})

const logout = () => {
    helpers.hideMobileDrawer()
    logoutForm.post(route('logout'));
};
</script>

<template>


    <div class=" lg:hidden fixed top-0 left-0 z-50 w-full p-4 bg-transparent flex justify-between">
        <LanguageDropdown  align="left" :no-label="true" />

        <div class="space-x-4">
            <MobileThemeSwitch class="transition-all ease-out" />
            <HamburgerButton v-show="!helpers.mobileDrawer" @click="helpers.showMobileDrawer" />

        </div>
        <teleport to="body">
            <div v-if="helpers.mobileDrawer" @click="helpers.hideMobileDrawer"
                class="transition-all duration-300 ease-out absolute top-0 left-0 z-40 w-screen h-screen bg-gray-950 bg-opacity-65 backdrop-blur inset-0">
            </div>
            <div id="drawer-mobile"
                class="fixed top-0 right-0 z-50 h-screen overflow-y-auto flex flex-col justify-between transition-transform bg-white w-screen sm:w-80 dark:bg-gray-800"
                :class="helpers.mobileDrawer ? 'translate-x-0' : 'translate-x-full'" tabindex="-1"
                aria-labelledby="drawer-right-label">

                <div class="p-4 relative">
                    <div class="">
                        <h5 id="drawer-navigation-label"
                            class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">Menu</h5>
                        <button @click="helpers.hideMobileDrawer" type="button" data-drawer-hide="drawer-navigation"
                            aria-controls="drawer-navigation"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 end-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <CloseIcon class="w-5 h-5" />
                            <!-- <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg> -->
                            <span class="sr-only">Close menu</span>
                        </button>

                        <div class="py-4  flex flex-col justify-between ">
                            <div v-if="$page.props.auth.user" class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                                <div class="flex items-center gap-4">
                                    <img class="w-10 h-10 rounded-full" :src="$page.props.auth.user.profile_photo_url" alt="">
                                    <div class="font-medium dark:text-white">
                                        <div>{{ $page.props.auth.user.name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $page.props.auth.user.email }}</div>
                                    </div>
                                </div>

                                <MobileNavigationItem as="div" v-if="$page.props.auth.user.is_admin" @clicked="helpers.hideMobileDrawer"
                                    :active="`/admin/dashboard`" :href="route('admin.dashboard.show')">
                                    <template #icon>
                                        <AdjustmentsIcon />
                                    </template>
                                    {{ __("Home") }}
                                </MobileNavigationItem>
                                <MobileNavigationItem as="div"  @clicked="helpers.hideMobileDrawer"
                                    :active="`/user/profile`" :href="route('profile.show')">
                                    <template #icon>
                                        <UserIcon />
                                    </template>
                                    {{ __("My Profile") }}
                                </MobileNavigationItem>
                                <MobileNavigationItem as="div"  @clicked="logout" >
                                    <template #icon>
                                        <SignOutIcon />
                                    </template>
                                    {{ __("Sign out") }}
                                </MobileNavigationItem>
                            </div>
                            <!-- <div v-if="$page.props.auth" class="pt-1 mt-1 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                            </div> -->
                            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                                <MobileNavigationItem @clicked="helpers.hideMobileDrawer"
                                    :active="`/${$page.props.locale}`" :href="route('home', $page.props.locale)">
                                    <template #icon>
                                        <HomeIcon />
                                    </template>
                                    {{ __("Home") }}
                                </MobileNavigationItem>
                                <MobileNavigationItem @clicked="helpers.hideMobileDrawer"
                                    :active="`/${$page.props.locale}/accomodations`"
                                    :href="route('properties.index', $page.props.locale)">
                                    <template #icon>
                                        <LandmarkIcon />
                                    </template>
                                    {{ __("Accomodations") }}
                                </MobileNavigationItem>
                                <MobileNavigationItem @clicked="helpers.hideMobileDrawer"
                                    :active="`/${$page.props.locale}/stories`"
                                    :href="route('properties.index', $page.props.locale)">
                                    <template #icon>
                                        <BookOpenIcon />
                                    </template>
                                    {{ __("Stories") }}
                                </MobileNavigationItem>


                            </ul>

                        </div>

                    </div>

                </div>
                <div class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700 mx-4">
                    <h5
                        class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 uppercase dark:text-gray-400">
                        <CalendarIcon class="w-3.5 h-3.5 me-2.5" />
                        {{ __('Reservation Inquiry') }}
                    </h5>
                    <ReservationInquiry />
                </div>


            </div>
        </teleport>

        <!--         <div class="grid h-full max-w-lg grid-cols-4 md:grid-cols-1 mx-auto font-medium">
            <MobileNavigationItem :active="`/${$page.props.locale}`" :href="route('home', $page.props.locale)">
                <template #icon>
                    <HomeIcon />
                </template>
{{ __('Home') }}
</MobileNavigationItem>
<MobileNavigationItem :active="`/${$page.props.locale}/accomodations`"
    :href="route('properties.index', $page.props.locale)">
    <template #icon>
                    <LandmarkIcon />
                </template>
    {{ __('Apartments') }}
</MobileNavigationItem>

<MobileNavigationItem :active="`/${$page.props.locale}/stories`" :href="route('properties.index', $page.props.locale)">
    <template #icon>
                    <BookOpenIcon />
                </template>
    {{ __('Stories') }}
</MobileNavigationItem>

<MobileNavigationItem :active="helpers.contactDrawer" @click="helpers.showContactDrawer">
    <template #icon>
                    <PaperPlane class="rotate-90" />
                </template>
    {{ __('Contact') }}
</MobileNavigationItem>
</div> -->
    </div>

</template>


