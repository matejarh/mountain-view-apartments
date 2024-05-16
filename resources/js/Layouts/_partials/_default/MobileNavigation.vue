<script setup>
import MobileNavigationItem from '@/Components/_default/MobileNavigation/MobileNavigationItem.vue'
import HomeIcon from '@/Icons/HomeIcon.vue'
import BookOpenIcon from '@/Icons/BookOpenIcon.vue'
import LandmarkIcon from '@/Icons/LandmarkIcon.vue';
import PaperPlane from '@/Icons/PaperPlane.vue';
import { useHelperStore } from '@/stores/helpers';
import ThemeSwitch from '@/Components/_default/ThemeSwitch.vue';
import LanguageDropdown from '@/Components/_default/LanguageDropdown.vue';
import CloseIcon from '@/Icons/CloseIcon.vue';
import NavLink from '@/Components/NavLink.vue';
import ReservationInquiry from '@/Components/_default/ReservationInquiry.vue';
import CalendarIcon from '@/Icons/CalendarIcon.vue';


const helpers = useHelperStore()
</script>

<template>


    <div class=" lg:hidden fixed top-0 left-0 z-50 w-full p-4 bg-transparent flex justify-between">
        <LanguageDropdown v-show="!helpers.mobileDrawer" align="left" :no-label="true" />

        <button v-show="!helpers.mobileDrawer" data-collapse-toggle="navbar-language" @click="helpers.showMobileDrawer"
            type="button"
            class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-200 hover:text-gray-50 focus:text-white transition-colors rounded-lg lg:hidden backdrop-blur bg-opacity-50"
            aria-controls="navbar-language" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-5 h-5 drop-shadow-lg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 17 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 1h15M1 7h15M1 13h15" />
            </svg>
        </button>
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
                            <ul class="space-y-2 font-medium flex-1">
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
                <div class="py-4 px-4">
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

<style>
:root {
    --dp-font-family: font-family: Figtree, ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    --dp-font-size: 0.875rem;
    --dp-input-padding: 0.625rem;
    --dp-border-radius: 0.5rem;

}

.dp__theme_dark {
    --dp-background-color: rgb(79 79 79);
    --dp-hover-color: #454545;
    --dp-hover-text-color: #fff;
    --dp-hover-icon-color: #848484;
    --dp-primary-color: #0093c4;
    --dp-primary-disabled-color: #61a8ea;
    --dp-primary-text-color: #fff;
    --dp-secondary-color: #b0b0b0;
    --dp-border-color: rgb(93 93 93);
    --dp-menu-border-color: rgb(93 93 93);
    --dp-border-color-hover: #b0b0b0;
    --dp-disabled-color: #6d6d6d;
    --dp-disabled-color-text: #6d6d6d;
    --dp-scroll-bar-background: rgb(93 93 93);
    ;
    --dp-scroll-bar-color: #4f4f4f;
    --dp-success-color: #2f6c4b;
    --dp-success-color-disabled: #63a47d;
    --dp-icon-color: #848484;
    --dp-danger-color: #e52f1d;
    --dp-marker-color: #e52f1d;
    --dp-tooltip-color: #454545;
    --dp-highlight-color: rgb(0 123 167 / 20%);
    --dp-range-between-dates-background-color: var(--dp-hover-color, #454545);
    --dp-range-between-dates-text-color: var(--dp-hover-text-color, #fff);
    --dp-range-between-border-color: var(--dp-hover-color, #fff);
}

.dp__theme_light {
    --dp-background-color: rgb(246 246 246);
    --dp-text-color: #262626;
    --dp-hover-color: #e7e7e7;
    --dp-hover-text-color: #262626;
    --dp-hover-icon-color: #848484;
    --dp-primary-color: #007ba7;
    --dp-primary-disabled-color: #00bbea;
    --dp-primary-text-color: #f6f6f6;
    --dp-secondary-color: #b0b0b0;
    --dp-border-color: rgb(176 176 176);
    --dp-menu-border-color: rgb(176 176 176);
    --dp-border-color-hover: #b0b0b0;
    --dp-disabled-color: #e7e7e7;
    --dp-scroll-bar-background: #e7e7e7;
    --dp-scroll-bar-color: #b0b0b0;
    --dp-success-color: #63a47d;
    --dp-success-color-disabled: #bdddc7;
    --dp-icon-color: #848484;
    --dp-danger-color: #ff6f61;
    --dp-marker-color: #ff6f61;
    --dp-tooltip-color: #f6f6f6;
    --dp-disabled-color-text: #848484;
    --dp-highlight-color: rgb(0 123 167 / 10%);
    --dp-range-between-dates-background-color: var(--dp-hover-color, #e7e7e7);
    --dp-range-between-dates-text-color: var(--dp-hover-text-color, #262626);
    --dp-range-between-border-color: var(--dp-hover-color, #e7e7e7);
}
</style>
