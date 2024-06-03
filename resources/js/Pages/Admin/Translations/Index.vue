<template>
    <FullLayout :title="__('Manage Translations')">
        <ActionSection :fullwidth="false">
            <template #title>
                {{ __("Manage Translations") }}
            </template>
            <template #content>

                <FiltersSection id="translations-filters" route="admin.translations.index"
                        placeholder="Search for translations" :preserve-state="false"/>


                <div>
                    <Alert v-if="status" status="success">{{ status }}</Alert>

                    <form @submit.prevent="updateTranslations">
                        <TranslationItem v-for="(values, key) in keys_with_translation.data" :key="key" :keys-with-translations="keys_with_translation.data" />

                        <PrimaryButton class="sticky bottom-4 mt-4">
                            {{ __('Save Translations') }}
                        </PrimaryButton>
                    </form>
                </div>

            </template>

        </ActionSection>

    </FullLayout>
</template>

<script setup>
import ActionSection from '@/Components/ActionSection.vue';
import Alert from '@/Components/Alert.vue';
import FiltersSection from '@/Components/FiltersSection.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TranslationItem from '@/Components/Translations/TranslationItem.vue';
import FullLayout from '@/Layouts/FullLayout.vue';
import { router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';



const { keys_with_translation, supported_locales, status } = usePage().props;
const formTranslations = ref(keys_with_translation.data);

const updateTranslations = () => {
    router.post(route('admin.translations.update'), {
        translations: formTranslations.value,
    });
};


</script>

<style scoped>
.alert {
    margin-top: 20px;
}

.btn {
    margin-top: 20px;
}
</style>
