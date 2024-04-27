<script setup>
import Paginator from './Paginator.vue';

defineProps({
/*     links: {
        default: null,
        type: null|String,
    } */
})
</script>

<template>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg ">
        <div
            class="flex items-center justify-between flex-column flex-wrap md:flex-row space-y-4 md:space-y-0 p-4 pb-4 bg-white dark:bg-gray-800">
            <slot name="header" />
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-200">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-200">
                <tr>
                    <slot name="tablehead" />
                </tr>
            </thead>
            <tbody>
                <slot />
            </tbody>
        </table>
        <!-- <div class="" v-html="$page.props.links" v-if="$page.props.links" ></div> -->
        <Paginator :paginator="$page.props.users" />
    </div>
</template>
