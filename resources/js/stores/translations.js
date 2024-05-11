import { usePage } from '@inertiajs/vue3'
import { defineStore } from 'pinia'
import { ref } from 'vue'


export const useTranslationsStore = defineStore('translations', () => {
    const translations = ref([])

    const languages = ref([
        { name: 'English', code: 'en', flag_url: new URL('/resources/images/flags/1x1/gb.svg', import.meta.url) },
        { name: 'Slovensko', code: 'sl', flag_url: new URL('/resources/images/flags/1x1/si.svg', import.meta.url) },
        { name: 'Čeština', code: 'cs', flag_url: new URL('/resources/images/flags/1x1/cz.svg', import.meta.url) },
        { name: 'Deutsch', code: 'de', flag_url: new URL('/resources/images/flags/1x1/de.svg', import.meta.url) },
        { name: 'Italiano', code: 'it', flag_url: new URL('/resources/images/flags/1x1/it.svg', import.meta.url) },
        { name: 'Magyar', code: 'hu', flag_url: new URL('/resources/images/flags/1x1/hu.svg', import.meta.url) },
        { name: 'Français', code: 'fr', flag_url: new URL('/resources/images/flags/1x1/fr.svg', import.meta.url) },
    ])

    const updateTranslations = (newTranslations) => {
        translations.value = newTranslations
    }


    return { translations, updateTranslations, languages }
})
