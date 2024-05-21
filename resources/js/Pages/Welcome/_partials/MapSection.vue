<script setup>
import ShapeTop from '@/Components/_default/ShapeTop.vue';
import ShapedSection from '@/Components/_default/ShapedSection.vue';
import MapCard from '@/Components/_default/Welcome/MapCard.vue';


</script>

<template>
    <section :class="`relative antialiased`">
        <MapCard :property="$page.props?.property" class="h-[30rem] z-0 block"/>
        <ShapeTop
            :class="`absolute inset-y-full z-10 left-0 right-0 w-full block bottom-1/2 text-white dark:text-gray-900`" />

    </section>

</template>
