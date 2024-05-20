<script setup>
import { computed, onMounted, ref, watchEffect } from 'vue';
import ThemeSwitch from '@/Components/_default/ThemeSwitch.vue';
import LanguageDropdown from '@/Components/_default/LanguageDropdown.vue';
import TopNavigationItems from './TopNavigationItems.vue';
import LogoComponent from '@/Components/_default/LogoComponent.vue';
import ShapeBottom from '@/Components/_default/ShapeBottom.vue';
import UserDropdown from '@/Components/TopNavigation/UserDropdown.vue';
import { useHelperStore } from '@/stores/helpers';

const props = defineProps({
    scrollPosition: Number,
    show: Boolean,
})

const helpers = useHelperStore()
/* const showLogo = ref(false)
const showNav = ref(false)
const showIcons = ref(false)
const showLang = ref(false)
const showTheme = ref(false)
const showUserDropdown = ref(false) */

const headerClasses = computed(() => {
    return [
        props.scrollPosition > 100 ? 'text-lg' : 'text-xl'
    ]
})
watchEffect(async () => {
    if (props.show && !helpers.pageLoaded) {
        helpers.delay(0)
            .then(() => helpers.showLogo = true)
            .then(() => helpers.delay(1000))
            .then(() => helpers.showNav = true)
            .then(() => helpers.delay(800))
            .then(() => helpers.showIcons = true)
            .then(() => helpers.delay(100))
            .then(() => helpers.showLang = true)
            .then(() => helpers.delay(100))
            .then(() => helpers.showTheme = true)
            .then(() => helpers.delay(100))
            .then(() => helpers.showUserDropdown = true);
    }
});

</script>

<template>

    <Transition enter-active-class="animate__animated animate__slideInDown"
        leave-active-class="animate__animated animate__slideOutUp">

        <nav v-show="show"
            class="hidden xl:block bg-gray-50 dark:bg-gray-950  left-0 right-0 top-0 transition-all fixed ease-out duration-300 z-40"
            :class="scrollPosition > 100 ? 'min-h-14 ' : 'min-h-[128px]'">
            <ShapeBottom
                class="absolute drop-shadow-lg transition-all ease-out duration-300 inset-y-full z-10 left-0 right-0 w-full transform -translate-y-4 text-gray-50 dark:text-gray-950 drop-shadow-b-lg " />
            <div class="max-w-screen-xl bg-gray-50 border-gray-200 dark:bg-gray-950  flex flex-wrap items-center justify-between mx-auto transition-all duration-300 ease-out overflow-visible"
                :class="scrollPosition > 100 ? 'p-0' : 'p-0'">
                <Transition enter-active-class="animate__animated animate__bounceInDown"
                    leave-active-class="animate__animated animate__bounceOutUp">

                    <inertia-link v-show="helpers.showLogo" href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <LogoComponent :scrollPosition="scrollPosition" class="ms-3 translate-y-4 z-20  " />
                    </inertia-link>

                </Transition>

                <div
                    class="flex items-center justify-end md:order-2 space-x-1 md:space-x-0 rtl:space-x-reverse md:min-w-[192px] ">
                    <Transition enter-active-class="animate__animated animate__bounceInDown"
                        leave-active-class="animate__animated animate__bounceOutUp">

                        <div class="flex justify-end  space-x-2 me-2" v-show="helpers.showIcons">
                            <Transition enter-active-class="animate__animated animate__bounceInDown"
                                leave-active-class="animate__animated animate__bounceOutUp">

                                <LanguageDropdown v-show="helpers.showLang" />
                            </Transition>

                            <button data-collapse-toggle="navbar-language" type="button"
                                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                aria-controls="navbar-language" aria-expanded="false">
                                <span class="sr-only">Open main menu</span>
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 17 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                                </svg>
                            </button>
                            <Transition enter-active-class="animate__animated animate__bounceInDown"
                                leave-active-class="animate__animated animate__bounceOutUp">

                                <ThemeSwitch v-show="helpers.showTheme" />
                            </Transition>
                            <Transition enter-active-class="animate__animated animate__bounceInDown"
                                leave-active-class="animate__animated animate__bounceOutUp">

                                <UserDropdown v-if="$page.props.auth.user" v-show="helpers.showUserDropdown" />
                            </Transition>
                        </div>
                    </Transition>
                </div>

                <div class="items-center justify-between hidden w-full lg:flex md:w-auto md:order-1"
                    id="navbar-language">

                    <TopNavigationItems :show="helpers.showNav" />


                </div>
            </div>
        </nav>
    </Transition>

</template>
