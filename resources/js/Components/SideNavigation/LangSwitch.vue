<script setup>
import BottomDropdown from './BottomDropdown.vue';
import BottomDropdownItem from './BottomDropdownItem.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { useTranslationsStore } from '@/stores/translations'
import { onMounted, ref } from 'vue';

defineProps({ language: String, direction: {type:String, default: 'up'} })

const page = usePage()

const store = useTranslationsStore()

const languages = ref([
    { name: 'English (US)', code: 'us', flag_url: new URL('/resources/images/flags/1x1/us.svg', import.meta.url) },
    { name: 'Slovensko', code: 'sl', flag_url: new URL('/resources/images/flags/1x1/si.svg', import.meta.url) },
    { name: 'Čeština', code: 'cs', flag_url: new URL('/resources/images/flags/1x1/cz.svg', import.meta.url) },
    { name: 'Deutsch', code: 'de', flag_url: new URL('/resources/images/flags/1x1/de.svg', import.meta.url) },
    { name: 'Italiano', code: 'it', flag_url: new URL('/resources/images/flags/1x1/it.svg', import.meta.url) },
    { name: 'Magyar', code: 'hu', flag_url: new URL('/resources/images/flags/1x1/hu.svg', import.meta.url) },
    { name: 'Français', code: 'fr', flag_url: new URL('/resources/images/flags/1x1/fr.svg', import.meta.url) },
])

const selectedLanguage = ref({
    name: 'English (US)', code: 'us', flag_url: new URL('/resources/images/flags/1x1/us.svg', import.meta.url)
})

const form = useForm({ language: '' })

const switchLanguage = (lang) => {
    form.language = lang.code
    form.post(route('switch.language'), {
        preserveState: true,
        // resetOnSuccess: false,
        onSuccess: () => {
            store.updateTranslations(page.props.translations)
            selectedLanguage.value = lang
        }
    })
}

onMounted(() => {
    store.updateTranslations(page.props.translations)
    selectedLanguage.value = languages.value.filter((language) => {
        return language.code === page.props.language
    })[0]
})

</script>

<template>
    <BottomDropdown :direction="direction">
        <template #trigger>
            <img :src="selectedLanguage.flag_url" class="h-5 w-5 rounded-full mt-0.5" >
        </template>

        <BottomDropdownItem v-for="language in languages" :key="language.code" as="button" @click="switchLanguage(language)">
            <template #icon>
                <img :src="language.flag_url" class="h-3.5 w-3.5 rounded-full mr-2" >
            </template>
            {{ language.name }}
        </BottomDropdownItem>
    </BottomDropdown>
</template>
