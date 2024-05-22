<!-- NavItems.vue -->
<template>
    <template v-for="(item, index) in items" :key="index">
        <NavLink v-if="item.type === 'link' && item.condition !== false"
            :href="item.href" @click="$emit('hide')">
            <template #icon>
                <component :is="item.icon" />
            </template>
            {{ __(item.title) }}
        </NavLink>

        <NavDropdown v-if="item.type === 'dropdown' && item.condition !== false"
            :key="item.title" :active="item.active">
            <template #icon>
                <component :is="item.icon" />
            </template>
            <template #title>{{ __(item.title) }}</template>
            <template v-for="child in item.children">
                <DropdownItem :href="child.href" @click="$emit('hide')">{{ __(child.title) }}</DropdownItem>
            </template>
        </NavDropdown>
    </template>
</template>

<script setup>
import NavLink from '@/Components/SideNavigation/NavLink.vue';
import NavDropdown from '@/Components/SideNavigation/NavDropdown.vue';
import DropdownItem from '@/Components/SideNavigation/DropdownItem.vue';

const props = defineProps({
    items: Array,
});

defineEmits(['hide'])
</script>
