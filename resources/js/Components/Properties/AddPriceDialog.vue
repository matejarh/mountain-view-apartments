<script setup>
import DialogModal from '@/Components/DialogModal.vue'
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { icons } from '@/icons';
import { useForm } from '@inertiajs/vue3';
import { onMounted, ref, watchEffect } from 'vue';
import InputLabel from '../InputLabel.vue';
import Tooltip from '../_default/Tooltip.vue';


const props = defineProps({
    price: Object,
    show: Boolean,
})

const emit = defineEmits(['close'])

const form = useForm({
    // from: props.price?.from,
    // to: props.price?.to,
    // range: props.price?.range,
    min_days: props.price?.min_days,
    max_days: props.price?.max_days,
    prices: props.price?.prices,
    discounts: props.price?.discounts ? props.price?.discounts : [],
})

const initialized = ref(false)

watchEffect(() => {
    if (props.price && initialized.value) {
        updateForm()
    }
})

const updateForm = () => {
    //form.from = props.price?.from
    //form.to = props.price?.to
    form.min_days = props.price?.min_days
    form.max_days = props.price?.max_days
    form.prices = props.price?.prices
    form.discounts = props.price?.discounts ? props.price?.discounts : []
}


const newPrice = ref({
    guests: 1,
    price: '0.00',
})
const newDiscount = ref({
    days: 6,
    discount: '10%',
})


const removeItem = (list, item) => {
    const index = list.indexOf(item);
    if (index > -1) list.splice(index, 1);
};

const handleAddItem = (list, newItem) => {
    if (Object.values(newItem).every(value => value)) {
        list.push({ ...newItem });
        Object.keys(newItem).forEach(key => newItem[key] = '');
    }
};

const update = () => {
    //emit('close')
    form.put(route('admin.prices.update', props.price), {
        errorBag: 'updatingPrice',
        onSuccess: () => {
            //  console.log('attachec')
            emit('close')
        }
    })
}

onMounted(() => {
    initialized.value = true
})
</script>

