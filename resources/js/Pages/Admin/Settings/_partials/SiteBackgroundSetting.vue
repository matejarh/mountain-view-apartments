<script setup>
import ActionSection from '@/Components/ActionSection.vue';
import { computed, ref } from 'vue';
import CreateSetting from './CreateSetting.vue';
import { useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ImagesListDialog from './ImagesListDialog.vue';
import CheckCircleIcon from '@/Icons/CheckCircleIcon.vue';
import LightbulbIcon from '@/Icons/LightbulbIcon.vue';
import YearProgress from '@/Components/Settings/YearProgress.vue';

const props = defineProps({
    setting: Object,
})

const newSetting = ref({
    name: 'Site backgrounds',
    description: 'Backgrounds for site',
    attributes: {
        spring: null,
        summer: null,
        autumn: null,
        winter: null,
    }
})

const showSelectImageDialog = ref(false)

/* const background_settings = computed(() => {
    if (props.settings.length <= 0) return []

    return props.settings?.filter((setting) => {
        return setting.slug === 'site-backgrounds'
    })[0]
}) */

const form = useForm({
    name: props.setting?.name,
    description: props.setting?.description,
    attributes: props.setting?.attributes,
})

const update = () => {
    form.put(route('admin.settings.update', props.setting), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {

        }
    })
}
const selectedAttribute = ref(null)

const handleSelect = (attribute) => {
    selectedAttribute.value = attribute
    showSelectImageDialog.value = true
}
</script>

<template>
    <div class="sm:col-span-2 md:col-span-3 xl:col-span-4 2xl:col-span-full 4xl:col-span-full">

        <ActionSection>
            <template #title>{{ __('Site Backgrounds') }}</template>
            <template #content>

                <CreateSetting v-if="setting?.length <= 0" :setting="newSetting" />

                <div v-else class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                    <YearProgress />
                    <div class="" v-for="attribute, key in setting.attributes">
                        <div class="flex justify-between items-center">
                            <h3>{{__('image')}} {{__('for')}} {{ __(key) }}</h3>
                            <div class="relative" v-if="key === $page.props?.current_season">
                                <LightbulbIcon class="absolute animate-ping h-6 w-6 text-yellow-400" />
                                <LightbulbIcon class="h-6 w-6 text-yellow-300" />

                            </div>
                        </div>
                        <div :class="{ 'rounded-lg shadow-2xl shadow-amazon-300': key === $page.props?.current_season }"
                            class="" v-if="attribute">
                            <img :src="attribute.thumb_url" class="w-full h-auto rounded-lg" />

                        </div>
                        <div class="mt-2">

                            <PrimaryButton class="w-full" type="button" @click="handleSelect(key)">
                                <template v-if="!attribute"> {{__(`select ${key} image`)}} </template>
                                <template v-else> {{__(`change ${key} image`)}} </template>
                            </PrimaryButton>

                        </div>

                    </div>
                </div>
            </template>
        </ActionSection>
    </div>
    <ImagesListDialog :show="showSelectImageDialog" @close="showSelectImageDialog = false"
        :setting="setting" :attribute="selectedAttribute" />
</template>
