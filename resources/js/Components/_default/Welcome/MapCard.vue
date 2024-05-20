<script setup>
import "leaflet/dist/leaflet.css";
import { LMap, LTileLayer, LMarker, LPopup, LPolygon, LControl, LIcon } from "@vue-leaflet/vue-leaflet";
import { ref, computed, watch } from 'vue';
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
    url: new URL('/resources/images/map-markers/marker-red.svg', import.meta.url).href
})
const propertyIcon = ref({
    size: [40,40],
    url: new URL('/resources/images/map-markers/marker-blue.svg', import.meta.url).href
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
        <l-map ref="map" :useGlobalLeaflet="false" v-model:zoom="zoom" :min-zoom="5" :max-zoom="20" v-model:bounds="bounds" @ready="ready = true" v-model:center="center">
            <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" layer-type="base"
                name="OpenStreetMap"></l-tile-layer>

            <l-marker :lat-lng="[property.coordinates.lat, property.coordinates.lng]" class="" v-for="property, key in $page.props.accomodations" :key="key">
                <l-icon :popup-anchor="[0, -30]" :icon-url="propertyIcon.url" :icon-size="propertyIcon.size" />
                <l-popup>
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
                <l-icon :popup-anchor="[0, -30]" class="drop-shadow-lg" :icon-url="$page.props.auth.user ? $page.props.auth.user.profile_photo_url : clientIcon.url" :icon-size="clientIcon.size" />
                <l-popup class="">
                    <div class="content py-2">
                        <div class="item-body  ">
                            <h3 class="font-bold text-base leading-tight">{{ __('You are here') }}</h3>
                        </div>
                    </div>
                </l-popup>

            </l-marker>

            <l-control class="leaflet-control top-5 bg-white dark:bg-gray-700 border-primary-700 rounded-lg p-[1em] text-lg" position="topright">
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
