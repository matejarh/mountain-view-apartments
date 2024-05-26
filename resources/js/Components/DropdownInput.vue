<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { Dropdown } from 'flowbite';

const props = defineProps({
    color: {
        type: String,
        default: 'gray'
    }
})
const dropdownButtonRef = ref(null)
const dropdownMenuRef = ref(null)
const dropdown = ref(null)

const options = {
    placement: 'bottom',
    triggerType: 'click',
    offsetSkidding: 0,
    offsetDistance: 10,
    delay: 300,
    ignoreClickOutsideClass: false,
/*     onHide: () => {
        console.log('dropdown has been hidden');
    },
    onShow: () => {
        console.log('dropdown has been shown');
    },
    onToggle: () => {
        console.log('dropdown has been toggled');
    }, */
};

// instance options object
const instanceOptions = {
    //id: 'dropdownMenu',
    // override: true
};

onMounted(() => {
    // set the dropdown menu element
    const $triggerEl = dropdownButtonRef.value;

    // set the element that trigger the dropdown menu on click
    const $targetEl = dropdownMenuRef.value;

    dropdown.value = new Dropdown($targetEl, $triggerEl, options, instanceOptions);
})
</script>

<template>
    <div class="relative">
        <button  ref="dropdownButtonRef" data-dropdown-toggle="dropdown"
            :class="`text-gray-700 dark:text-white w-full border border-${color}-300 dark:border-${color}-600 bg-${color}-50 dark:bg-${color}-700 hover:bg-${color}-100 dark:hover:bg-${color}-800 focus:ring-4 focus:outline-none focus:ring-${color}-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-${color}-600 dark:hover:bg-${color}-700 dark:focus:ring-${color}-800`"
            type="button">
            <slot name="trigger" />


        </button>

        <!-- Dropdown menu -->
        <div  ref="dropdownMenuRef"
            class="z-10 hidden  bg-white divide-y divide-gray-100 rounded-lg shadow w-auto min-w-full dark:bg-gray-700">
            <ul class="h-48 py-2 overflow-y-auto text-gray-700 dark:text-gray-200" @click="dropdown.hide()">
                <slot />
            </ul>
        </div>

    </div>
</template>
