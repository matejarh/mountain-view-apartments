<script setup>
import "leaflet/dist/leaflet.css";
import { LMap, LTileLayer, LMarker, LPopup, LPolygon, LControl } from "@vue-leaflet/vue-leaflet";
import { ref, computed } from 'vue';

const props = defineProps({
    //property: Object
})

const coordinates = computed(() => {
    //return [props.property.coordinates.lat, props.property.coordinates.lng]
    return [46.618689, 13.3809776]
})

const zoom = ref(14);

</script>

<template>
    <div class="w-full h-96 z-0">
        <l-map class="rounded-lg" :useGlobalLeaflet="false" ref="map" v-model:zoom="zoom" :center="coordinates">
                <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" layer-type="base"
                    name="OpenStreetMap" />
            <l-marker :lat-lng="coordinates" class="">
                <l-popup class="">
                    <div class="content py-2">
                        <!-- <img :src="property.galleries[0].images[0].thumb_url" class="w-24 h-16 float-left pr-2" /> -->
                        <div class="item-body  ">
                            <h3 class="font-bold text-base leading-tight">Test naslov</h3>
                            <p>test opis </p>
                        </div>
                    </div>
                </l-popup>

            </l-marker>

            <l-control class="leaflet-control bg-white dark:bg-gray-700 border-primary-600 rounded-lg p-[1em] text-lg italic" position="bottomleft">test</l-control>
        </l-map>
    </div>
</template>

<style >
.leaflet-control-attribution {
    display: none;
}
</style>
