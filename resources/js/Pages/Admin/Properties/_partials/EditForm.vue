<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextArea from '@/Components/TextArea.vue';
import TextInput from '@/Components/TextInput.vue';
import SpinnerIcon from '@/Icons/SpinnerIcon.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import SelectInput from '@/Components/SelectInput.vue';
import TrashBinIcon from '@/Icons/TrashBinIcon.vue';
import { onBeforeUnmount, onMounted, reactive, ref } from 'vue';
import CirclePlusIcon from '@/Icons/CirclePlusIcon.vue';
import HorizontalTabs from '@/Components/HorizontalTabs.vue';
import HorizontalTabItem from '@/Components/HorizontalTabItem.vue';
import { useTranslationsStore } from '@/stores/translations';
import GridSection from '@/Components/GridSection.vue';
import TipTapInput from '@/Components/TipTapInput.vue';

const page = usePage()

const store = useTranslationsStore()

const form = useForm({
    type: page.props.property?.type,
    name: page.props.property?.name,
    title: page.props.property?.title,
    quote: page.props.property?.quote,
    description: page.props.property?.description,
    long_description: page.props.property?.long_description,
    address: page.props.property?.address,
    keywords: page.props.property?.keywords,
    size: page.props.property?.size,
    is_entire_apartment: page.props.property?.is_entire_apartment,
    coordinates: page.props.property?.coordinates,
    bed_types: page.props.property?.bed_types,
    recomended: page.props.property?.recomended,
    prices: page.props.property?.prices,
    rules: page.props.property?.rules,
})

const selectedTab = ref(page.props.locale)

const newBedType = useForm({
    name: '',
    title: '',
    icon: 'none',
})
const newPrice = useForm({
    guests: '',
    price: '',
})
const newRule = useForm({
    name: '',
    title: '',
    description: '',
    icon: 'none',
})

const newRecomended = reactive({
    title: '',
})

const update = () => {
    form.clearErrors()
    form.put(route('admin.properties.update', page.props.property), {
        preserveScroll: true,
        preserveState: true,
        errorBag: 'updatingProperty',
        onSuccess: () => {

        }
    })
}

const handleRemoveBedType = (item) => {
    const index = form.bed_types.indexOf(item)
    if (index > -1) {
        form.bed_types.splice(index, 1);
    }
}
const handleRemoveRecomended = (item) => {
    const index = form.recomended.indexOf(item)
    if (index > -1) {
        form.recomended.splice(index, 1);
    }
}
const handleRemovePrice = (item) => {
    const index = form.prices.indexOf(item)
    if (index > -1) {
        form.prices.splice(index, 1);
    }
}
const handleRemoveRule = (item) => {
    const index = form.rules[selectedTab.value].indexOf(item)
    if (index > -1) {
        form.rules[selectedTab.value].splice(index, 1);
    }
}

const handleAddBadType = () => {
    if (newBedType.name !== '' && newBedType.title !== '' && newBedType.icon !== 'none') {
        let item = {
            name: newBedType.name,
            title: newBedType.title,
            icon: newBedType.icon,
        }
        form.bed_types.push(item)
        newBedType.reset()
    }
}
const handleAddPrice = () => {
    if (newPrice.guests !== '' && newPrice.price !== '') {
        let item = {
            guests: newPrice.guests,
            price: newPrice.price,

        }
        form.prices.push(item)
        newPrice.reset()
    }
}
const handleAddRule = () => {
    if (newRule.name !== '' && newRule.description !== '' && newRule.icon !== 'none') {
        let item = {
            name: newRule.name,
            title: newRule.title,
            description: newRule.description,
            icon: newRule.icon,

        }
        form.rules[selectedTab.value].push(item)
        newRule.reset()
    }
}

const handleAddRecomended = () => {
    if (newRecomended.title !== '') {
        form.recomended.push(newRecomended.title)

        newRecomended.title = ''
    }
}

const saveOnCtrlS = (e) => {
    const isCtrlS = e.ctrlKey && e.key === 's';
    const canSave = form.isDirty && !form.processing && !form.recentlySuccessful;

    if (isCtrlS && canSave) {
        e.preventDefault();
        update();
    }
};

onMounted(() => document.addEventListener('keydown', saveOnCtrlS));
onBeforeUnmount(() => document.removeEventListener('keydown', saveOnCtrlS));
</script>

