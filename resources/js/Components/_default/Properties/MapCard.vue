<script setup>
import "leaflet/dist/leaflet.css";
import { LMap, LTileLayer, LMarker, LPopup, LPolygon, LControl } from "@vue-leaflet/vue-leaflet";
import { ref, computed, onMounted } from 'vue';
import MapLocationIcon from "@/Icons/MapLocationIcon.vue";
import Tooltip from "../Tooltip.vue";
import { useClientStore } from "@/stores/client";
import { latLngBounds } from "leaflet";

const props = defineProps({
    property: Object
})

const client = useClientStore()

const propertyCoordinates = computed(() => {
    return [props.property.coordinates.lat, props.property.coordinates.lng]
    //return [46.618689, 13.3809776]
})

const clientCoordinates = computed(() => {
    return [client.location.coords?.latitude, client.location.coords?.longitude]
})



const zoom = ref(9);
const bounds = ref(latLngBounds(propertyCoordinates,));

onMounted(() => {

})
</script>

<template>
    <div class="w-full  z-0">
        <l-map class="z-0 rounded-lg p-10" :useGlobalLeaflet="false" ref="map" v-model="zoom" v-model:zoom="zoom"  :center="propertyCoordinates">
                <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" layer-type="base"
                    name="OpenStreetMap" />
            <l-marker :lat-lng="propertyCoordinates" class="">
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
                <l-popup class="">
                    <div class="content py-2">
                        <div class="item-body  ">
                            <h3 class="font-bold text-base leading-tight">{{ __('You are here') }}</h3>
                        </div>
                    </div>
                </l-popup>

            </l-marker>

            <l-control class="leaflet-control bottom-10 bg-white dark:bg-gray-700 border-primary-600 rounded-lg p-[1em] text-lg" position="bottomleft">
                <a :href="property.google_maps_link" target="_blank" class="dark:text-gray-100">
                    <Tooltip :text="__('Get Travel Directions')" key="map_directions" placement="top">
                        <div class="flex items-center">
                            <MapLocationIcon class="w-8 h-5" />
                            {{ __('Get Travel Directions') }}

                        </div>
                    </Tooltip>
                </a>
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
