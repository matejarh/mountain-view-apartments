<script setup>
import Checkbox from '@/Components/Checkbox.vue';

defineProps({
    headers: Array,
})

defineEmits(['checkAll'])

</script>

<template>
    <th scope="col" class="p-4">
        <div class="flex items-center">
            <Checkbox id="checkbox-all" @update:checked="$emit('checkAll')" />
            <label for="checkbox-all" class="sr-only">{{ __('checkbox') }}</label>
        </div>
    </th>
    <th v-for="header in headers" :key="header" scope="col" class="px-6 py-3 whitespace-nowrap">
        {{ __(header) }}
    </th>
</template>
