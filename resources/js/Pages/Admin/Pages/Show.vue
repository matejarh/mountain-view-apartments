<script setup>
import FullLayout from '@/Layouts/FullLayout.vue';
import ActionSection from '@/Components/ActionSection.vue';
import { ref } from 'vue';
import EditForm from './_partials/EditForm.vue'
import GalleriesSection from './_partials/GalleriesSection.vue'
import ManageGalleriesDialog from './_partials/ManageGalleriesDialog.vue';

const showAttachGalleryDialog = ref(false)
</script>

<template>
    <FullLayout :title="__('Edit Page')">
        <ActionSection :fullwidth="true" back="admin.pages.index">
            <template #title>
                {{ $page.props?.page.name }}
                -
                {{ $page.props?.page?.title[$page.props?.locale] }}
            </template>

            <template #content>
                <EditForm />
            </template>
        </ActionSection>

        <ActionSection :fullwidth="true" class="mt-4">
            <template #title>
                {{ __('Galleries') }}
            </template>

            <template #content>
                <GalleriesSection @manage="showAttachGalleryDialog = true" />
            </template>
        </ActionSection>

        <ManageGalleriesDialog :show="showAttachGalleryDialog" @close="showAttachGalleryDialog = false"
            :page="$page.props?.page" />
    </FullLayout>
</template>
