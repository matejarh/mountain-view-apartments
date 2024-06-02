<script setup>
import DialogModal from '@/Components/DialogModal.vue'
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { icons } from '@/icons';
import { useForm } from '@inertiajs/vue3';
import { onMounted, ref, watchEffect } from 'vue';
import InputLabel from '../InputLabel.vue';


const props = defineProps({
    price: Object,
    show: Boolean,
})

const emit = defineEmits(['close'])

const form = useForm({
    // from: props.price?.from,
    // to: props.price?.to,
    // range: props.price?.range,
    prices: props.price?.prices
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
    form.prices = props.price?.prices
}


const newPrice = ref({
    guests: 1,
    price: '0.00'
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

            <div class="">
                <TransitionGroup name="list" tag="ul" class="relative" key="pricesGroup">
                    <li v-for="price, key in form.prices" :key="key" class="flex justify-between items-center">
                        <span>
                            {{ price.guests }} {{ __('Guest', price.guests) }} = {{
                                parseFloat(price.price).toFixed(2).toLocaleString($page.props.locale) }} €
                        </span>
                        <div class="">
                            <button @click="removeItem(form.prices, price)">
                                <icons.TrashBinIcon class="text-bittersweet-700 dark:text-bittersweet-500" />
                            </button>
                        </div>

                    </li>
                </TransitionGroup>
            </div>
            <div class="flex items-center space-x-2">

                <div class="w-full">
                    <InputLabel for="new_guests" :value="__('Number of guests')" />
                    <TextInput :id="`new_guests`" v-model="newPrice.guests" type="number" min="1" max="10" step="1"
                        class="mt-1 block w-full" required :placeholder="__('Enter number of guests') + '...'" />
                    <InputError :message="form.errors.guests" />
                </div>
                <div class="w-full">
                    <InputLabel for="new_price" :value="__('Price')" />
                    <TextInput :id="`new_price`" v-model="newPrice.price" type="text" class="mt-1 block w-full" required
                        :placeholder="__('Enter price') + '...'" />
                    <InputError :message="form.errors.price" />
                </div>
                <div>
                    <button class="w-full text-center mt-8" @click="handleAddItem(form.prices, newPrice)">
                        <icons.CirclePlusIcon class="text-amazon-600 dark:text-amazon-700 mx-auto" />
                    </button>
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
