<script setup>
import { icons } from '@/icons'
defineProps({
    item: Object
})
</script>

<template>
    <div class="">
        <p class="md:whitespace-nowrap">
            {{ item?.owner.name }}
            {{ __('Logged in') }}
            {{ __('from') }}
            <b>
                {{ item?.agent.browser }}
            </b>
            {{ __('on') }}
            <b>
                {{ item?.agent.platform }}
            </b>
            {{ __('with') }}
            <b>
                <span class="flex items-center" v-if="item?.agent.is_desktop">
                    {{ __('Desktop computer') }}
                    <icons.DesktopIcon class="w-4 h-4 text-gray-500" />
                </span>
                <span class="flex items-center" v-else-if="item?.agent.is_mobile">
                    {{ __('Mobile device') }}
                    <icons.MobileIcon class="w-4 h-4 text-gray-500" />
                </span>
                <span class="flex items-center" v-else-if="item?.agent.is_tablet">
                    {{ __('Tablet device') }}
                    <icons.TabletIcon class="w-4 h-4 text-gray-500" />
                </span>
                <span class="flex items-center" v-else>
                    {{ __('Unknown device') }}
                    <icons.DesktopIcon class="w-4 h-4 text-gray-500" />
                </span>

            </b>

        </p>
    </div>
</template>
