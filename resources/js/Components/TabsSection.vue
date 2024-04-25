<template>
    <div class="md:flex">
        <ul
            class="flex-column space-y space-y-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:me-4 mb-4 md:mb-0 md:w-1/4">
            <slot name="buttons" />

        </ul>
        <div class="p-6 bg-gray-50 text-medium text-gray-500 dark:text-gray-400 dark:bg-gray-800 rounded-lg w-full">
            <slot name="content" />
        </div>

    </div>
</template>
