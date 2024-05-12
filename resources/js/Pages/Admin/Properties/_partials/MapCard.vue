<script setup>
import "leaflet/dist/leaflet.css";
import { LMap, LTileLayer, LMarker, LPopup, LPolygon, LControl } from "@vue-leaflet/vue-leaflet";
import { ref, computed } from 'vue';

const props = defineProps({
    property: Object
})

const coordinates = computed(() => {
    return [props.property.coordinates.lat, props.property.coordinates.lng]
    //return [46.618689, 13.3809776]
})

const zoom = ref(14);


</script>

<template>
    <div class="w-full h-96 z-0">
        <!-- <l-map ref="map" :useGlobalLeaflet="false" v-model:zoom="zoom" :center="[41.8329, -87.7327]">
            <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" layer-type="base"
                name="OpenStreetMap"></l-tile-layer>

        </l-map> -->
        <l-map class="rounded-lg" :useGlobalLeaflet="false" ref="map" v-model:zoom="zoom" :center="coordinates">
            <!-- <l-tile-layer url="http://tile.stamen.com/watercolor/{z}/{x}/{y}.jpg" layer-type="base"
                name="Stamen Watercolor"
                attribution="Map tiles by <a href='http://stamen.com'>Stamen Design</a>, under <a href='http://creativecommons.org/licenses/by/3.0'>CC BY 3.0</a>. Data by <a href='http://openstreetmap.org'>OpenStreetMap</a>, under <a href='http://creativecommons.org/licenses/by-sa/3.0'>CC BY SA</a>." /> -->
                <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" layer-type="base"
                    name="OpenStreetMap" />
            <l-marker :lat-lng="coordinates" class="">
                <l-popup class="">
                    <div class="content py-2">
                        <img v-if="property.galleries.length>0" :src="property.galleries[0].images[0].thumb_url" class="w-24 h-16 float-left pr-2" />
                        <div class="item-body  ">
                            <h3 class="font-bold text-base leading-tight">{{ property.title[$page.props.locale] }}</h3>
                            {{ property.seo_description[$page.props.locale] }}
                        </div>
                    </div>
                    <!-- <div class="flex">
                        <div class="">

                            <img :src="property.galleries[0].images[0].thumb_url" class="w-full h-auto " />
                        </div>
                        <div class="w-full">
                            <h3 class="font-bold text-lg w-40">{{ property.name }}</h3>
                            <p>{{ property.description }}</p>

                        </div>
                    </div> -->
                </l-popup>

            </l-marker>
            <!-- <l-polygon :lat-lngs="[
                [property.coordinates.lat, property.coordinates.lng],
                [property.coordinates.lat - 0.1, property.coordinates.lng - 0.3]
                [property.coordinates.lat - 0.3, property.coordinates.lng - 0.2]
                [property.coordinates.lat, property.coordinates.lng]
            ]" color="#41b782" :fill="true" :fillOpacity="0.5" fillColor="#41b782">
                <l-popup> Hi! I'm a polygon, nice to meet you! </l-popup>
            </l-polygon> -->
            <l-control class="leaflet-control bg-white dark:bg-gray-700 border-primary-600 rounded-lg p-[1em] text-lg italic" position="bottomleft">{{ property.title[$page.props.locale] }}</l-control>
        </l-map>
    </div>
</template>

<style scoped>
.leaflet-control-attribution {
    display: none;
}
.leaflet-demo-control {
  background: white;
  border: 1px solid steelblue;
  border-radius: 0.6em;
  padding: 1em;
  font-size: large;
  font-style: italic;
}
</style>
