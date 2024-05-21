<script setup>
import GridSection from '@/Components/GridSection.vue';
import FullLayout from '@/Layouts/FullLayout.vue';
import SiteBackgroundSetting from './_partials/SiteBackgroundSetting.vue';
import DatepickerRangeSetting from './_partials/DatepickerRangeSetting.vue';
import IntervalsSetting from './_partials/IntervalsSetting.vue';
import CompanyInfoSetting from './_partials/CompanyInfoSetting.vue';
</script>

<template>
    <FullLayout :title="__('Settings')">
        <GridSection>
            <SiteBackgroundSetting :setting="$page.props?.settings.find(setting => setting.slug === 'site-backgrounds')"/>
            <DatepickerRangeSetting :setting="$page.props?.settings.find(setting => setting.slug === 'datepicker-range')"/>
            <CompanyInfoSetting :setting="$page.props?.settings.find(setting => setting.slug === 'company-info')"/>
            <IntervalsSetting :setting="$page.props?.settings.find(setting => setting.slug === 'intervals')"/>
        </GridSection>
    </FullLayout>

</template>
