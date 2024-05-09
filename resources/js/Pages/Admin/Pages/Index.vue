<script setup>
import FullLayout from '@/Layouts/FullLayout.vue';
import ActionSection from '@/Components/ActionSection.vue';


</script>

<template>
    <FullLayout>
        <ActionSection :fullwidth="true">
            <template #title>
                {{ __('Pages') }}
            </template>

            <template #content>

            </template>
        </ActionSection>
    </FullLayout>
</template>
