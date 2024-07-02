<script setup>
import MapCard from '@/Components/_default/Properties/MapCard.vue';
import ShapedSection from '@/Components/_default/ShapedSection.vue';


</script>

<template>
   <section :class="`relative antialiased`">

        <div class="">
            <MapCard :property="$page.props?.property" class="h-[100vh] xl:h-[50vh]" />
        </div>

    </section>

</template>