<template>
    <div class="">
        <GridSection>
            <div class="col-span-full">
                <InputLabel :value="__('Type')" for="type" />
                <TextInput id="type" v-model="form.type" type="text" class="mt-1 block w-full" required
                    autocomplete="type" :has-error="!!form.errors.type" :placeholder="__('Enter type') + '...'" />
                <InputError :message="form.errors.type" class="mt-2" />
            </div>
            <div class="col-span-full">
                <InputLabel for="name" :value="__('Name')" />
                <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" required
                    autocomplete="name" :has-error="!!form.errors.name" :placeholder="__('Enter name') + '...'" />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>
            <div class="col-span-full">
                <InputLabel for="address" :value="__('Address')" />
                <TextInput id="address" v-model="form.address" type="text" class="mt-1 block w-full" required
                    autocomplete="address" :has-error="!!form.errors.address"
                    :placeholder="__('Enter address') + '...'" />
                <InputError :message="form.errors.address" class="mt-2" />
            </div>

        </GridSection>
        <HorizontalTabs class="mt-4">
            <template #header>
                <HorizontalTabItem @click="selectedTab = language.code" v-for="language in store.languages"
                    :key="language.code" :active="selectedTab === language.code">
                    <img :src="language.flag_url"
                        class="w-4 h-4 me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" />
                    {{ language.name }}
                </HorizontalTabItem>
            </template>
        </HorizontalTabs>
        <GridSection class="mt-4">
            <div class="col-span-full xl:col-span-full">
                <InputLabel for="title" :value="__('Title')" />
                <TextInput id="title" v-model="form.title[selectedTab]" type="text" class="mt-1 block w-full" required
                    autocomplete="title" :has-error="!!form.errors.title" :placeholder="__('Enter title') + '...'" />
                <InputError :message="form.errors.title" class="mt-2" />
            </div>

            <div class="col-span-full">
                <InputLabel for="quote" :value="__('Quote')" />
                <TextInput id="quote" v-model="form.quote[selectedTab]" type="text" class="mt-1 block w-full"
                    autocomplete="quote" :has-error="!!form.errors[`quote.${selectedTab}`]"
                    :placeholder="__('Enter quote') + '...'" />
                <InputError :message="form.errors[`quote.${selectedTab}`]" class="mt-2" />
            </div>

            <div class="col-span-full">
                <InputLabel for="description" :value="__('Description')" />
                <TipTapInput v-model="form.description[selectedTab]"
                    :has-error="!!form.errors[`description.${selectedTab}`]" />
                <InputError :message="form.errors[`description.${selectedTab}`]" class="mt-2" />
            </div>

            <div class="col-span-full">
                <InputLabel for="long_description" :value="__('Long description')" />
                <TipTapInput v-model="form.long_description[selectedTab]"
                    :has-error="!!form.errors[`long_description.${selectedTab}`]" />
                <InputError :message="form.errors[`long_description.${selectedTab}`]" class="mt-2" />
            </div>

            <div class="col-span-full">
                <InputLabel for="keywords" :value="__('Keywords')" />
                <TextArea id="keywords" v-model="form.keywords[selectedTab]" class="mt-1 block w-full"
                    autocomplete="keywords" :has-error="!!form.errors[`keywords.${selectedTab}`]"
                    :placeholder="__('Enter keywords') + '...'"></TextArea>
                <InputError :message="form.errors[`keywords.${selectedTab}`]" class="mt-2" />
            </div>
        </GridSection>

        <GridSection class="mt-4">
            <div class="col-span-3 ">
                <InputLabel for="size" :value="`${__('Size in')} m²`" />
                <TextInput id="size" v-model="form.size" type="text" class="mt-1 block w-full" required
                    autocomplete="size" :has-error="!!form.errors.size" :placeholder="__('Enter size') + '...'" />
                <InputError :message="form.errors.size" class="mt-2" />
            </div>

            <div class="col-span-3 relative">
                <InputLabel class="inline-flex items-center justify-center  cursor-pointer w-full">
                    {{ __('Is entire apartment') }}
                    <input type="checkbox" value="" class="sr-only peer" id="is_entire_apartment"
                        v-model.checked="form.is_entire_apartment" :checked="form.is_entire_apartment">
                    <div
                        class="mx-auto mt-3 relative w-14 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-amazon-600 dark:peer-focus:ring-amazon-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all dark:border-gray-600 peer-checked:bg-amazon-600">
                    </div>
                </InputLabel>
            </div>

            <div class="col-span-3 xl:col-span-3">
                <InputLabel for="coordinates_lat" :value="`${__('Latitude')}`" />
                <TextInput id="coordinates_lat" v-model="form.coordinates['lat']" type="text" class="mt-1 block w-full"
                    required autocomplete="coordinates_lat" :has-error="!!form.errors['coordinates.lat']"
                    :placeholder="__('Enter latitude') + '...'" />
                <InputError :message="form.errors['coordinates.lat']" class="mt-2" />
            </div>

            <div class="col-span-3 xl:col-span-3">
                <InputLabel for="coordinates_lng" :value="`${__('Longitude')}`" />
                <TextInput id="coordinates_lng" v-model="form.coordinates['lng']" type="text" class="mt-1 block w-full"
                    required autocomplete="coordinates_lng" :has-error="!!form.errors['coordinates.lng']"
                    :placeholder="__('Enter longitude') + '...'" />
                <InputError :message="form.errors['coordinates.lng']" class="mt-2" />
            </div>
        </GridSection>

        <hr class="my-4 md:my-4 border-gray-200 dark:border-gray-800 col-span-full" />

        <h4 class="text-xl mt-4 font-bold dark:text-white">{{ __('Bed Types') }}</h4>

        <div class="col-span-full">
            <div class="flex items-center">
                <p class="w-full">{{ __('Room') }}</p>
                <p class="w-full">{{ __('Type') }}</p>
                <p class="w-full">{{ __('Icon') }}</p>
            </div>
            <div class="flex items-center space-x-2" v-for="type, key in form.bed_types">
                <!-- <BedTypeIcon :icon="type.icon" /> -->

                <div class="w-full">

                    <TextInput :id="`bed_type_${key}_title`" v-model="form.bed_types[key].title" type="text"
                        class="mt-1 block w-full" required :has-error="!!form.errors['bed_types.' + key + '.title']"
                        :placeholder="__('Enter title') + '...'" />
                    <InputError :message="form.errors['bed_types.' + key + '.title']" class="mt-2" />
                </div>
                <div class="w-full">

                    <TextInput :id="`bed_type_${key}_name`" v-model="form.bed_types[key].name" type="text"
                        class="mt-1 block w-full" required :has-error="!!form.errors['bed_types.' + key + '.name']"
                        :placeholder="__('Enter name') + '...'" />
                    <InputError :message="form.errors['bed_types.' + key + '.name']" class="mt-2" />
                </div>
                <div class="w-full">

                    <SelectInput v-model="form.bed_types[key].icon" :id="`bed_type_${key}_icon`">
                        <option disabled value="">- {{ __('select icon') }} -</option>
                        <option v-for="icon, key in $page.props.icon_list" :key="key" :value="icon.name">{{
                            __(icon.label) }}
                        </option>
                    </SelectInput>
                </div>
                <div class="">
                    <button @click="handleRemoveBedType(type)">
                        <TrashBinIcon class="text-bittersweet-700 dark:text-bittersweet-500" />
                    </button>
                </div>

            </div>
            <h4 class="text-base font-bold dark:text-white mt-2">{{ __('Add New') }}</h4>

            <div class="flex items-center space-x-2">
                <!-- <BedTypeIcon :icon="type.icon" /> -->
                <div class="w-full">

                    <TextInput :id="`bed_type_new_title`" v-model="newBedType.title" type="text"
                        class="mt-1 block w-full" required :placeholder="__('Enter title') + '...'" />
                </div>
                <div class="w-full">

                    <TextInput :id="`bed_type_new_name`" v-model="newBedType.name" type="text" class="mt-1 block w-full"
                        required :placeholder="__('Enter name') + '...'" />
                </div>
                <div class="w-full">

                    <SelectInput v-model="newBedType.icon" id="bed_type_new_icon">
                        <option disabled value="none">- {{ __('select icon') }} -</option>
                        <option v-for="icon, key in $page.props.icon_list" :key="key" :value="icon.name">{{
                            __(icon.label) }}
                        </option>
                    </SelectInput>
                </div>
                <div class="">
                    <button @click="handleAddBadType">
                        <CirclePlusIcon class="text-amazon-600 dark:text-amazon-400" />
                    </button>
                </div>
            </div>
        </div>
        <hr class="my-4 md:my-4 border-gray-200 dark:border-gray-800 col-span-full" />

        <h4 class="text-xl mt-4 font-bold dark:text-white">{{ __('Recommended') }}</h4>

        <div class="col-span-full">
            <div class="flex items-center space-x-2" v-for="recomended, key in form.recomended">
                <!-- <BedTypeIcon :icon="type.icon" /> -->
                <div class="w-full">
                    <!-- <InputLabel :for="`bed_type_${key}_title`" :value="__('Title')" /> -->
                    <TextInput :id="`recomended_${key}_title`" v-model="form.recomended[key]" type="text"
                        class="mt-1 block w-full" required :autocomplete="`recomended_${key}_title`"
                        :has-error="!!form.errors['recomended.' + key]" :placeholder="__('Enter Recomended') + '...'" />
                </div>
                <div class="">
                    <button @click="handleRemoveRecomended(recomended)">
                        <TrashBinIcon class="text-bittersweet-700 dark:text-bittersweet-500" />
                    </button>
                </div>

            </div>
            <h4 class="text-base font-bold dark:text-white mt-2">{{ __('Add New') }}</h4>
            <div class="flex items-center space-x-2">
                <!-- <BedTypeIcon :icon="type.icon" /> -->
                <div class="w-full">
                    <!-- <InputLabel :for="`bed_type_${key}_title`" :value="__('Title')" /> -->
                    <TextInput :id="`recomended_new_title`" v-model="newRecomended.title" type="text"
                        class="mt-1 block w-full" required :autocomplete="`recomended_new_title`"
                        :placeholder="__('Enter recomended') + '...'" />
                </div>
                <div class="">
                    <button @click="handleAddRecomended">
                        <CirclePlusIcon class="text-amazon-600 dark:text-amazon-400" />
                    </button>
                </div>

            </div>
        </div>

        <h4 class="text-xl mt-4 font-bold dark:text-white">{{ __('Prices') }}</h4>

        <div class="col-span-full">
            <div class="flex items-center">
                <p class="w-full">{{ __('Number of guests') }}</p>
                <p class="w-full">{{ __('Price in €') }}</p>
            </div>
            <div class="flex items-center space-x-2" v-for="price, key in form.prices">
                <!-- <BedTypeIcon :icon="type.icon" /> -->

                <div class="w-full">

                    <TextInput :id="`price_${key}_guests`" v-model="form.prices[key].guests" type="text"
                        class="mt-1 block w-full" required :has-error="!!form.errors['prices.' + key + '.guests']"
                        :placeholder="__('Enter number of guests') + '...'" />
                    <InputError :message="form.errors['prices.' + key + '.guests']" class="mt-2" />
                </div>
                <div class="w-full">

                    <TextInput :id="`price_${key}_price`" v-model="form.prices[key].price" type="text"
                        class="mt-1 block w-full" required :has-error="!!form.errors['prices.' + key + '.price']"
                        :placeholder="__('Enter price') + '...'" />
                    <InputError :message="form.errors['prices.' + key + '.price']" class="mt-2" />
                </div>

                <div class="">
                    <button @click="handleRemovePrice(price)">
                        <TrashBinIcon class="text-bittersweet-700 dark:text-bittersweet-500" />
                    </button>
                </div>

            </div>
            <h4 class="text-base font-bold dark:text-white mt-2">{{ __('Add New') }}</h4>

            <div class="flex items-center space-x-2">
                <!-- <BedTypeIcon :icon="type.icon" /> -->
                <div class="w-full">

                    <TextInput :id="`new_guests`" v-model="newPrice.guests" type="text" class="mt-1 block w-full"
                        required :placeholder="__('Enter number of guests') + '...'" />
                </div>
                <div class="w-full">

                    <TextInput :id="`new_price`" v-model="newPrice.price" type="text" class="mt-1 block w-full" required
                        :placeholder="__('Enter price') + '...'" />
                </div>

                <div class="">
                    <button @click="handleAddPrice">
                        <CirclePlusIcon class="text-amazon-600 dark:text-amazon-400" />
                    </button>
                </div>
            </div>
        </div>

        <HorizontalTabs class="mt-4">
            <template #header>
                <HorizontalTabItem @click="selectedTab = language.code" v-for="language in store.languages"
                    :key="language.code" :active="selectedTab === language.code">
                    <img :src="language.flag_url"
                        class="w-4 h-4 me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" />
                    {{ language.name }}
                </HorizontalTabItem>
            </template>
        </HorizontalTabs>

        <h4 class="text-xl mt-4 font-bold dark:text-white">{{ __('Rules') }}</h4>

        <GridSection>
            <div class="col-span-full">
                <div class="flex items-center">
                    <p class="w-full">{{ __('Name') }}</p>
                    <p class="w-full">{{ __('Title') }}</p>

                    <p class="w-full">{{ __('Icon') }}</p>
                </div>

                <div class="flex items-center space-x-2 mb-4" v-for="rule, key in form.rules[selectedTab]">
                    <div class="w-full">
                        <div class="flex items-center space-x-2">
                            <div class="w-full">

                                <TextInput :id="`rule_${key}_name`" v-model="form.rules[selectedTab][key].name"
                                    type="text" class="mt-1 block w-full" required
                                    :has-error="!!form.errors['rules.' + selectedTab + '.' + key + '.name']"
                                    :placeholder="__('Enter number of name') + '...'" />
                                <InputError :message="form.errors['rules.' + selectedTab + '.' + key + '.name']"
                                    class="mt-2" />
                            </div>
                            <div class="w-full">

                                <TextInput :id="`rule_${key}_title`" v-model="form.rules[selectedTab][key].title"
                                    type="text" class="mt-1 block w-full" required
                                    :has-error="!!form.errors['rules.' + selectedTab + '.' + key + '.title']"
                                    :placeholder="__('Enter title') + '...'" />
                                <InputError :message="form.errors['rules.' + selectedTab + '.' + key + '.title']"
                                    class="mt-2" />
                            </div>
                            <div class="w-full">
                                <SelectInput v-model="form.rules[selectedTab][key].icon"
                                    :id="`bed_type_${key}_new_icon`">
                                    <option disabled value="none">- {{ __('select icon') }} -</option>
                                    <option v-for="icon, key in $page.props.icon_list" :key="key" :value="icon.name">{{
                                        __(icon.label) }}
                                    </option>
                                </SelectInput>
                            </div>
                        </div>
                        <div class="w-full mt-2">
                            <TipTapInput :is-small="true"
                                :id="`rule_${key}_description`"
                                v-model="form.rules[selectedTab][key].description"
                                :has-error="!!form.errors['rules.' + selectedTab + '.' + key + '.description']" />
                            <!-- <TextArea :id="`rule_${key}_description`" rows="2"
                                v-model="form.rules[selectedTab][key].description" type="text" class="mt-1 block w-full"
                                required :has-error="!!form.errors['rules.' + selectedTab + '.' + key + '.description']"
                                :placeholder="__('Enter description') + '...'" /> -->
                            <InputError :message="form.errors['rules.' + selectedTab + '.' + key + '.description']"
                                class="mt-2" />
                        </div>
                    </div>
                    <div class="">
                        <button @click="handleRemoveRule(rule)">
                            <TrashBinIcon class="text-bittersweet-700 dark:text-bittersweet-500" />
                        </button>
                    </div>
                </div>

                <h4 class="text-base font-bold dark:text-white mt-2">{{ __('Add New') }}</h4>

                <div class="flex items-center space-x-2">
                    <div class="w-full">
                        <div class="flex items-center space-x-2">
                            <div class="w-full">
                                <TextInput :id="`new_rule_name`" v-model="newRule.name" type="text"
                                    class="mt-1 block w-full" required :placeholder="__('Enter rule name') + '...'" />
                            </div>

                            <div class="w-full">
                                <TextInput :id="`new_rule_title`" v-model="newRule.title" type="text"
                                    class="mt-1 block w-full" required :placeholder="__('Enter rule title') + '...'" />
                            </div>

                            <div class="w-full">
                                <SelectInput v-model="newRule.icon" id="rule_new_icon">
                                    <option disabled value="none">- {{ __('select icon') }} -</option>
                                    <option v-for="icon, key in $page.props.icon_list" :key="key" :value="icon.name">{{
                                        __(icon.label) }}
                                    </option>
                                </SelectInput>
                            </div>
                        </div>

                        <div class="w-full mt-2">
                            <TipTapInput :is-small="true" :id="`new_rule_description`" v-model="newRule.description" />
                            <!-- <TextArea :id="`new_rule_description`" rows="2" v-model="newRule.description" type="text"
                                class="mt-1 block w-full" required :placeholder="__('Enter description') + '...'" /> -->
                        </div>
                    </div>

                    <div class="">
                        <button @click="handleAddRule">
                            <CirclePlusIcon class="text-amazon-600 dark:text-amazon-400" />
                        </button>
                    </div>
                </div>
            </div>
        </GridSection>

        <PrimaryButton type="button"
            :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
            :disabled="form.processing || form.recentlySuccessful || !form.isDirty" @click="update">
            <div class="flex items-center">
                <SpinnerIcon v-show="form.processing"
                    class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                {{ form.processing ? __('Saving') + '...' : form.recentlySuccessful ? __('Saved') : __('Save')
                }}
            </div>
        </PrimaryButton>




    </div>
</template>
