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

const selectedLanguage = computed(() => {

    return store.languages.filter((language) => {
        return language.code === page.props?.locale
    })[0]
})

const form = useForm({ language: '' })

const switchLanguage = (lang) => {
    form.language = lang

    form.post(route('switch.language'), {
        preserveState: true,
        // resetOnSuccess: false,
        onSuccess: () => {
            // selectLanguage(page.props?.locale)

            store.updateTranslations(page.props?.translations)

            localStorage.setItem('language', page.props?.locale)
        }
    })
}

onBeforeMount(() => {
    if (!localStorage.getItem('language') || localStorage.getItem('language') === 'undefined') {
        const lang = navigator.language.split('-')[0]
        switchLanguage(lang)
    } else {
        store.updateTranslations(page.props?.translations)
    }
})

</script>

<template>
    <BottomDropdown :direction="direction" :tooltip-text="selectedLanguage?.name">
        <template #trigger>
            <img :src="selectedLanguage?.flag_url" class="h-5 w-5 rounded-full mt-0.5">
        </template>

        <BottomDropdownItem v-for="language in store.languages" :key="language.code" as="button"
            @click="switchLanguage(language.code)">
            <template #icon>
                <img :src="language.flag_url" class="h-3.5 w-3.5 rounded-full mr-2">
            </template>
            {{ language.name }}
        </BottomDropdownItem>
    </BottomDropdown>
</template>
