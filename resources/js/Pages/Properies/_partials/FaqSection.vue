<script setup>
import AccordianComponent from '@/Components/_default/AccordianComponent.vue';
import ShapedSection from '@/Components/_default/ShapedSection.vue';
import { ref } from 'vue';

const faqs = ref([
    {
        q: 'Question 1',
        a: '<p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is an open-source library of interactive components built on top of Tailwind CSS including buttons, dropdowns, modals, navbars, and more.</p><p class="text-gray-500 dark:text-gray-400">Check out this guide to learn how to <a href="/docs/getting-started/introduction/" class="text-blue-600 dark:text-blue-500 hover:underline">get started</a> and start developing websites even faster with components on top of Tailwind CSS.</p>'
    },
    {
        q: 'Question 2',
        a: '<p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is an open-source library of interactive components built on top of Tailwind CSS including buttons, dropdowns, modals, navbars, and more.</p><p class="text-gray-500 dark:text-gray-400">Check out this guide to learn how to <a href="/docs/getting-started/introduction/" class="text-blue-600 dark:text-blue-500 hover:underline">get started</a> and start developing websites even faster with components on top of Tailwind CSS.</p>'
    },
    {
        q: 'Question 3',
        a: '<p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is an open-source library of interactive components built on top of Tailwind CSS including buttons, dropdowns, modals, navbars, and more.</p><p class="text-gray-500 dark:text-gray-400">Check out this guide to learn how to <a href="/docs/getting-started/introduction/" class="text-blue-600 dark:text-blue-500 hover:underline">get started</a> and start developing websites even faster with components on top of Tailwind CSS.</p>'
    },
])
</script>

<template>
<ShapedSection>
    <div class="py-8 lg:py-16 mx-auto max-w-screen-xl px-4">

        <AccordianComponent :items="faqs" class="mb-10" />
    </div>
</ShapedSection>
</template>
