<script setup>
import { watchEffect, ref } from 'vue';
import TopNavigationItem from './TopNavigationItem.vue';
import { useHelperStore } from '@/stores/helpers';

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    }
})

const helpers = useHelperStore()

const showItem1 = ref(false)
const showItem2 = ref(false)
const showItem3 = ref(false)
const showItem4 = ref(false)
const showItem5 = ref(false)

watchEffect(async () => {
    if (props.show && !helpers.pageLoaded) {
        helpers.delay(0)
            .then(() => {
                helpers.showNavItems[1] = true
                return helpers.delay(100)
            })
            .then(() => {
                helpers.showNavItems[2] = true
                return helpers.delay(100)
            })
            .then(() => {
                helpers.showNavItems[3] = true
                return helpers.delay(100)
            })
            .then(() => {
                helpers.showNavItems[4] = true
                return helpers.delay(100)
            })
            .then(() => {
                helpers.showNavItems[5] = true
                return helpers.delay(100)
            })
    }

})

</script>

<template>
    <Transition enter-active-class="animate__animated animate__bounceInDown"
        leave-active-class="animate__animated animate__bounceOutUp">

        <ul v-show="show"
            class="flex flex-col font-medium p-4 md:p-0 mt-4 border  rounded-lg  md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 ">
            <TransitionGroup enter-active-class="animate__animated animate__bounceInDown"
                leave-active-class="animate__animated animate__bounceOutUp">

                <TopNavigationItem key="home" v-show="helpers.showNavItems[1]" :to="'/' + $page.props.locale">
                    {{ __('Home') }}
                </TopNavigationItem>
                <TopNavigationItem key="accomodations" v-show="helpers.showNavItems[2]"
                    :to="`/${$page.props.locale}/accomodations`">
                    {{ __('Apartments') }}
                </TopNavigationItem>
                <TopNavigationItem key="bled" v-show="helpers.showNavItems[3]"
                    :to="`/${$page.props.locale}/explore/bled`">
                    {{ __('Explore Bled') }}
                </TopNavigationItem>
                <TopNavigationItem key="nassfeld" v-show="helpers.showNavItems[3]"
                    :to="`/${$page.props.locale}/discover/nassfeld`">
                    {{ __('Discover Nassfeld') }}
                </TopNavigationItem>
<!--                 <TopNavigationItem key="offers" v-show="helpers.showNavItems[3]"
                    :to="`/${$page.props.locale}/offers`">
                    {{ __('Offers') }}
                </TopNavigationItem> -->
                <TopNavigationItem key="aboutus" v-show="helpers.showNavItems[3]"
                    :to="`/${$page.props.locale}/about-us`">
                    {{ __('About Us') }}
                </TopNavigationItem>
                <!-- <TopNavigationItem key="reservation" v-show="helpers.showNavItems[4]" :to="'/reservation'">
                    {{ __('Reservation') }}
                </TopNavigationItem> -->
<!--                 <TopNavigationItem key="stories" v-show="helpers.showNavItems[4]" :to="`/${$page.props.locale}/stories`">
                    {{ __('Stories') }}
                </TopNavigationItem> -->

                <TopNavigationItem as="button" key="contact" v-show="helpers.showNavItems[5]"
                    @click="helpers.showContactDrawer">
                    {{ __('Contact Us') }}
                </TopNavigationItem>

                <!-- <TopNavigationItem key="contact" v-show="showItem5" :to="'/contact-us'">
                    Contact Us
                </TopNavigationItem> -->
            </TransitionGroup>

        </ul>
    </Transition>
</template>
