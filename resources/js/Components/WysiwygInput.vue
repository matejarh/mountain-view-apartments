<script setup>
import { reactive, ref, vModelText, watchEffect } from 'vue';
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

const props = defineProps({
    modelValue: String | Number,
    hasError: {
        default: false,
        type: Boolean,
    },
});

const html = ref(props.modelValue)

const emit = defineEmits(['update:modelValue'])

watchEffect(() => {
    if (html.value !== '') {
        emit('update:modelValue', html.value)
    }
})

const state = reactive({
      dynamicComponent: null,
      content: '<p>Initial Content</p>',
      _content: '',
      editorOption: {
        placeholder: 'core',
        modules: {
          toolbar: [
            // custom toolbars options
            // will override the default configuration
          ],
          // other moudle options here
        }
        // more options
      },
      disabled: false
    })
    const onEditorBlur = quill => {
      console.log('editor blur!', quill)
    }
    const onEditorFocus = quill => {
      console.log('editor focus!', quill)
    }
    const onEditorReady = quill => {
      console.log('editor ready!', quill)
    }
    const onEditorChange = ({ quill, html, text }) => {
        emit('update:modelValue', html)
      console.log('editor change!', quill, html, text)
      state._content = html
    }
    setTimeout(() => {
      state.disabled = true
    }, 2000)
</script>

<template>
    <div class="">
        <QuillEditor v-model:content="html" contentType="html" theme="snow" />
    </div>
<!--   <quill-editor
    v-model:value="state.content"
    :options="state.editorOption"
    :disabled="state.disabled"
    @blur="onEditorBlur($event)"
    @focus="onEditorFocus($event)"
    @ready="onEditorReady($event)"
    @change="onEditorChange($event)"
  /> -->

</template>
