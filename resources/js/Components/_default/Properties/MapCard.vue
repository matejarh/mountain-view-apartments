<script setup>
import "leaflet/dist/leaflet.css";
import "/resources/css/map.css"
import { LMap, LTileLayer, LMarker, LPopup, LControl, LIcon } from "@vue-leaflet/vue-leaflet";
import { ref, computed, watchEffect } from 'vue';
import Tooltip from "@/Components/_default/Tooltip.vue";
import { useClientStore } from "@/stores/client";
import { usePage } from "@inertiajs/vue3";
import { useHelperStore } from "@/stores/helpers";
import { icons } from "@/icons";

const props = defineProps({
    property: Object
})

const helpers = useHelperStore()

const client = useClientStore()
const page = usePage()

const zoom = ref(2)
const center = ref([0, 0])
const bounds = ref([])
const ready = ref(false)

const clientIcon = ref({
    size: [40, 40],
    url: new URL('/resources/images/map-markers/marker-red.svg', import.meta.url).href
})
const propertyIcon = ref({
    size: [40, 40],
    url: new URL('/resources/images/map-markers/marker-blue.svg', import.meta.url).href
})

watchEffect(() => {
    if (ready.value) {
        resetBounds()
    }
})

const propertiesCoordinates = () => {
    let bounds = []

    bounds.push([parseFloat(page.props?.property.coordinates.lat), parseFloat(page.props?.property.coordinates.lng)])

    if (clientCoordinates) {
        bounds.push([client.location.coords?.latitude, client.location.coords?.longitude])
    }

    return bounds
}

const clientCoordinates = computed(() => {
    return [client.location.coords?.latitude, client.location.coords?.longitude]
})

const resetBounds = () => {
    bounds.value = propertiesCoordinates()
    helpers.delay(500).then(() => zoom.value -= 1)

}

</script>

<template>
    <div class=" z-0">
        <l-map ref="map" :useGlobalLeaflet="false" v-model:zoom="zoom" :min-zoom="5" :max-zoom="20"
            v-model:bounds="bounds" @ready="ready = true" v-model:center="center">
            <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" layer-type="base"
                name="OpenStreetMap"></l-tile-layer>

            <l-marker :lat-lng="[page.props?.property.coordinates.lat, page.props?.property.coordinates.lng]" class="">
                <l-icon :popup-anchor="[0, -30]" :icon-url="propertyIcon.url" :icon-size="propertyIcon.size" />
                <l-popup class="">
                    <div class="content py-2">
                        <img v-if="page.props?.property.galleries.length > 0"
                            :src="page.props?.property.galleries[0].images[0].thumb_url"
                            class="rounded w-24 h-16 float-left pr-2" />
                        <div class="item-body  ">
                            <h3 class="font-bold text-base leading-tight">{{
                                page.props?.property.title[$page.props?.locale] }}</h3>
                            {{ page.props?.property.seo_description[$page.props?.locale] }}
                        </div>
                    </div>
                </l-popup>
            </l-marker>

            <l-marker v-if="client.location" :lat-lng="clientCoordinates" class="">
                <l-icon :popup-anchor="[0, -30]"
                    :icon-url="$page.props?.auth.user ? $page.props?.auth.user.profile_photo_url : clientIcon.url"
                    :icon-size="clientIcon.size" />
                <l-popup class="">
                    <div class="content py-2">
                        <div class="item-body  ">
                            <h3 class="font-bold text-base leading-tight">{{ __('You are here') }}</h3>
                        </div>
                    </div>
                </l-popup>
            </l-marker>

            <l-control
                class="leaflet-control top-5 bg-white dark:bg-gray-700 border-primary-600 rounded-lg p-[1em] text-lg flex"
                position="topright">
                <button @click="resetBounds">
                    <Tooltip :text="__('Reset map')">
                        <icons.CompressIcon class="w-6 h-6" />
                        <!-- {{ __('Reset map') }} -->
                    </Tooltip>
                </button>
            </l-control>
            <l-control
                class="leaflet-control bottom-10 bg-white dark:bg-gray-700 border-primary-600 rounded-lg p-[1em] text-lg"
                position="bottomleft">
                <a :href="property.google_maps_link" target="_blank" class="dark:text-gray-100">
                    <Tooltip :text="__('Get Travel Directions')" key="map_directions" placement="top">
                        <div class="flex items-center">
                            <icons.MapLocationIcon class="w-8 h-5" />
                            {{ __('Get Travel Directions') }}

                        </div>
                    </Tooltip>
                </a>
            </l-control>
        </l-map>

    </div>
</template>
