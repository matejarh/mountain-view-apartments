<script setup>
import ActionSection from '@/Components/ActionSection.vue';
import FullLayout from '@/Layouts/FullLayout.vue';

defineProps({
    gallery: Object
})

</script>

<template>
    <FullLayout :title="__('Gallery')">
        <ActionSection :fullwidth="true">
            <template #title>
                {{ __(gallery.name) }}
            </template>
            <template #content>
                {{ gallery }}
            </template>

        </ActionSection>
    </FullLayout>
</template>
