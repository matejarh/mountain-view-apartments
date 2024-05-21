<script setup>
import ImageIcon from '@/Icons/ImageIcon.vue';
import GalleryCard from './GalleryCard.vue';
import { useForm, usePage } from '@inertiajs/vue3';

defineEmits(['manage'])

const page = usePage()

const detachForm = useForm({})

const detach = (gallery) => {
    // emit('close')
    detachForm.put(route('admin.pages.detach.gallery', { gallery: gallery, page: page.props?.page }), {
        errorBag: 'attachingToGallery',
        onSuccess: () => {
            //  console.log('attachec')
        }
    })
}
</script>

<template>
    <div class="">
        <div class="relative">
            <TransitionGroup name="list" tag="ul"
                class=" relative grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 4xl:grid-cols-6 gap-4 md:gap-4 lg:gap-6 2xl:gap-8">

                <GalleryCard v-for="gallery, key in $page.props?.page.galleries" :key="gallery.id" :gallery="gallery"
                    @detach="detach" direction="detach" />
                <li key="0">
                    <div class="w-full text-center flex flex-col justify-center h-full cursor-pointer"
                        @click="$emit('manage')">
                        <ImageIcon class="text-gray-300 dark:text-gray-400 w-32 h-32 mx-auto" />

                        <p v-if="$page.props?.page.galleries.length > 0"
                            class="text-gray-300 dark:text-gray-400 font-semibold ">{{ __('Attach another gallery!') }}
                        </p>
                        <template v-else>

                            <p class="text-gray-300 dark:text-gray-400 font-semibold ">{{ __('No galleries attached yet!') }}</p>
                            <p class="text-gray-300 dark:text-gray-400 text-sm">{{ __('To attach one, click here') }}
                            </p>
                        </template>
                    </div>
                </li>
            </TransitionGroup>
        </div>

        <!-- <div v-else class="">
            <div class="w-full text-center cursor-pointer" @click="$emit('manage')">
                <ImageIcon class="text-gray-300 dark:text-gray-400 w-32 h-32 mx-auto" />

                <p class="text-gray-300 dark:text-gray-400 font-semibold ">{{ __('No galleries attached yet!') }}</p>
                <p class="text-gray-300 dark:text-gray-400 text-sm">{{ __('To attach one, click here') }}</p>
            </div>
        </div> -->
    </div>
</template>

<style scoped>
.list-move,
/* apply transition to moving elements */
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateY(50px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-leave-active {
    position: absolute;
}
</style>
