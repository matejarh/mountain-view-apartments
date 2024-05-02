<script setup>
import { onMounted, onUnmounted, ref } from 'vue';
const props = defineProps({
    modelValue: Array,
})

const emit = defineEmits(['droped', 'update:modelValue'])

const handleDrop = (e) => {
    setInactive()
    emit('update:modelValue', [...e.dataTransfer.files])
    updatePhotoPreview(e.dataTransfer.files)
}
const handleSelect = (e) => {
    setInactive()
    emit('update:modelValue', [...e.target.files])
    updatePhotoPreview(e.target.files)
}

const preventDefaults = (e) => {
    e.preventDefault()
}

const events = ['dragenter', 'dragover', 'dragleave', 'drop']


// Create `active` state and manage it with functions
const active = ref(false)

let inActiveTimeout = null

const setActive = () => {
    active.value = true
    clearTimeout(inActiveTimeout)
}

const setInactive = () => {
    inActiveTimeout = setTimeout(() => {
        active.value = false
    }, 50)
}

const updatePhotoPreview = (files) => {
    for (let index = 0; index < files.length; index++) {

        const photo = files[index];

        if (!photo) return;

        const reader = new FileReader();

        reader.onload = (e) => {
            photoPreview.value.push(e.target.result);
        };

        reader.readAsDataURL(photo);
    }
};

const removeFromPhotoPreview = (value) => {

    /*     photoPreview.value = photoPreview.value.filter(function(item, key) {
            return key !== value
        }) */
    const index = photoPreview.value.indexOf(value);
    if (index > -1) {
        photoPreview.value.splice(index, 1);
    }
}

const photoInput = ref(null);
const photoPreview = ref([]);

onMounted(() => {
    events.forEach((eventName) => {
        document.body.addEventListener(eventName, preventDefaults)
    })
})

onUnmounted(() => {
    events.forEach((eventName) => {
        document.body.removeEventListener(eventName, preventDefaults)
    })
})
</script>

<template>
    <div>
        <div v-show="photoPreview" class="my-2 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 lg:grid-cols-6">
            <TransitionGroup enter-active-class="animate__animated animate__zoomIn"
                leave-active-class="animate__animated animate__hinge">

                <span v-for="photo, key in photoPreview" :key="photo"
                    class="transition relative block rounded-lg shadow-lg  w-20 h-20  bg-cover bg-no-repeat bg-center"
                    :style="'background-image: url(\'' + photo + '\');'">

                    <button class="absolute top-0 right-0 text-bittersweet-700" @click="removeFromPhotoPreview(photo)">
                        <svg class="w-6 h-6 " aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm7.707-3.707a1 1 0 0 0-1.414 1.414L10.586 12l-2.293 2.293a1 1 0 1 0 1.414 1.414L12 13.414l2.293 2.293a1 1 0 0 0 1.414-1.414L13.414 12l2.293-2.293a1 1 0 0 0-1.414-1.414L12 10.586 9.707 8.293Z"
                                clip-rule="evenodd" />
                        </svg>

                    </button>
                </span>
            </TransitionGroup>
        </div>

        <div class="flex items-center justify-center w-full" :data-active="active" @dragenter.prevent="setActive"
            @dragover.prevent="setActive" @dragleave.prevent="setInactive" @drop.prevent="handleDrop">
            <label for="dropzone-file" :class="{ 'animate-pulse': active }"
                class="transition ease-out duration-150 flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg :class="{ 'rotate-180': active }"
                        class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400 transition ease-out duration-150"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <div class="text-center" v-if="!active">
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">
                                {{ __('Click to upload') }}</span> {{ __('or drag and drop') }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                    <div class="text-center" v-else>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">
                            {{__('Drop here')}}
                        </span></p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                    </div>
                </div>
                <input id="dropzone-file" ref="photoInput" type="file" multiple accept="image/*" class="hidden"
                    @input="handleSelect" />
            </label>
        </div>

    </div>
</template>
