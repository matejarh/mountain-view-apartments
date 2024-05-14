<script setup>
import { computed, onMounted, ref } from 'vue';
import LanguageDropdownItem from './LanguageDropdownItem.vue';
import Dropdown from '@/Components/Dropdown.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { useTranslationsStore } from '@/stores/translations';

defineProps({ language: String, direction: { type: String, default: 'up' } })

const page = usePage()

const store = useTranslationsStore()

const selectedLanguage = computed(() => {

    return store.languages.find(language => language.code === page.props.locale);
})

const switchLanguage = (lang) => {
    localStorage.setItem('language', lang)
}

onMounted(() => {
    if (!localStorage.getItem('language') || localStorage.getItem('language') === 'undefined') {
        const lang = navigator.language.split('-')[0]
        switchLanguage(lang)
    } else {
        store.updateTranslations(page.props.translations)
    }
})

</script>

<template>
    <div class="">
        <Dropdown>
            <template #trigger>
                <span
                    class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm text-gray-900 dark:text-white rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">

                    <img :src="selectedLanguage?.flag_url" class="w-5 h-5 rounded-full me-3">
                    {{ selectedLanguage?.name }}
                </span>
            </template>
            <template #content>
                <ul class="py-2 font-medium" role="none">
                    <LanguageDropdownItem v-for="language, key in store.languages" :key="language.code" :language="language"
                        @click="switchLanguage(language.code)" />
                </ul>
            </template>
        </Dropdown>
        <!--         <button type="button" @click="show = !show" data-dropdown-toggle="language-dropdown-menu"
            class="inline-flex items-center font-medium justify-center px-4 py-2 text-sm text-gray-900 dark:text-white rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white">

            <img :src="selectedLanguage.flag_url" class="w-5 h-5 rounded-full me-3" aria-hidden="true">
            {{ selectedLanguage.name }}
        </button>

        <div v-show="show"
            class="z-50 my-4  text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700"
            id="language-dropdown-menu">
            <ul class="py-2 font-medium" role="none">
                <LanguageDropdownItem v-for="language, key in languages" :key="key" :language="language"
                    @click="selectedLanguage = language" @selected="handleSelected" />
            </ul>
        </div> -->
    </div>
</template>
