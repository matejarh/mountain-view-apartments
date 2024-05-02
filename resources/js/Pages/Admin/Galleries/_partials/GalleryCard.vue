<script setup>
import Carousel from '@/Components/Carousel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { router } from '@inertiajs/vue3'
import { getCurrentInstance, onMounted, ref, watch } from 'vue';

const props = defineProps({
    gallery: Object
})

const emit = defineEmits(['edit'])

const instance = getCurrentInstance()

const show = ref(false)

onMounted(() => {
    setTimeout(() => {
        show.value = true
    }, instance.vnode.key * 300);
})
</script>

<template>

    <!-- <Transition enter-active-class="animate__animated animate__bounceInDown" leave-active-class=""> -->

    <div class="max-w-sm bg-white border border-gray-200 overflow-hidden rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700  transition duration-150 ease-out"
        v-show="show">
        <div class="flex flex-col justify-between pb-4 h-full space-y-4">

            <Carousel :items="gallery.images" class="min-h-56" />

            <div class="p-4 h-full max-h-44 overflow-y-auto scrollbar-none" >

                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ gallery.name }}</h5>

                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400 ">{{ gallery.description }}</p>
            </div>

            <PrimaryButton type="button" @click="router.visit(route('admin.galleries.show', gallery))" class="mx-4">
                <div class="flex items-center">
                    {{__('Edit Gallery')}}
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </div>
            </PrimaryButton>
        </div>
    </div>
    <!-- </Transition> -->

</template>
