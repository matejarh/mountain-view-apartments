<script setup>
import TextInput from '@/Components/TextInput.vue';
import { ref, watchEffect } from 'vue';

const props = defineProps({
    modelValue: String,
    error: {
        type: String | null,
        default: null
    }
})
const codeSplited = ref([])

const code1 = ref(null)

const emit = defineEmits(['submit', 'update:modelValue'])

watchEffect(() => {
    if (codeSplited.value.length >= 6) {
        let code = codeSplited.value.join(',').replaceAll(',', '')
        // console.log(code)
        // confirmationForm.code = code
        emit('update:modelValue', code)
    }
})

defineExpose({ focus: () => code1.value.focus() });
</script>

<template>
    <div class="flex mb-2 space-x-2 rtl:space-x-reverse">
        <!-- @keyup.enter="confirmTwoFactorAuthentication" -->
        <TextInput id="code-1" :value="modelValue[0]" v-model="codeSplited[0]" type="text" name="code-1" ref="code1" pattern="[0-9]{1,1}"
            class="block w-9 h-9 py-3 text-base font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            inputmode="numeric" autofocus :has-error="!!error"
            @input="Number.isInteger(parseInt($event.data)) ? $refs.code2.focus() : codeSplited.splice(0, 1)"
            @keyup.backspace="codeSplited.splice(0, 1)" />

        <TextInput id="code-2" :value="modelValue[1]" v-model="codeSplited[1]" type="text" name="code-2" ref="code2" pattern="[0-9]{1,1}"
            class="block w-9 h-9 py-3 text-base font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            inputmode="numeric" :has-error="!!error"
            @input="Number.isInteger(parseInt($event.data)) ? $refs.code3.focus() : codeSplited.splice(1, 1)"
            @keyup.backspace="codeSplited.splice(1, 1), $refs.code1.focus()" />

        <TextInput id="code-3" :value="modelValue[2]" v-model="codeSplited[2]" type="text" name="code-3" ref="code3" pattern="[0-9]{1,1}"
            class="block w-9 h-9 py-3 text-base font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            inputmode="numeric" :has-error="!!error"
            @input="Number.isInteger(parseInt($event.data)) ? $refs.code4.focus() : codeSplited.splice(2, 1)"
            @keyup.backspace="codeSplited.splice(2, 1), $refs.code2.focus()" />

        <TextInput id="code-4" :value="modelValue[3]" v-model="codeSplited[3]" type="text" name="code-4" ref="code4" pattern="[0-9]{1,1}"
            class="block w-9 h-9 py-3 text-base font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            inputmode="numeric" :has-error="!!error"
            @input="Number.isInteger(parseInt($event.data)) ? $refs.code5.focus() : codeSplited.splice(3, 1)"
            @keyup.backspace="codeSplited.splice(3, 1), $refs.code3.focus()" />

        <TextInput id="code-5" :value="modelValue[4]" v-model="codeSplited[4]" type="text" name="code-5" ref="code5" pattern="[0-9]{1,1}"
            class="block w-9 h-9 py-3 text-base font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            inputmode="numeric" :has-error="!!error"
            @input="Number.isInteger(parseInt($event.data)) ? $refs.code6.focus() : codeSplited.splice(4, 1)"
            @keyup.backspace="codeSplited.splice(4, 1), $refs.code4.focus()" />

        <TextInput id="code-6" :value="modelValue[5]" v-model="codeSplited[5]" type="text" name="code-6" ref="code6" pattern="[0-9]{1,1}"
            class="block w-9 h-9 py-3 text-base font-extrabold text-center text-gray-900 bg-white border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
            inputmode="numeric" :has-error="!!error"
            @change="Number.isInteger(parseInt($event.data)) ? $emit('submit') : codeSplited.splice(5, 1)"
            @keyup.enter="$emit('submit')"
            @keyup.backspace="codeSplited.splice(5, 1), $refs.code5.focus()" />

    </div>
</template>
