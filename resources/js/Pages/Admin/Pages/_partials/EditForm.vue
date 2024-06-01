<script setup>
import HorizontalTabs from '@/Components/HorizontalTabs.vue';
import HorizontalTabItem from '@/Components/HorizontalTabItem.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { onBeforeUnmount, onMounted, ref } from 'vue';
import { useTranslationsStore } from '@/stores/translations';
import GridSection from '@/Components/GridSection.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import TextArea from '@/Components/TextArea.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInputHelper from '@/Components/TextInputHelper.vue';
import NewExtraDialog from './NewExtraDialog.vue';
import TipTapInput from '@/Components/TipTapInput.vue';
import { icons } from '@/icons';

const translations = useTranslationsStore()

const page = usePage()

const emit = defineEmits(['success'])

const form = useForm({
    name: page.props?.page ? page.props?.page?.name : '',
    title: page.props?.page ? page.props?.page?.title : {},
    description: page.props?.page ? page.props?.page?.description : {},
    keywords: page.props?.page ? page.props?.page?.keywords : {},
    extras: page.props?.page ? page.props?.page?.extras : {},
})

const selectedTab = ref(page.props?.locale)

const showNewExtraDialog = ref(false)

const update = () => {
    form.clearErrors()
    form.put(route('admin.pages.update', page.props?.page), {
        errorBag: 'updatingPage'
    })
}

const store = () => {
    form.clearErrors()
    form.post(route('admin.pages.store'), {
        errorBag: 'creatingPage',
        onSuccess: () => {
            emit('success')
        }
    })
}

const handleSubmit = () => {
    page.props?.page ? update() : store();
}

const handleCreateExtra = (extra) => {
    let key = Object.keys(extra)[0]
    form.extras[key] = extra[key]
}

const saveOnCtrlS = (e) => {
    const isCtrlS = e.ctrlKey && e.key === 's';
    const canSave = form.isDirty && !form.processing && !form.recentlySuccessful;

    if (isCtrlS && canSave) {
        e.preventDefault();
        page.props?.page ? update() : store();
    }
};

onMounted(() => document.addEventListener('keydown', saveOnCtrlS));

onBeforeUnmount(() => {
    document.removeEventListener('keydown', saveOnCtrlS);
});
</script>

<template>
    <div class="">
        <GridSection>
            <div class="col-span-full">
                <InputLabel for="title" :value="__('Name')" />
                <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required
                    autocomplete="name" :has-error="!!form.errors.name" :placeholder="__('Enter name') + '...'" />
                <InputError :message="form.errors.name" class="mt-2" />
                <TextInputHelper>
                    {{ __('Used for identification. No need for translations.') }}
                </TextInputHelper>
            </div>
        </GridSection>

        <HorizontalTabs class="mt-4">
            <template #header>
                <HorizontalTabItem @click="selectedTab = language.code" v-for="language in translations.languages"
                    :key="language.code" :active="selectedTab === language.code">
                    <img :src="language.flag_url"
                        class="w-4 h-4 sm:me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" />
                    <span class="hidden sm:block">
                        {{ language.name }}
                    </span>
                </HorizontalTabItem>
            </template>
        </HorizontalTabs>

        <GridSection>
            <div class="col-span-full mt-4">
                <InputLabel :for="`title-${selectedTab}`" :value="__('Title')" />
                <TextInput :id="`title-${selectedTab}`" v-model="form.title[selectedTab]" type="text"
                    class="mt-1 block w-full" required autocomplete="title"
                    :has-error="!!form.errors[`title.${selectedTab}`]" :placeholder="__('Enter title') + '...'" />
                <InputError :message="form.errors[`title.${selectedTab}`]" class="mt-2" />
            </div>

            <div class="col-span-full">
                <InputLabel :for="`description-${selectedTab}`" :value="__('Description')" />
                <TextArea :id="`description-${selectedTab}`" v-model="form.description[selectedTab]"
                    class="mt-1 block w-full" autocomplete="description"
                    :has-error="!!form.errors[`description.${selectedTab}`]"
                    :placeholder="__('Enter description') + '...'"></TextArea>
                <InputError :message="form.errors[`description.${selectedTab}`]" class="mt-2" />
            </div>

            <div class="col-span-full">
                <InputLabel :for="`keywords-${selectedTab}`" :value="__('Keywords')" />
                <TextArea :id="`keywords-${selectedTab}`" v-model="form.keywords[selectedTab]" class="mt-1 block w-full"
                    autocomplete="keywords" :has-error="!!form.errors[`keywords.${selectedTab}`]"
                    :placeholder="__('Enter keywords') + '...'"></TextArea>
                <InputError :message="form.errors[`keywords.${selectedTab}`]" class="mt-2" />
            </div>

            <hr class="my-4 md:my-4 border-gray-200 dark:border-gray-800 col-span-full" />

            <div class="flex justify-between col-span-full w-full">
                <h4 class="text-2xl font-bold dark:text-white">{{ __('Extras') }}</h4>
                <button @click="showNewExtraDialog = true" class="text-amazon-500 dark:text-amazon-600">
                    <icons.CirclePlusIcon />
                </button>
            </div>

            <!--  {{ form.extras }} -->
            <div class="col-span-full" v-for="extra, key in form.extras" :key="key">
                <div class="flex justify-between">
                    <h5 class="capitalize font-semibold text-lg">
                        {{ key.replace('_', ' ') }}
                    </h5>
                    <button class="text-bittersweet-600 dark:text-bittersweet-700" @click="delete form.extras[key]">
                        <icons.TrashBinIcon />
                    </button>
                </div>

                <div class="col-span-full">
                    <TextInput :id="`title-${key}-${selectedTab}`" v-model="form.extras[key].title[selectedTab]"
                        class="mt-1 block w-full" autocomplete="title"
                        :has-error="!!form.errors[`errors.${key}.title.${selectedTab}`]"
                        :placeholder="__('Enter title') + '...'"></TextInput>
                    <InputError :message="form.errors[`errors.${key}.title.${selectedTab}`]" class="mt-2" />
                </div>

                <div class="mt-4">
                    <TipTapInput v-model="form.extras[key].text[selectedTab]"
                        :has-error="!!form.errors[`extras.${key}.text.${selectedTab}`]" />

                    <InputError :message="form.errors[`extras.${key}.text.${selectedTab}`]" class="mt-2" />
                </div>
            </div>
        </GridSection>

        <div class="col-span-full mt-4">
            <PrimaryButton type="button"
                :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
                :disabled="form.processing || form.recentlySuccessful || !form.isDirty" @click="handleSubmit">
                <div class="flex items-center">
                    <icons.SpinnerIcon v-show="form.processing"
                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                    {{ form.processing ? __('Saving') + '...' : form.recentlySuccessful ? __('Saved') : __('Save') }}

                </div>
            </PrimaryButton>
        </div>

        <NewExtraDialog :show="showNewExtraDialog" @close="showNewExtraDialog = false" @create="handleCreateExtra" />
    </div>
</template>
