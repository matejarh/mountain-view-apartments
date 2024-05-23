<script setup>
import { computed, onMounted, ref } from 'vue';
import LanguageDropdownItem from './LanguageDropdownItem.vue';
import Dropdown from '@/Components/Dropdown.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { useTranslationsStore } from '@/stores/translations';

defineProps({ language: String, direction: { type: String, default: 'up' }, align: { type: String, default: 'right' }, noLabel: { type: Boolean, default: false } })

const page = usePage()

const store = useTranslationsStore()

const selectedLanguage = computed(() => {

    return store.languages.find(language => language.code === page.props?.locale);
})

const switchLanguage = (lang) => {
    localStorage.setItem('language', lang)
}

onMounted(() => {
    if (!localStorage.getItem('language') || localStorage.getItem('language') === 'undefined') {
        const lang = navigator.language.split('-')[0]
        switchLanguage(lang)
    } else {
        store.updateTranslations(page.props?.translations)
    }
})

</script>

<template>
    <div class="transition-opacity ease-out duration-150">
        <Dropdown :align="'left'">
            <template #trigger>
                <span
                    class="inline-flex items-center font-medium justify-center px-4 py-3 text-sm text-gray-900 dark:text-white rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white"
                    :class="{ 'hover:bg-transparent dark:hover:bg-transparent dark:hover:text-white': noLabel }">

                    <img :src="selectedLanguage?.flag_url" class="w-auto h-6 rounded-full me-3"
                        :class="{ 'me-0': noLabel }">
                    <span v-if="!noLabel">
                        {{ selectedLanguage?.name }}
                    </span>
                </span>
            </template>
            <template #content>
                <ul class="py-2 font-medium" role="none">
                    <LanguageDropdownItem v-for="language, key in store.languages" :key="language.code"
                        :language="language" @click="switchLanguage(language.code)" />
                </ul>
            </template>
        </Dropdown>
    </div>
</template>
