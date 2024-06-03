<script setup>
import { computed, ref, watch} from 'vue';
import { debounce } from 'lodash';
import { trim } from 'lodash';
import { mapValues } from 'lodash';
import { usePage } from '@inertiajs/vue3';
import { pickBy } from 'lodash';
import { icons } from '@/icons';
import DialogModal from '@/Components/DialogModal.vue'
import ImageCard from '@/Components/Galleries/ImageCard.vue';


const props = defineProps({
    show: Boolean,
    gallery: Object,
})

const emit = defineEmits(['close', 'showUploadPhotoDialog', 'showEditDialog'])

const images = ref([])
const total_count = ref(0)

const page = usePage()

const busy = ref(false)
const filter = ref({
    search:''
})
const filteredImages = computed(() => {
    if (!form.value.search) {
        return page.props?.images_not_in_gallery;
    }

    const searchPattern = new RegExp(filter.value.search, 'i'); // 'i' flag for case-insensitive search
    return page.props?.images_not_in_gallery.filter(image => searchPattern.test(image.name));
    // return form.value.search ? page.props?.images_not_in_gallery.filter(image => image.name.match(/form.value.search.*/)) : page.props?.images_not_in_gallery
})

const fetch = () => {
    busy.value = true
    axios.get(route('admin.images.fetch', props.gallery))
        .then(response => {
            images.value = response.data.images
            total_count.value = response.data.total_count
            busy.value = false
        })
}

const form = ref({
    search: '',
})

const debouncedHandler = debounce(() => {
    form.value.search = trim(form.value.search)
    filter.value= pickBy(form.value)
    /*     router.get(route(props.route), pickBy(form.value), {
            preserveState: true,
            preserveScroll: true,
        }); */
}, 600);

watch(form, debouncedHandler, { deep: true });

const reset = () => {
    form.value = mapValues(form.value, () => null);
};

</script>

<template>
    <DialogModal max-width="screen" :show="show" @close="$emit('close')">
        <template #title>{{ __('Attach Images To Gallery') }}</template>

        <template #content>
            <div class="w-full mb-4">
                <label for="search_images" class="sr-only">{{ __('Search') }}</label>
                <div class="relative">
                    <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                        <icons.SearchIcon class="w-6 h-6 text-gray-500 dark:text-gray-200" />
                    </div>
                    <input type="search" @reset="reset" v-model="form.search" autocomplete="off" id="search_images"
                        class="block w-full p-3 ps-12 text-lg text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-600 focus:ring-0 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-600 dark:focus:border-primary-700"
                        :placeholder="__('Search images') + '...'">
                </div>
            </div>
            <Transition enter-active-class="animate__animated animate__fadeIn"
                leave-active-class="animate__animated animate__fadeOut absolute" class="min-h-[75vh]">

                <div class="p-6 w-full" v-if="busy">
                    <icons.SpinnerIcon class="w-6 h-6 animate-spin mx-auto" />
                </div>
                <div class="" v-else>

                    <TransitionGroup v-if="filteredImages.length > 0" name="list" tag="ul"
                        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 4xl:grid-cols-6 gap-4 md:gap-4 lg:gap-6 2xl:gap-8">
                        <ImageCard :image="image" v-for="image, key in filteredImages" :key="image.id"
                            :has-gallery="false" />
                        <div key="empty">
                            <div class="w-full text-center cursor-pointer " @click="$emit('showUploadPhotoDialog')">
                                <icons.ImageIcon class="text-gray-300 dark:text-gray-400 w-32 h-32 mx-auto" />

                                <p class="text-gray-300 dark:text-gray-400 text-sm">{{ __('Click here to upload some')
                                    }}</p>
                            </div>
                        </div>
                    </TransitionGroup>


                    <div v-else class="h-full flex flex-col justify-center">
                        <div class="w-full text-center cursor-pointer" @click="$emit('showUploadPhotoDialog')">
                            <icons.ImageIcon class="text-gray-300 dark:text-gray-400 w-32 h-32 mx-auto" />

                            <p class="text-gray-300 dark:text-gray-400 font-semibold ">{{ $page.props?.total_images_count
                                > 0 ? __('All uploaded images are attached to gallery!') : __('No images uploaded yet!')
                                }}</p>
                            <p class="text-gray-300 dark:text-gray-400 text-sm">{{ __('Click here to upload some') }}
                            </p>
                        </div>
                    </div>

                </div>
            </Transition>

        </template>
    </DialogModal>
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
