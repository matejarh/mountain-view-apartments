<script setup>
import { getCurrentInstance, ref, watchEffect } from 'vue';
import DropdownInput from './DropdownInput.vue';
import Dropdown from './Dropdown.vue';
import { icons } from '@/icons';

const props = defineProps({
    modelValue: String,
})

const instance = getCurrentInstance();

const emit = defineEmits(['update:modelValue'])

const selectedItem = ref({
    value: null,
    icon: null,
    label: '-- select icon --'
})

watchEffect(() => {
    if(props.modelValue) {
        selectedItem.value = {
            value: props?.modelValue,
            icon: props?.modelValue,
            label: props?.modelValue
        }

    }
})

const handleSelectIcon = (key, icon) => {
    selectedItem.value = {
        value: key,
        icon: icon,
        label: key
    }
    emit('update:modelValue', key)
}

</script>

<template>
    <div class="">
        <DropdownInput :key="instance.vnode.key">
            <template #trigger>
                    <component :is="icons[selectedItem.value]" v-if="selectedItem.icon" class="w-5 h-5 me-3" />
                    {{ selectedItem.label }}
            </template>
            <li v-for="icon, key in icons" :key="key" >
                <a href="#" @click="handleSelectIcon(key, icon)"
                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    <div class="inline-flex items-center">
                        <component :is="icons[key]"  class="w-5 h-5 me-3"/>
                        {{key}}
                    </div>
                </a>
            </li>
        </DropdownInput>
    </div>
</template>
