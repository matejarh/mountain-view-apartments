<script setup>
import { icons } from '@/icons';
import { ref, watch, watchEffect } from 'vue';
import AddPriceDialog from './AddPriceDialog.vue'
import { useForm } from '@inertiajs/vue3';
import ConfirmationModal from '../ConfirmationModal.vue';

const props = defineProps({
    item: Object
})

const itemProxy = ref(props.item)
const showNewPriceDialog = ref(false)
const showDestroyConfirm = ref(false)

watch(props, () => {
    itemProxy.value = props.item
})

const form = useForm({})

const destroy = () => {
    form.delete(route('admin.prices.destroy', props.item), {
        onSuccess: () => {
            showDestroyConfirm.value = false
        }
    })
}
</script>

<template>
    <li
        class="max-w-full p-4 bg-white border border-gray-200 overflow-hidden rounded-lg shadow-lg dark:bg-gray-800 dark:border-gray-700  transition duration-150 ease-out">
        <div class="flex justify-between items-center">
            <h5 class="text-md font-semibold">
                {{ new Date(itemProxy.from).toLocaleDateString($page.props.locale) }}
                -
                {{ new Date(itemProxy.to).toLocaleDateString($page.props.locale) }}
            </h5>
            <div class="flex">
                <button class="w-full text-center" @click="showNewPriceDialog = true">
                    <icons.PenIcon class="text-amazon-600 dark:text-amazon-700 mx-auto w-4 h-4" />
                </button>
                <button @click="showDestroyConfirm = true">
                    <icons.TrashBinIcon class="w-4 h-4 text-bittersweet-600 dark:text-bittersweet-700" />
                </button>

            </div>
        </div>

        <TransitionGroup name="list" tag="ul" class="relative" key="pricesGroup">
    <li v-for="price, key in itemProxy.prices" :key="key" class="flex justify-between items-center">
        <span class="flex items-center">
            <div class="flex">
                <icons.UserIcon class="w-5 h-5" v-for="n in parseInt(price.guests)" :key="key" />

            </div>
            =
            {{ parseFloat(price.price).toFixed(2).toLocaleString($page.props.locale) }} €
        </span>
    </li>
    </TransitionGroup>
    <AddPriceDialog :show="showNewPriceDialog" @close="showNewPriceDialog = false" :price="item" />

    <ConfirmationModal :is-danger="true" :show="showDestroyConfirm" @close="showDestroyConfirm = false"
        @confirmed="destroy" :form="form" busy-text="Destroying" recently-successful-text="Destroyed"
        button-text="Destroy">
        <template #icon>
            <icons.WarningIcon class=" text-bittersweet-400 dark:text-bittersweet-500 w-11 h-11 mb-3.5 mx-auto" />
        </template>
        <template #content>
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                {{ __('Are you sure you want to destroy this date range.') }}</p>
            <p class="mb-4 text-gray-500 dark:text-gray-300 text-lg">
                {{ __('This will also destroy all prices under that range.') }}</p>
        </template>
    </ConfirmationModal>
    </li>
</template>

<style scoped>
.list-move,
/* apply transition to moving elements */
.list-enter-active,
.list-leave-active {
    transition: all 0.5s ease;
}

.list-enter-from,
.list-leave-to {
    opacity: 0;
    transform: translateX(50px);
}

/* ensure leaving items are taken out of layout flow so that moving
   animations can be calculated correctly. */
.list-leave-active {
    position: absolute;
}
</style>
