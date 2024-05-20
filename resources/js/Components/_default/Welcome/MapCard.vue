<script setup>
import "leaflet/dist/leaflet.css";
import { LMap, LTileLayer, LMarker, LPopup, LPolygon, LControl, LIcon } from "@vue-leaflet/vue-leaflet";
import { ref, computed, onMounted, onBeforeMount, watch } from 'vue';
import MapLocationIcon from "@/Icons/MapLocationIcon.vue";
import Tooltip from "../Tooltip.vue";
import { useClientStore } from "@/stores/client";
import { usePage } from "@inertiajs/vue3";

const props = defineProps({
    properties: Array
})

const client = useClientStore()
const page = usePage()

const zoom = ref(2)
const center = ref([0, 0])
const bounds = ref([])
const ready = ref(false)

const clientIcon = ref({
    size: [40,40],
    url: new URL('/resources/images/map-markers/map-marker-green.png', import.meta.url).href
})
const propertyIcon = ref({
    size: [40,40],
    url: new URL('/resources/images/map-markers/map-marker-red.png', import.meta.url).href
})

watch(ready, () => {
    if (ready.value) {
        bounds.value = propertiesCoordinates()
        zoom.value = 10
    }
})

const propertiesCoordinates = () => {
    let bounds = []
    page.props.accomodations?.forEach(property => {
        bounds.push([parseFloat(property.coordinates.lat), parseFloat(property.coordinates.lng)])
    });
    bounds.push([client.location.coords?.latitude, client.location.coords?.longitude])

    return bounds
}

const clientCoordinates = computed(() => {
    return [client.location.coords?.latitude, client.location.coords?.longitude]
})

const resetBounds = () => {
    bounds.value = propertiesCoordinates()
}
const showBled = () => {
    bounds.value = [[parseFloat(page.props.properties.find(property => property.name === 'Apartment Two Angels')[0].coordinates.lat), parseFloat(page.props.properties.find(property => property.name === 'Apartment Two Angels')[0].coordinates.lng)]]
}

</script>

<template>
    <div class="w-full  ">
<!--         <div class="float-right flex">
            <button class="bg-primary-700 text-white p-4 " @click="resetBounds">reset bounds</button>
            <button class="bg-primary-700 text-white p-4 " @click="showBled">Bled</button>
        </div> -->
        <l-map ref="map" :useGlobalLeaflet="false" v-model:zoom="zoom" :min-zoom="5" :max-zoom="20" v-model:bounds="bounds" @ready="ready = true" v-model:center="center">
            <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" layer-type="base"
                name="OpenStreetMap"></l-tile-layer>

            <l-marker :lat-lng="[property.coordinates.lat, property.coordinates.lng]" class="" v-for="property, key in $page.props.accomodations" :key="key">
                <l-icon :icon-url="propertyIcon.url" :icon-size="propertyIcon.size" />
                <l-popup class="">
                    <div class="content py-2">
                        <img v-if="property.galleries.length>0" :src="property.galleries[0].images[0].thumb_url" class="w-24 h-16 float-left pr-2" />
                        <div class="item-body  ">
                            <h3 class="font-bold text-base leading-tight">{{ property.title[$page.props.locale] }}</h3>
                            {{ property.seo_description[$page.props.locale] }}
                        </div>
                    </div>
                </l-popup>
            </l-marker>

            <l-marker v-if="client.location" :lat-lng="clientCoordinates" class="">
                <l-icon :icon-url="clientIcon.url" :icon-size="clientIcon.size" />
                <l-popup class="">
                    <div class="content py-2">
                        <div class="item-body  ">
                            <h3 class="font-bold text-base leading-tight">{{ __('You are here') }}</h3>
                        </div>
                    </div>
                </l-popup>

            </l-marker>

            <l-control class="leaflet-control top-5 bg-white dark:bg-gray-700 border-primary-600 rounded-lg p-[1em] text-lg" position="topright">
                <button @click="resetBounds">{{ __('Reset map') }}</button>
            </l-control>
        </l-map>

    </div>
</template>

<style>
.leaflet-control-attribution {
    display: none;
}

.leaflet-top {
    top: 24px;
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
