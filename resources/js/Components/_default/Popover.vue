<script setup>
import { getCurrentInstance, onMounted, ref } from 'vue'
import { Popover } from 'flowbite'
import InfoIcon from '@/Icons/InfoIcon.vue';
import { useHelperStore } from '@/stores/helpers';

const props = defineProps({
    title: String,
    placement: {
        default: 'top',
        type: String,
    },
    triggerType: {
        default: 'hover',
        type: String,
    }
})

const component = getCurrentInstance()
const helpers = useHelperStore()

const popoverButton = ref(null)
const popoverContent = ref(null)

const initialize = () => {
    // set the popover content element
    const $triggerEl = popoverButton.value
    // const $triggerEl = document.getElementById(`popoverButton-${component.vnode.key}`)

    // set the element that trigger the popover using hover or click
    const $targetEl = popoverContent.value
    // const $targetEl = document.getElementById(`popoverContent-${component.vnode.key}`)

    // options with default values
    const options = {
        placement: props.placement,
        triggerType: props.triggerType,
        offset: 10,
        onHide: () => {
             //console.log('popover is shown');
        },
        onShow: () => {
             //console.log('popover is hidden');
        }
    };
    if ($targetEl) {
        //console.log($targetEl)
        /*
        * targetEl: required
        * triggerEl: required
        * options: optional
        */
        const popover = new Popover($targetEl, $triggerEl, options);
        // console.log(popover)
        // popover.show();
    }
}

onMounted(() => {

    helpers.delay(100).then(() => {

        initialize()
    })
})
</script>

<template>
    <div class="relative overflow-visible">
        <span ref="popoverButton" class="cursor-pointer block" type="button">
            <slot />
        </span>
        <div data-popover ref="popoverContent" role="tooltip"
            class="absolute z-10 invisible inline-block w-64 text-sm font-light text-gray-500 transition-opacity duration-300 bg-white border-0 border-primary-700 rounded-lg shadow-lg opacity-0 dark:text-gray-400 dark:border-gray-950 dark:bg-gray-800">
            <div
                class="px-3 py-2 bg-primary-600 border-b border-primary-600 rounded-t-lg dark:border-primary-800 dark:bg-primary-800 flex items-center justify-between">
                <h3 class="font-semibold text-white dark:text-white">{{ title }}</h3>
                <InfoIcon class="w-4 h-4 text-white dark:text-white" />
            </div>
            <div class="px-3 py-2">
                <slot name="content"></slot>
            </div>
            <div data-popper-arrow></div>
        </div>
    </div>
</template>
