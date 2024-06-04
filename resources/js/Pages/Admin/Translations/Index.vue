<template>
    <FullLayout :title="__('Manage Translations')">
        <ActionSection :fullwidth="false">
            <template #title>
                {{ __("Manage Translations") }}
            </template>
            <template #content>

                <FiltersSection id="translations-filters" route="admin.translations.index"
                    placeholder="Search for translations" :preserve-state="false" />


                <div>
                    <Alert v-if="status" status="success">{{ status }}</Alert>

                    <form @submit.prevent="updateTranslations">
                        <TranslationItem v-for="(values, key) in keys_with_translation.data" :key="key"
                            :keys-with-translations="keys_with_translation.data" />

                        <Paginator :paginator="keys_with_translation" />
                        <div class="space-x-2 mt-4 sticky bottom-0 pb-4 pt-4 z-10 bg-white dark:bg-gray-900">

                            <PrimaryButton :disabled="form.processing || form.recentlySuccessful"
                                :class="{ 'opacity-25': form.processing || form.recentlySuccessful }">

                                <div class="flex items-center">
                                    <icons.SpinnerIcon v-if="form.processing"
                                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                                    <icons.FloppyDiscIcon v-else class="-ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                                    {{ form.processing ? __('Saving') + '...' : form.recentlySuccessful ?
                                        __('Translations Saved')
                                        : __('Save Translations')
                                    }}

                                </div>
                            </PrimaryButton>


                            <!-- <PrimaryButton type="button"
                                :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
                                :disabled="form.processing || form.recentlySuccessful || !form.isDirty"
                                @click="form.reset()">
                                <div class="flex items-center">
                                    <icons.UndoIcon class="-ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                                    {{ __('Undo Changes') }}

                                </div>
                            </PrimaryButton> -->
                        </div>
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
import Paginator from '@/Components/Paginator.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TranslationItem from '@/Components/Translations/TranslationItem.vue';
import FullLayout from '@/Layouts/FullLayout.vue';
import { icons } from '@/icons';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const { keys_with_translation, supported_locales, status } = usePage().props;
const formTranslations = ref(keys_with_translation.data);

const form = useForm({ translations: keys_with_translation.data })

const updateTranslations = () => {
    form.translations = formTranslations.value

    form.put(route('admin.translations.update'), {
        preserveState: true,
        preserveScroll: true,
    })
    /* router.put(route('admin.translations.update'), {
        translations: formTranslations.value,
    }, {
        preserveState: true,
        preserveScroll: true,
    }); */
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
