<script setup>
import GridSection from '@/Components/GridSection.vue';
import FullLayout from '@/Layouts/FullLayout.vue';
import SiteBackgroundSetting from './_partials/SiteBackgroundSetting.vue';
import DatepickerRangeSetting from './_partials/DatepickerRangeSetting.vue';
</script>

<template>
    <FullLayout :title="__('Settings')">
        <GridSection>
            <SiteBackgroundSetting :setting="$page.props.settings.find(setting => setting.slug === 'site-backgrounds')"/>
            <DatepickerRangeSetting :setting="$page.props.settings.find(setting => setting.slug === 'datepicker-range')"/>
        </GridSection>
    </FullLayout>

</template>