<template>
    <DialogModal max-width="xl" :show="show" @close="$emit('close')">
        <template #title>
            {{ __('Edit Prices') }} {{ __('from') }}
            {{ new Date(price.from).toLocaleDateString($page.props.locale) }}
            {{ __('to') }}
            {{ new Date(price.to).toLocaleDateString($page.props.locale) }}
        </template>

        <template #content>
            <div class="flex items-center space-x-2">
                <div class="w-full">
                    <InputLabel for="min_days" :value="__('Min Nights')" />
                    <TextInput :id="`min_days`" v-model="form.min_days" type="number" min="1" max="10" step="1"
                        class="mt-1 block w-full" required :placeholder="__('Enter minimum number of nights') + '...'" />
                    <InputError :message="form.errors.min_days" />
                </div>
                <div class="w-full">
                    <InputLabel for="max_days" :value="__('Max Nights')" />
                    <TextInput :id="`max_days`" v-model="form.max_days" type="number" min="1" max="30" step="1"
                        class="mt-1 block w-full" required :placeholder="__('Enter maximum number of nights') + '...'" />
                    <InputError :message="form.errors.max_days" />
                </div>
            </div>

            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg mt-4">
                <h5 class="text-lg font-bold ">{{ __('Prices') }}</h5>
                <div class="min-h-12">
                    <TransitionGroup name="list" tag="ul" class="relative" key="pricesGroup">
                        <li v-for="price, key in form.prices" :key="key" class="flex justify-between items-center">
                            <span>
                                {{ price.guests }} {{ __('Guest', price.guests) }} = {{
                                    parseFloat(price.price).toFixed(2).toLocaleString($page.props.locale) }} €
                            </span>
                            <div class="">
                                <Tooltip :text="__('Remove Price')">
                                    <button @click="removeItem(form.prices, price)">
                                        <icons.TrashBinIcon class="text-bittersweet-700 dark:text-bittersweet-500" />
                                    </button>
                                </Tooltip>
                            </div>

                        </li>
                    </TransitionGroup>
                </div>
                <div class="flex items-center space-x-2">

                    <div class="w-full">
                        <InputLabel for="new_guests" :value="__('Number of guests')" />
                        <TextInput :id="`new_guests`" v-model="newPrice.guests" type="number" min="1" max="10" step="1"
                            class="mt-1 block w-full" required :placeholder="__('Enter number of guests') + '...'" />
                        <InputError :message="form.errors.prices" />
                    </div>
                    <div class="w-full">
                        <InputLabel for="new_price" :value="__('Price')" />
                        <TextInput :id="`new_price`" v-model="newPrice.price" type="text" class="mt-1 block w-full" required
                            :placeholder="__('Enter price') + '...'" />
                        <InputError :message="form.errors.prices" />
                    </div>
                    <div>
                        <Tooltip :text="__('Add Price')">
                            <button class="w-full text-center mt-8" @click="handleAddItem(form.prices, newPrice)">
                                <icons.CirclePlusIcon class="text-amazon-600 dark:text-amazon-700 mx-auto" />
                            </button>
                        </Tooltip>
                    </div>
                </div>
            </div>

            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-lg mt-4">
                <h5 class="text-lg font-bold ">{{ __('Discounts') }}</h5>
                <div class="min-h-6">
                    <TransitionGroup name="list" tag="ul" class="relative" key="discountsGroup">
                        <li v-for="discount, key in form.discounts" :key="key" class="flex justify-between items-center">
                            <span>
                                {{ discount.discount }}
                                {{ __('discount') }}
                                {{ __('for') }}
                                {{ discount.days }}
                                {{ __('night', discount.days) }}
                                {{ __('or more') }}
                            </span>
                            <div class="">
                                <Tooltip :text="__('Remove Discount')">
                                    <button @click="removeItem(form.discounts, discount)">
                                        <icons.TrashBinIcon class="text-bittersweet-700 dark:text-bittersweet-500" />
                                    </button>
                                </Tooltip>
                            </div>

                        </li>
                    </TransitionGroup>
                </div>
                <div class="flex items-center space-x-2">

                    <div class="w-full">
                        <InputLabel for="new_discount_days" :value="__('Number of days')" />
                        <TextInput :id="`new_discount_days`" v-model="newDiscount.days" type="number" min="1" max="30" step="1"
                            class="mt-1 block w-full" required :placeholder="__('Enter number of days') + '...'" />
                        <InputError :message="form.errors.discounts" />
                    </div>
                    <div class="w-full">
                        <InputLabel for="new_discount_discount" :value="__('Discount')" />
                        <TextInput :id="`new_discount_discount`" v-model="newDiscount.discount" type="text" class="mt-1 block w-full" required
                            :placeholder="__('Enter discount in %') + '...'" />
                        <InputError :message="form.errors.discounts" />
                    </div>
                    <div>
                        <Tooltip :text="__('Add Discount')">
                            <button class="w-full text-center mt-8" @click="handleAddItem(form.discounts, newDiscount)">
                                <icons.CirclePlusIcon class="text-amazon-600 dark:text-amazon-700 mx-auto" />
                            </button>
                        </Tooltip>
                    </div>
                </div>
            </div>


        </template>

        <template #footer>

            <PrimaryButton type="button" @click="update"
                :class="{ 'opacity-25': form.processing || form.recentlySuccessful || !form.isDirty }"
                :disabled="form.processing || form.recentlySuccessful || !form.isDirty">

                <div class="flex items-center">
                    <icons.SpinnerIcon v-show="form.processing"
                        class="animate-spin -ml-1 mr-3 h-5 w-5 text-white dark:text-white" />
                    {{ form.processing ? __('Saving') + '...' : form.recentlySuccessful ? __('Saved') : __('Save') }}
                </div>
            </PrimaryButton>
        </template>

    </DialogModal>
</template>
