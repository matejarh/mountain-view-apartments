<script setup>
import BottomDropdown from './BottomDropdown.vue';
import BottomDropdownItem from './BottomDropdownItem.vue';
import FlagEnglishIcon from '@/Icons/FlagEnglishIcon.vue';
import FlagItalianIcon from '@/Icons/FlagItalianIcon.vue';
import FlagChineseIcon from '@/Icons/FlagChineseIcon.vue';
import FlagSlovenianIcon from '@/Icons/FlagSlovenianIcon.vue';
import FlagDeutschIcon from '@/Icons/FlagDeutschIcon.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { useTranslationsStore } from '@/stores/translations'
import { onMounted } from 'vue';

defineProps({ language: String })

const page = usePage()

const store = useTranslationsStore()

const languages = ref([
    { name: 'English (US)', code: 'us', flag_url: new URL('@/assets/flags/1x1/us.svg', import.meta.url) },
    { name: 'Slovensko', code: 'si', flag_url: new URL('@/assets/flags/1x1/si.svg', import.meta.url) },
    { name: 'Čeština', code: 'cs', flag_url: new URL('@/assets/flags/1x1/cz.svg', import.meta.url) },
    { name: 'Deutsch', code: 'de', flag_url: new URL('@/assets/flags/1x1/de.svg', import.meta.url) },
    { name: 'Italiano', code: 'it', flag_url: new URL('@/assets/flags/1x1/it.svg', import.meta.url) },
    { name: 'Magyar', code: 'hu', flag_url: new URL('@/assets/flags/1x1/hu.svg', import.meta.url) },
    { name: 'Français', code: 'fr', flag_url: new URL('@/assets/flags/1x1/fr.svg', import.meta.url) },
])

const form = useForm({ language: '' })

const switchLanguage = (lang) => {
    form.language = lang
    form.post(route('switch.language'), {
        preserveState: true,
        // resetOnSuccess: false,
        onSuccess: () => {
            store.updateTranslations(page.props.translations)
            console.log(store.translations)
        }
    })
}

onMounted(() => {
    console.log(store.translations)
    store.updateTranslations(page.props.translations)
})

</script>

<template>
    <BottomDropdown>
        <template #trigger>
            <FlagEnglishIcon class="h-5 w-5 rounded-full mt-0.5" v-if="$page.props.language === 'en'" />
            <FlagSlovenianIcon class="h-5 w-5 rounded-full mt-0.5" v-if="$page.props.language === 'sl'" />
            <FlagDeutschIcon class="h-5 w-5 rounded-full mt-0.5" v-if="$page.props.language === 'de'" />
            <FlagItalianIcon class="h-5 w-5 rounded-full mt-0.5" v-if="$page.props.language === 'it'" />
            <FlagChineseIcon class="h-5 w-5 rounded-full mt-0.5" v-if="$page.props.language === 'ch'" />

        </template>
        <BottomDropdownItem as="button" @click="switchLanguage('en')">
            <template #icon>
                <FlagEnglishIcon class="h-3.5 w-3.5 rounded-full mr-2" />
            </template>
            English (US)
        </BottomDropdownItem>
        <BottomDropdownItem as="button" @click="switchLanguage('sl')">
            <template #icon>
                <FlagSlovenianIcon class="h-3.5 w-3.5 rounded-full mr-2" />
            </template>
            Slovenski
        </BottomDropdownItem>
        <BottomDropdownItem as="button" @click="switchLanguage('de')">
            <template #icon>
                <FlagDeutschIcon class="h-3.5 w-3.5 rounded-full mr-2" />
            </template>
            Deutsch
        </BottomDropdownItem>
        <BottomDropdownItem as="button" @click="switchLanguage('it')">
            <template #icon>
                <FlagItalianIcon class="h-3.5 w-3.5 rounded-full mr-2" />
            </template>
            Italiano
        </BottomDropdownItem>
        <BottomDropdownItem as="button" @click="switchLanguage('ch')">
            <template #icon>
                <FlagChineseIcon class="h-3.5 w-3.5 rounded-full mr-2" />
            </template>
            中文 (繁體)
        </BottomDropdownItem>
    </BottomDropdown>
</template>
