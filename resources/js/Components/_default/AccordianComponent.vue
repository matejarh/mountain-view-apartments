<script setup>
import { Accordion } from "flowbite";
import { onBeforeUnmount, onMounted, ref } from "vue";
import AccordianBody from "./AccordianBody.vue";
import AccordianHeading from "./AccordianHeading.vue";

const props = defineProps({
    items: Array
})

const show = ref(0)
</script>

<template>
    <div>
        <template v-for="item, key in items" :key="key">
            <AccordianHeading :id="`accordion-heading-${key}`" :is-first="key === 0" :is-last="key >= items.length - 1"
                :is-showing="show === key" @click="show = key">
                {{ item.q }}
            </AccordianHeading>

            <AccordianBody :id="`accordion-body-${key}`" :is-last="key >= items.length - 1" v-show="show === key"
                :html="item.a"
                class="format  format-p:mb-2 max-w-full format-p:text-gray-500 dark:format-p:text-gray-400">

            </AccordianBody>

        </template>
    </div>
</template>
