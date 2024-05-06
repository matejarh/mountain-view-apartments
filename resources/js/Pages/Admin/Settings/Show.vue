<script setup>
import GridSection from '@/Components/GridSection.vue';
import FullLayout from '@/Layouts/FullLayout.vue';
import SiteBackgroundSetting from './_partials/SiteBackgroundSetting.vue';
</script>

<template>
    <FullLayout :title="__('Settings')">
        <GridSection>
            <SiteBackgroundSetting :settings="$page.props.settings"/>
        </GridSection>
    </FullLayout>

</template>
