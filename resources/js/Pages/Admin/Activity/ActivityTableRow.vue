<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import TableRow from '@/Components/TableRow.vue';
import Tooltip from '@/Components/_default/Tooltip.vue';
import { icons } from '@/icons';
import { ref } from 'vue';

const props = defineProps({
    activity: Object,
})

const checked = ref(false)
</script>

<template>
    <TableRow>
        <td class="w-4 p-4">
            <div class="flex items-center">
                <Checkbox v-model:checked="checked" :id="'checkbox_'+activity.id" :name="'checkbox_'+activity.id"/>
                <label :for="`checkbox-${activity.id}`" class="sr-only">{{ __('checkbox') }}</label>
            </div>
        </td>
        <td class=" p-4">{{ activity.created_at_diff_for_humans }}</td>
        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
            <img class="w-10 h-10 rounded-full" :src="activity.owner.profile_photo_url"
                :alt="activity.owner.name + 's image'">
            <div class="ps-3">
                <div class="text-base font-semibold">{{ activity.owner.name }}</div>
                <div class="font-normal text-gray-500 dark:text-gray-300">{{
                    activity.owner.email }}
                </div>
            </div>
        </th>
        <td class="px-6 py-4 whitespace-nowrap text-base">
            {{ __(activity.type) }}
        </td>
        <td class="flex items-center px-6 py-4 whitespace-nowrap ">
            <Tooltip text="Desktop" v-if="activity.agent.is_desktop">
                <icons.DesktopIcon class="w-10 h-10 z-0" />
            </Tooltip>
            <Tooltip text="Mobile" v-else-if="activity.agent.is_mobile">
                <icons.MobileIcon class="w-10 h-10 z-0" />
            </Tooltip>
            <Tooltip text="Tablet" v-else-if="activity.agent.is_tablet">
                <icons.TabletIcon class="w-10 h-10 z-0" />
            </Tooltip>
            <Tooltip text="Unknown" v-else>
                <icons.DesktopIcon class="w-10 h-10 z-0" />
            </Tooltip>
            <div class="ps-3">
                <div class="text-base">
                    {{ activity.agent.browser }}
                </div>

                <div class="font-normal text-gray-500 dark:text-gray-300">
                    {{ activity.agent.platform }}
                </div>

            </div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap" >
            {{ activity.location ? activity.location : __('No location') }}
        </td>
    </TableRow>
</template>
