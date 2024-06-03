<script setup>
import { getCurrentInstance, ref } from 'vue';
import TextInput from '../TextInput.vue';
import { useTranslationsStore } from '@/stores/translations';
import { icons } from '@/icons';

defineProps({
    keysWithTranslations: Object,
})
const instance = getCurrentInstance();

const show = ref(false)

const store = useTranslationsStore()

</script>

<template>
    <div class="border border-gray-100 dark:border-gray-700 rounded-lg p-4 mt-4 shadow-lg">
        <div class="flex justify-between items-center cursor-pointer" @click.prevent="show = !show">
            <h5 class="font-semibold text-md">{{ instance.vnode.key }}</h5>
            <icons.ArrowDownIcon class="w-5 h-5 transition-transform ease-out duration-150"
                :class="{ 'rotate-180': show }" />
        </div>

        <Transition enter-active-class="transition ease-out duration-200"
            enter-from-class="transform opacity-0 scale-y-0 origin-top"
            enter-to-class="transform opacity-100 scale-y-100 origin-top"
            leave-active-class="transition ease-in duration-75"
            leave-from-class="transform opacity-100 scale-y-100 origin-top"
            leave-to-class="transform opacity-0 scale-y-0  origin-top" >
            <div class="" v-show="show">
                <div v-for="locale in store.languages" :key="locale" class="mt-2">
                    <div class="font-semibold text-sm">
                        {{ locale.name }}
                    </div>
                    <div class="flex mt-1">
                        <img :src="locale.flag_url" :alt="locale.name + ' flag'" class="w-auto h-10 rounded-l-lg" />

                        <TextInput v-model="keysWithTranslations[instance.vnode.key][locale.code]"
                            rounded="rounded-r-lg" class="w-full" />
                    </div>
                </div>

            </div>
        </Transition>
    </div>
</template>

<style>
/* Define the slide-down transition */
.slide-down-enter-active, .slide-down-leave-active {
  transition: all 0.5s;
}
.slide-down-enter, .slide-down-leave-to {
  opacity: 0;
  transform: scaleY(100%);
}
</style>
