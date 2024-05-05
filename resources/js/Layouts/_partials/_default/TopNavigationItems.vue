<script setup>
import { watchEffect, ref } from 'vue';
import TopNavigationItem from './TopNavigationItem.vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    }
})

const showItem1 = ref(false)
const showItem2 = ref(false)
const showItem3 = ref(false)
const showItem4 = ref(false)
const showItem5 = ref(false)

watchEffect(async () => {
    if(props.show) {
        showItem1.value = true
        //setTimeout(() => { showItem1.value = true;}, 100);
        setTimeout(() => { showItem2.value = true;}, 100);
        setTimeout(() => { showItem3.value = true;}, 200);
        setTimeout(() => { showItem4.value = true;}, 300);
        setTimeout(() => { showItem5.value = true;}, 400);
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

                <TopNavigationItem key="home" v-show="showItem1" :to="'/'">
                    Home
                </TopNavigationItem>
                <TopNavigationItem key="bled" v-show="showItem2" :to="'/bled'">
                    Bled
                </TopNavigationItem>
                <TopNavigationItem key="nassfeld" v-show="showItem3" :to="'/nassfeld'">
                    Nassfeld
                </TopNavigationItem>
                <TopNavigationItem key="reservation" v-show="showItem4" :to="'/reservation'">
                    Reservation
                </TopNavigationItem>
                <button class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-deep-cerulean-700 dark:text-white md:dark:hover:text-deep-cerulean-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700" 
                    data-drawer-target="contact-drawer-form" 
                    data-drawer-show="contact-drawer-form" 
                    
                    aria-controls="contact-drawer-form"
                    v-show="showItem5"
                    key="contact">
                    Contact Us
                </button>
                <!-- <TopNavigationItem key="contact" v-show="showItem5" :to="'/contact-us'">
                    Contact Us
                </TopNavigationItem> -->
            </TransitionGroup>

        </ul>
    </Transition>
</template>