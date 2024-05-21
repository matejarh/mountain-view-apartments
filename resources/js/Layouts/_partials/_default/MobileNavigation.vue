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
import Backdrop from '@/Components/_default/Backdrop.vue';


const helpers = useHelperStore()

const logoutForm = useForm({})

const logout = () => {
    helpers.hideMobileDrawer()
    logoutForm.post(route('logout'));
};
</script>

<template>


    <div class=" xl:hidden fixed top-0 left-0 z-50 w-full p-4 bg-transparent flex justify-between">
        <LanguageDropdown  align="left" :no-label="true" />

        <div class="space-x-4">
            <MobileThemeSwitch class="transition-all ease-out backdrop-blur bg-opacity-50" />
            <HamburgerButton v-show="!helpers.mobileDrawer" @click="helpers.showMobileDrawer" />

        </div>
        <teleport to="body">
            <Backdrop v-show="helpers.mobileDrawer" @close="helpers.hideMobileDrawer"/>

            <div id="drawer-mobile"
                class="fixed top-0 right-0 z-50 h-screen overflow-y-auto flex flex-col justify-between transition-transform bg-white w-screen sm:w-80 dark:bg-gray-800"
                :class="helpers.mobileDrawer ? 'translate-x-0' : 'translate-x-full'" tabindex="-1"
                aria-labelledby="drawer-right-label">

                <div class="p-4 relative">
                    <div class="">
                        <h5 id="drawer-navigation-label"
                            class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">{{__('Menu')}}</h5>
                        <button @click="helpers.hideMobileDrawer" type="button"

                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 end-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <CloseIcon class="w-5 h-5" />
                            <span class="sr-only">{{__('Close menu')}}</span>
                        </button>

                        <div class="py-4  flex flex-col justify-between ">
                            <div v-if="$page.props?.auth.user" class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                                <div class="flex items-center gap-4">
                                    <img class="w-10 h-10 rounded-full" :src="$page.props?.auth.user.profile_photo_url" alt="">
                                    <div class="font-medium dark:text-white">
                                        <div>{{ $page.props?.auth.user.name }}</div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ $page.props?.auth.user.email }}</div>
                                    </div>
                                </div>

                                <MobileNavigationItem as="div" v-if="$page.props?.auth.user.is_admin" @clicked="helpers.hideMobileDrawer"
                                    :active="`/admin/dashboard`" :href="route('admin.dashboard.show')">
                                    <template #icon>
                                        <AdjustmentsIcon />
                                    </template>
                                    {{ __("Administration") }}
                                </MobileNavigationItem>
                                <MobileNavigationItem as="div"  @clicked="helpers.hideMobileDrawer"
                                    :active="`/user/profile`" :href="route('profile.show')">
                                    <template #icon>
                                        <UserIcon />
                                    </template>
                                    {{ __("My Profile") }}
                                </MobileNavigationItem>
                                <MobileNavigationItem as="div" :href="null"  @clicked="logout" >
                                    <template #icon>
                                        <SignOutIcon />
                                    </template>
                                    {{ __("Sign out") }}
                                </MobileNavigationItem>
                            </div>
                            <!-- <div v-if="$page.props?.auth" class="pt-1 mt-1 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                            </div> -->
                            <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200 dark:border-gray-700">
                                <MobileNavigationItem @clicked="helpers.hideMobileDrawer"
                                    :active="`/${$page.props?.locale}`" :href="route('home', $page.props?.locale)">
                                    <template #icon>
                                        <HomeIcon class="w-5 h-5" />
                                    </template>
                                    {{ __("Home") }}
                                </MobileNavigationItem>
                                <MobileNavigationItem @clicked="helpers.hideMobileDrawer"
                                    :active="`/${$page.props?.locale}/accomodations`"
                                    :href="route('properties.index', $page.props?.locale)">
                                    <template #icon>
                                        <LandmarkIcon class="w-5 h-5" />
                                    </template>
                                    {{ __("Apartments") }}
                                </MobileNavigationItem>
                                <MobileNavigationItem @clicked="helpers.hideMobileDrawer"
                                    :active="`/${$page.props?.locale}/explore/bled`"
                                    :href="route('explore.bled', $page.props?.locale)">
                                    <template #icon>
                                        <LandmarkIcon class="w-5 h-5" />
                                    </template>
                                    {{ __("Explore Bled") }}
                                </MobileNavigationItem>
                                <MobileNavigationItem @clicked="helpers.hideMobileDrawer"
                                    :active="`/${$page.props?.locale}/discover/nassfeld`"
                                    :href="route('discover.nassfeld', $page.props?.locale)">
                                    <template #icon>
                                        <LandmarkIcon class="w-5 h-5" />
                                    </template>
                                    {{ __("Explore Nassfeld") }}
                                </MobileNavigationItem>
<!--                                 <MobileNavigationItem @clicked="helpers.hideMobileDrawer"
                                    :active="`/${$page.props?.locale}/offers`"
                                    :href="route('offers', $page.props?.locale)">
                                    <template #icon>
                                        <LandmarkIcon class="w-5 h-5" />
                                    </template>
                                    {{ __("Offers") }}
                                </MobileNavigationItem> -->
                                <MobileNavigationItem @clicked="helpers.hideMobileDrawer"
                                    :active="`/${$page.props?.locale}/about-us`"
                                    :href="route('aboutus', $page.props?.locale)">
                                    <template #icon>
                                        <LandmarkIcon class="w-5 h-5" />
                                    </template>
                                    {{ __("About Us") }}
                                </MobileNavigationItem>
                                <MobileNavigationItem @clicked="helpers.hideMobileDrawer"
                                    :active="`/${$page.props?.locale}/contact`"
                                    :href="route('contact.show', $page.props?.locale)">
                                    <template #icon>
                                        <BookOpenIcon class="w-5 h-5" />
                                    </template>
                                    {{ __("Contact") }}
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
                    <ReservationInquiry @close="helpers.hideMobileDrawer" />
                </div>


            </div>
        </teleport>

        <!--         <div class="grid h-full max-w-lg grid-cols-4 md:grid-cols-1 mx-auto font-medium">
            <MobileNavigationItem :active="`/${$page.props?.locale}`" :href="route('home', $page.props?.locale)">
                <template #icon>
                    <HomeIcon />
                </template>
{{ __('Home') }}
</MobileNavigationItem>
<MobileNavigationItem :active="`/${$page.props?.locale}/accomodations`"
    :href="route('properties.index', $page.props?.locale)">
    <template #icon>
                    <LandmarkIcon />
                </template>
    {{ __('Apartments') }}
</MobileNavigationItem>

<MobileNavigationItem :active="`/${$page.props?.locale}/stories`" :href="route('properties.index', $page.props?.locale)">
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


