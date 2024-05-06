<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import GridSection from '@/Components/GridSection.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';
import { useForm } from '@inertiajs/vue3';
import { computed, onBeforeMount, onMounted, ref, watchEffect } from 'vue';

const props = defineProps({
    show: Boolean,
    setting: Object,
    attribute: String,

})

const emit = defineEmits(['close'])

const form = useForm({
    name: props.setting?.name,
    description: props.setting?.description,
    attributes: props.setting?.attributes,
})
const isFetching = ref(false)

const currentUrl = computed(() => {
    return props.setting.attributes[props.attribute].photo_url
})

watchEffect(() => {
    if (props.show) {
        setTimeout(() => {
            fetch()

        }, 300);
    }
})
const setAttribute = (image) => {
    //console.log(url)

    //console.log(props.attribute)
    form.attributes[props.attribute] = {
        photo_url: image.photo_url,
        thumb_url: image.thumb_url
    }
    update()
}

const update = () => {
    //console.log(form)
    form.put(route('admin.settings.update', props.setting), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
            emit('close')
            // fetch()
        }
    })
}

const images = ref([])

const fetch = async () => {
    isFetching.value = true
    await axios.get(`/admin/images/fetch-backgrounds/?attribute=${props.setting.attributes[props.attribute].photo_url}`)
        .then(response => {
            images.value = response.data.images
            isFetching.value = false
        })
        .catch(error => console.error)
}

/* onBeforeMount(() => {
    fetch()
}) */
</script>

<template>
    <DialogModal max-width="screen" :show="show" @close="form.reset(), $emit('close')">
        <template #title>{{ __('Select image') }}</template>

        <template #content>
            <TransitionGroup name="list" tag="ul" class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 ">
                <li v-for="image, key in images.data" :key="image.id"
                    @click.prevent="setAttribute(image)">
                    <button :class="{ 'opacity-25': form.processing || form.recentlySuccessful || isFetching }"
                            :disabled="form.processing || form.recentlySuccessful || isFetching" @click="handleSubmit" @click.prevent="setAttribute(image.photo_url)"
                        class="relative rounded-lg transition duration-300 ease-out hover:scale-105 active:scale-95 overflow-hidden">

                        <img :src="image.thumb_url" :alt="image.name" class="h-auto max-w-full " />

                        <div v-show="form.processing || form.recentlySuccessful || isFetching" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                            <SpinnerIcon
                                class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />

                        </div>
                    </button>

                </li>
            </TransitionGroup>

            <!-- <PrimaryButton type="button" @click.prevent="setAttribute('test')">set</PrimaryButton> -->
        </template>

        <template #footer>

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
