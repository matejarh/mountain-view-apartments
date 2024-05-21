<script setup>
import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage()

const extrasKey = computed(() => {
    return page.props?.page.name.toLocaleLowerCase().replace(' ', '_')
})

const extractedContent = computed(() => {
    return extractContentFromText(page.props?.page.extras[extrasKey.value]?.text[page.props?.locale])
})

const extractContentFromText = (text) => {
    const result = [];
    const parser = new DOMParser();
    const doc = parser.parseFromString(text, 'text/html');
    const headings = doc.querySelectorAll('h3');

    headings.forEach((heading, index) => {
        const title = heading.textContent;
        let content = '';
        let nextElement = heading.nextElementSibling;

        while (nextElement && nextElement.tagName !== 'H3') {
            content += nextElement.outerHTML;
            nextElement = nextElement.nextElementSibling;
        }

        result.push({ title, content });
    });

    return result;
}
</script>

<template>
    <section>
        <div class=" dark:text-white py-28 max-w-screen-xl mx-auto">
            <div class="grid grid-cols-1 xl:grid-cols-1 gap-4 p-4">
                <div v-for="paragraph, key in extractedContent" :key="key"
                    class="flex flex-col items-start bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-full hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="object-cover w-full rounded-t-lg h-auto md:w-1/2 md:rounded-none md:rounded-s-lg"
                        :src="$page.props?.page.galleries[0]?.images[key].thumb_url" alt="">
                    <div class="flex flex-col justify-between p-4 leading-normal">
                        <h3 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ paragraph.title }}
                        </h3>
                        <article
                            class="mb-3 md:max-w-screen-lg mx-auto format format-h4:text-gray-600 dark:format-h4:text-gray-100 p-4 font-normal text-gray-700 dark:text-gray-400"
                            v-html="paragraph.content"></article>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
