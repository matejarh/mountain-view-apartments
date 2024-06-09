<script setup>
import { getCurrentInstance, onMounted, ref } from 'vue'
import { Tooltip } from 'flowbite'
import { useHelperStore } from '@/stores/helpers';

const props = defineProps({
    text: String,
    placement: {
        default: 'top',
        type: String,
    },
    triggerType: {
        default: 'hover',
        type: String,
    }
})

const helpers = useHelperStore()

const tooltipButton = ref(null)
const tooltipContent = ref(null)

const initialize = () => {
    // set the tooltip content element
    const $targetEl = tooltipContent.value

    // set the element that trigger the tooltip using hover or click
    const $triggerEl = tooltipButton.value

    // options with default values
    const options = {
        placement: props.placement,
        triggerType: props.triggerType,

        onHide: () => {
            //console.log('tooltip is shown');
        },
        onShow: () => {
            //console.log('tooltip is hidden');
        }
    };

    if ($targetEl) {
        /*
        * targetEl: required
        * triggerEl: required
        * options: optional
        */
        const tooltip = new Tooltip($targetEl, $triggerEl, options);

        //console.log(tooltip)
        // show the tooltip
        //tooltip.show();
    }
}

onMounted(() => {
    helpers.delay(100).then(() => {

        initialize()
    })
})
</script>

<template>
    <div class="relative">
        <span ref="tooltipButton" type="button" class="font-semibold hover:font-bold relative block">
            <slot />
        </span>

        <div ref="tooltipContent" role="tooltip"
            class="absolute z-[100000] invisible inline-block px-3 py-2 whitespace-nowrap text-sm font-medium text-white transition-opacity duration-300 bg-gray-950 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-950">
            {{ text }}
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
</template>
