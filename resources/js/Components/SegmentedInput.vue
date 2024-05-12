<script setup>
import TextInput from '@/Components/TextInput.vue';
import { ref, defineProps, defineEmits, watchEffect } from 'vue';

const props = defineProps({
    modelValue: String,
    error: {
        type: String,
        default: null
    },
    digits: {
        default: 6,
        type: Number,
    }
});

const codeSplited = ref(Array.from({ length: props.digits }, () => ''));
const codeInputs = ref([]);

const emit = defineEmits(['submit', 'update:modelValue']);

const focusInput = index => {
    codeInputs.value[index]?.focus();
};
watchEffect(() => {
    if (props.error !== null) {
        codeSplited.value=Array.from({ length: props.digits }, () => '')
        focusInput(0)
    }
})

const handleInput = (index, event) => {
    const value = event.target.value;
    if (!isNaN(value) && value !== '') {
        codeSplited.value[index] = value;
        if (index < props.digits - 1) {
            focusInput(index + 1);
        } else {
            emit('submit');
        }
    } else if (value === '') {
        codeSplited.value[index - 1] = '';
        if (index > 0) {
            focusInput(index - 1);
        }
    }
    emit('update:modelValue', codeSplited.value.join(''));
};
</script>

<template>
    <div class="flex mb-2 space-x-2 rtl:space-x-reverse">
        <TextInput
            v-for="(code, index) in codeSplited"
            :key="index"
            :id="`code-${index + 1}`"
            :value="code"
            v-model="codeSplited[index]"
            :type="'text'"
            :name="`code-${index + 1}`"
            :ref="el => codeInputs[index] = el"
            :pattern="'[0-9]{1,1}'"
            class="block w-9 h-9 py-3 text-base font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-700 focus:border-primary-700 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-800 dark:focus:border-primary-800"
            inputmode="numeric"
            :has-error="!!error"
            @input="handleInput(index, $event)"
            @keyup.backspace="handleInput(index, $event)"
        />
    </div>
</template>
