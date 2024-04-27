<script setup>
import BottomDropdown from './BottomDropdown.vue';
import BottomDropdownItem from './BottomDropdownItem.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { useTranslationsStore } from '@/stores/translations'
import { computed, onBeforeMount, onMounted, ref } from 'vue';
import Tooltip from '../Tooltip.vue';

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

onBeforeMount(() => {
    if (!localStorage.getItem('language') || localStorage.getItem('language') === 'undefined') {
        const lang = navigator.language.split('-')[0]
        switchLanguage(lang)
    } else {
        store.updateTranslations(page.props.translations)
    }
})

</script>

<template>
    <BottomDropdown :direction="direction" :tooltip-text="selectedLanguage?.name">
        <template #trigger>
            <img :src="selectedLanguage?.flag_url" class="h-5 w-5 rounded-full mt-0.5">
        </template>


        <BottomDropdownItem v-for="language in languages" :key="language.code" as="button"
            @click="switchLanguage(language.code)">
            <template #icon>
                <img :src="language.flag_url" class="h-3.5 w-3.5 rounded-full mr-2">
            </template>
            {{ language.name }}
        </BottomDropdownItem>
    </BottomDropdown>
</template>
