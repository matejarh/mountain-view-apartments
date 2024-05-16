<template>
    <div class="rounded-lg w-full border " :class="errorClasses" >
        <div v-if="editor"  :class="isSmall ? 'py-0': 'py-2'" class="flex items-center justify-between px-3 border-b dark:border-gray-600">
            <div
                class="w-full flex justify-between flex-wrap items-center divide-gray-200 sm:divide-x sm:rtl:divide-x-reverse dark:divide-gray-600">
                <div class="left justify-self-stretch flex flex-wrap items-center space-x-1 rtl:space-x-reverse sm:pe-4">
                    <button v-if="!isSmall" @click="editor.chain().focus().toggleHeading({ level: 1 }).run()"
                        :class="[buttonClasses, editor?.isActive('heading', { level: 1 }) ? activeButtonClasses : '']">
                        <div class="flex">
                            <HeadingIcon :class="iconClasses" />
                            1
                        </div>
                    </button>
                    <button v-if="!isSmall" @click="editor.chain().focus().toggleHeading({ level: 2 }).run()"
                        :class="[buttonClasses, editor?.isActive('heading', { level: 2 }) ? activeButtonClasses : '']">
                        <div class="flex">
                            <HeadingIcon :class="iconClasses" />
                            2
                        </div>
                    </button>
                    <button v-if="!isSmall" @click="editor.chain().focus().toggleHeading({ level: 3 }).run()"
                        :class="[buttonClasses, editor?.isActive('heading', { level: 3 }) ? activeButtonClasses : '']">
                        <div class="flex">
                            <HeadingIcon :class="iconClasses" />
                            3
                        </div>
                    </button>
                    <button v-if="!isSmall" @click="editor.chain().focus().setParagraph().run()"
                        :class="[buttonClasses, editor?.isActive('paragraph') ? activeButtonClasses : '']">
                        <ParagraphIcon :class="iconClasses" class="" />
                    </button>
                    <button @click="editor.chain().focus().toggleBold().run()"
                        :class="[buttonClasses, editor?.isActive('bold') ? activeButtonClasses : '']">
                        <BoldIcon :class="iconClasses" class="" />
                    </button>
                    <button @click="editor.chain().focus().toggleItalic().run()"
                        :class="[buttonClasses, editor?.isActive('italic') ? activeButtonClasses : '']">
                        <ItalicIcon :class="iconClasses" />
                    </button>
                    <button @click="editor.chain().focus().toggleStrike().run()"
                        :class="[buttonClasses, editor?.isActive('strike') ? activeButtonClasses : '']">
                        <TextSlashIcon :class="iconClasses" />
                    </button>
                    <button @click="editor.chain().focus().toggleHighlight().run()"
                        :class="[buttonClasses, editor?.isActive('highlight') ? activeButtonClasses : '']">
                        <HighlightIcon :class="iconClasses" />
                    </button>
                    <button  v-if="!isSmall" @click="editor.chain().focus().setTextAlign('left').run()"
                        :class="[buttonClasses, editor?.isActive({ textAlign: 'left' }) ? activeButtonClasses : '']">
                        <AlignLeftIcon :class="iconClasses" class="" />
                    </button>
                    <button  v-if="!isSmall" @click="editor.chain().focus().setTextAlign('center').run()"
                        :class="[buttonClasses, editor?.isActive({ textAlign: 'center' }) ? activeButtonClasses : '']">
                        <AlignCenterIcon :class="iconClasses" class="" />
                    </button>
                    <button  v-if="!isSmall" @click="editor.chain().focus().setTextAlign('right').run()"
                        :class="[buttonClasses, editor?.isActive({ textAlign: 'right' }) ? activeButtonClasses : '']">


                        <AlignRightIcon :class="iconClasses" class="" />
                    </button>
                    <button  v-if="!isSmall" @click="editor.chain().focus().setTextAlign('justify').run()"
                        :class="[buttonClasses, editor?.isActive({ textAlign: 'justify' }) ? activeButtonClasses : '']">
                        <AlignJustifyIcon :class="iconClasses" class="" />
                    </button>
                </div>

                <button class="justify-self-end"  @click=""
                    :class="[buttonClasses]">
                    <FullScreenIcon :class="iconClasses" class="" />
                </button>


            </div>

        </div>
        <div class="px-4 py-2  rounded-b-lg dark:bg-gray-800" :class="hasError? 'bg-bittersweet-50' : 'bg-gray-50 dark:bg-gray-800'">
            <editor-content :editor="editor"  />
        </div>
    </div>
