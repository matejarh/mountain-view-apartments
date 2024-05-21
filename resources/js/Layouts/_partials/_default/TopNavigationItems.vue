<script setup>
import { watchEffect } from 'vue';
import TopNavigationItem from './TopNavigationItem.vue';
import { useHelperStore } from '@/stores/helpers';

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    }
})

const helpers = useHelperStore()

// Define an array of navigation items
const navItems = [
    { key: 'home', to: (locale) => `/${locale}/home`, label: 'Home' },
    { key: 'accomodations', to: (locale) => `/${locale}/accomodations`, label: 'Apartments' },
    { key: 'bled', to: (locale) => `/${locale}/explore/bled`, label: 'Explore Bled' },
    { key: 'nassfeld', to: (locale) => `/${locale}/discover/nassfeld`, label: 'Discover Nassfeld' },
    { key: 'aboutus', to: (locale) => `/${locale}/about-us`, label: 'About Us' },
    { key: 'contact', as: 'button', onClick: () => helpers.showContactDrawer(), label: 'Contact Us' }
];

watchEffect(async () => {
    if (props.show && !helpers.pageLoaded) {
        for (let i = 0; i < navItems.length; i++) {
            helpers.showNavItems[i + 1] = true;
            await helpers.delay(100);
        }
    }
});
</script>

<template>
    <Transition enter-active-class="animate__animated animate__bounceInDown"
                leave-active-class="animate__animated animate__bounceOutUp">
        <ul v-show="show"
            class="flex flex-col font-medium p-4 md:p-0 mt-4 border w-full rounded-lg md:space-x-2 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0">
            <TransitionGroup enter-active-class="animate__animated animate__bounceInDown"
                             leave-active-class="animate__animated animate__bounceOutUp">
                <TopNavigationItem
                    v-for="(item, index) in navItems"
                    :key="item.key"
                    v-show="helpers.showNavItems[index + 1]"
                    :as="item.as || 'link'"
                    :to="item.to ? item.to($page.props?.locale) : '/'"
                    @click="item.onClick"
                >
                    {{ __(item.label) }}
                </TopNavigationItem>
            </TransitionGroup>
        </ul>
    </Transition>
</template>
