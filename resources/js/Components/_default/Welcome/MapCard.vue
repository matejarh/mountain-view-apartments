<script setup>
import "leaflet/dist/leaflet.css";
import "/resources/css/map.css"
import { LMap, LTileLayer, LMarker, LPopup, LControl, LIcon } from "@vue-leaflet/vue-leaflet";
import { ref, computed, watchEffect } from 'vue';
import { useClientStore } from "@/stores/client";
import { usePage } from "@inertiajs/vue3";
import { useHelperStore } from "@/stores/helpers";
import CompressIcon from "@/Icons/CompressIcon.vue";
import Tooltip from "../Tooltip.vue";

const props = defineProps({
    properties: Array
})

const client = useClientStore()
const page = usePage()
const helpers = useHelperStore()

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

const groupedByCoordinates = computed(() => {
    const grouped = {};

    page.props?.accomodations?.forEach(property => {
        const lat = parseFloat(property.coordinates.lat).toFixed(6);
        const lng = parseFloat(property.coordinates.lng).toFixed(6);
        const key = `${lat},${lng}`;

        if (!grouped[key]) {
            grouped[key] = [];
        }

        grouped[key].push(property);
    });

    return grouped;
});

const propertiesCoordinates = () => {
    let bounds = []
    /* page.props?.accomodations?.forEach(property => {
        bounds.push([parseFloat(property.coordinates.lat), parseFloat(property.coordinates.lng)])
    }); */
    Object.keys(groupedByCoordinates.value).forEach(coordinate => {
        const [lat, lng] = coordinate.split(',').map(parseFloat);
        bounds.push([lat, lng]);
    });
    if (client.location) {
        bounds.push(clientCoordinates)
    }

    return bounds
}

const clientCoordinates = computed(() => {
    return [client.location?.coords.latitude, client.location?.coords.longitude]
})

const resetBounds = () => {
    bounds.value = propertiesCoordinates()
    helpers.delay(500).then(() => zoom.value -= 1)
}
const showBled = () => {
    bounds.value = [[parseFloat(page.props?.properties.find(property => property.name === 'Apartment Two Angels')[0].coordinates.lat), parseFloat(page.props?.properties.find(property => property.name === 'Apartment Two Angels')[0].coordinates.lng)]]
}

</script>

<template>
    <div class="w-full  ">
        <l-map ref="map" :useGlobalLeaflet="false" v-model:zoom="zoom" :min-zoom="5" :max-zoom="20"
            v-model:bounds="bounds" @ready="ready = true" v-model:center="center">
            <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" layer-type="base"
                name="OpenStreetMap"></l-tile-layer>

            <l-marker :lat-lng="[key.split(',').map(parseFloat)[0], key.split(',').map(parseFloat)[1]]" class=""
                v-for="properties, key in groupedByCoordinates" :key="key">
                <l-icon :popup-anchor="[0, -30]" :icon-url="propertyIcon.url" :icon-size="propertyIcon.size" />
                <l-popup>
                    <div class="content">


                        <div :class="{ 'border-t': key !== 0 }" class="property-card py-2"
                            v-for="property, key in properties" :key="property.id">
                            <inertia-link
                                :href="route('properties.show', { property: property, lang: $page.props?.locale })">
                                <img v-if="property.galleries.length > 0"
                                    :src="property.galleries[0].images[0].thumb_url"
                                    class="rounded w-24 h-16 float-left pr-2" />
                                <div class="item-body text-gray-600 dark:text-gray-400">
                                    <h3 class="font-bold text-base leading-tight text-gray-900 dark:text-gray-200">
                                        {{ property.title[$page.props?.locale] }}
                                    </h3>
                                    {{ property.seo_description[$page.props?.locale] }}
                                </div>
                            </inertia-link>

                        </div>
                    </div>
                </l-popup>
            </l-marker>

            <l-marker v-if="client.location" :lat-lng="clientCoordinates" class="">
                <l-icon :popup-anchor="[0, -30]" class="drop-shadow-lg"
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
                class="leaflet-control top-5 bg-white dark:bg-gray-700 border-primary-700 rounded-lg p-[1em] text-lg flex"
                position="topright">

                <button @click="resetBounds">
                    <Tooltip :text="__('Reset map')">
                        <CompressIcon class="w-6 h-6" />
                        <!-- {{ __('Reset map') }} -->
                    </Tooltip>
                </button>
            </l-control>
        </l-map>

    </div>
</template>