</template>

<script setup>
import { useEditor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import Highlight from '@tiptap/extension-highlight'
import TextAlign from '@tiptap/extension-text-align'
import { computed, onBeforeUnmount, ref, watch, watchEffect } from 'vue';
import AlignCenterIcon from './TipTapIcons/AlignCenterIcon.vue';
import BoldIcon from './TipTapIcons/BoldIcon.vue';
import AlignLeftIcon from './TipTapIcons/AlignLeftIcon.vue';
import AlignRightIcon from './TipTapIcons/AlignRightIcon.vue';
import AlignJustifyIcon from './TipTapIcons/AlignJustifyIcon.vue';
import ParagraphIcon from './TipTapIcons/ParagraphIcon.vue';
import ItalicIcon from './TipTapIcons/ItalicIcon.vue';
import TextSlashIcon from './TipTapIcons/TextSlashIcon.vue';
import HighlightIcon from './TipTapIcons/HighlightIcon.vue';
import HeadingIcon from './TipTapIcons/HeadingIcon.vue';
import FullScreenIcon from '@/Icons/FullScreenIcon.vue';

const props = defineProps({
    modelValue: {
      type: String,
      default: '',
    },
    hasError: {
        default: false,
        type: Boolean,
    },
    isSmall: {
        default: false,
        type: Boolean,
    },
})
const emitUpdate = defineEmits(['update:modelValue'])

const shake = ref(false)

const editor = useEditor({
    content: props.modelValue,
    extensions: [
        StarterKit,
        TextAlign.configure({
            types: ['heading', 'paragraph'],
        }),
        Highlight,
    ],
    editorProps: {
        attributes: {
            class: 'prose dark:prose-invert prose-sm sm:prose-base lg:prose-base xl:prose-base m-2 focus:outline-none  ',
        },
    },

    onUpdate({ editor }) {
        emitUpdate('update:modelValue', editor.getHTML())
    },
})

const initiateShake = () => {
    shake.value = true
    setTimeout(() => {
        shake.value = false
    }, 1500);
}

watchEffect(() => {
    if (props.hasError === true) {
        initiateShake()
    }
})

watch(props, (value) => {
  const isSame = editor.value.getHTML() === props.modelValue

  if (!isSame) {
    editor.value.commands.setContent(props.modelValue, false)
  }
})

const errorClasses = computed(() => {
    return [
        props.hasError ? 'border-bittersweet-600 bg-bittersweet-50 dark:bg-gray-700 dark:border-bittersweet-600' : 'border-gray-200 bg-gray-50 dark:bg-gray-700 dark:border-gray-600',
        shake.value ? 'animate-shake' : ''
    ]
})

const buttonClasses = computed(() => {
    return [
        ' font-bold text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600',
        props.isSmall ? 'text-xs md:text-sm p-1' : 'p-2 text-xs md:text-base'
    ]
})
const iconClasses = computed(() => {
    return [
        props.isSmall ? 'h-3 w-3 md:w-4 md:h-4' : 'h-3 w-3 md:w-6 md:h-6'
    ]
})

const activeButtonClasses = computed(() => {
    return 'text-gray-900 bg-gray-100 dark:text-white dark:bg-gray-600'

})

onBeforeUnmount(() => {
  editor.value.destroy()
})
</script>

