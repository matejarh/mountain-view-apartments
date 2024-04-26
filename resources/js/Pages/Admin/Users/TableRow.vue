<script setup>
import { hasFlag } from 'country-flag-icons';
import { getCode, getName } from 'country-list';
import { computed } from 'vue';

const props = defineProps({
    user: Object,
})

const countryFlag = computed(() => {
        if(hasFlag(props.user.country) === true) {

            return new URL(`/resources/images/flags/4x3/${props.user.country.toLowerCase()}.svg`, import.meta.url)
        }

        return '#'

    //return loadFlag()

})

/* const loadFlag = () => {
    let flag
    import(`country-flag-icons/string/3x2/US`).then(flag => {
        flag = flag
    });
    return flag;
} */
</script>

<template>
    <tr class="transition-colors ease-out duration-150 bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600
    odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 ">
        <td class="w-4 p-4">
            <div class="flex items-center">
                <input :id="`checkbox-${user.id}`" type="checkbox"
                    class="w-4 h-4 text-primary-600 bg-gray-100 border-gray-300 rounded focus:ring-primary-600 dark:focus:ring-primary-700 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                <label :for="`checkbox-${user.id}`" class="sr-only">{{ __('checkbox') }}</label>
            </div>
        </td>
        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
            <img class="w-10 h-10 rounded-full" :src="user.profile_photo_url" :alt="user.name + 's image'">
            <div class="ps-3">
                <div class="text-base font-semibold">{{ user.name }}</div>
                <div class="font-normal text-gray-500 dark:text-gray-300">{{ user.email }}</div>
            </div>
        </th>
        <td class="px-6 py-4">
            {{ user.phone }}
        </td>
        <td class="px-6 py-4">
            <div class="" v-html="user.address ? user.address.replace('\\n', '<br>').replace('\\n', ' ') : ''"></div>

        </td>
        <td class="px-6 py-4">
            <div class="flex items-center ">

                <img class="w-auto h-5 rounded" :src="countryFlag" :alt="getName(user.country) + 's flag'">
                <div class="ps-3">
                    <!-- <div class="text-base font-semibold">{{ getName(user.country) }}</div> -->
                    <div class="font-normal ">{{ getName(user.country) }}</div>
                </div>
            </div>

        </td>
        <td class="px-6 py-4">
            <div class="flex items-center" v-if="user.has_sessions">
                <div class="h-2.5 w-2.5 rounded-full bg-amazon-400 me-2"></div> Recently active
            </div>
            <div class="flex items-center" v-else>
                <div class="h-2.5 w-2.5 rounded-full bg-bittersweet-400 me-2"></div> Inactive
            </div>
        </td>
        <td class="px-6 py-4">
            <a href="#" class="font-medium text-primary-600 dark:text-primary-700 hover:underline">{{ __('Edit user')}}</a>
        </td>
    </tr>
</template>
