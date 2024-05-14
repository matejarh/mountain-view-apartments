<script setup>
import GridSection from '@/Components/GridSection.vue';
import TipTap from '@/Components/TipTapInput.vue';
import Welcome from '@/Components/Welcome.vue';
import FullLayout from '@/Layouts/FullLayout.vue';
import { ref } from 'vue';

const content = ref('<p>A Vue.js wrapper component for tiptap to use <code>v-model</code>.</p>')
</script>

<template>
    <FullLayout title="Dashboard">
        <template #header>

            {{ __("Dashboard") }}

        </template>


        <!-- <Welcome /> -->
        <GridSection>

        </GridSection>
        <TipTap v-model="content" />

        <div class="content">
            <h3>Content</h3>
            <pre><code>{{ content }}</code></pre>
        </div>


    </FullLayout>
</template>
