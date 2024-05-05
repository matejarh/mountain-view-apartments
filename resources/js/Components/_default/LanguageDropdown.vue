<script setup>
import { computed, onMounted, ref } from 'vue';
import LanguageDropdownItem from './LanguageDropdownItem.vue';
import Dropdown from '@/Components/Dropdown.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { useTranslationsStore } from '@/stores/translations';

defineProps({ language: String, direction: { type: String, default: 'up' } })

const page = usePage()

const store = useTranslationsStore()

const languages = ref([
    { name: 'English', code: 'en', flag_url: new URL('/resources/images/flags/1x1/gb.svg', import.meta.url) },
    { name: 'Slovensko', code: 'sl', flag_url: new URL('/resources/images/flags/1x1/si.svg', import.meta.url) },
    { name: 'Čeština', code: 'cs', flag_url: new URL('/resources/images/flags/1x1/cz.svg', import.meta.url) },
    { name: 'Deutsch', code: 'de', flag_url: new URL('/resources/images/flags/1x1/de.svg', import.meta.url) },
    { name: 'Italiano', code: 'it', flag_url: new URL('/resources/images/flags/1x1/it.svg', import.meta.url) },
    { name: 'Magyar', code: 'hu', flag_url: new URL('/resources/images/flags/1x1/hu.svg', import.meta.url) },
    { name: 'Français', code: 'fr', flag_url: new URL('/resources/images/flags/1x1/fr.svg', import.meta.url) },
])

const selectedLanguage = computed(() => {

    return languages.value.filter((language) => {
        return language.code === page.props.locale
    })[0]
})

const form = useForm({ language: '' })

const switchLanguage = (lang) => {
    form.language = lang

    form.post(route('switch.language'), {
        preserveState: true,
        // resetOnSuccess: false,
        onSuccess: () => {
            // selectLanguage(page.props.locale)

            store.updateTranslations(page.props.translations)

            localStorage.setItem('language', page.props.locale)
        }
    })
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
                    <LanguageDropdownItem v-for="language, key in languages" :key="language.code" :language="language"
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
