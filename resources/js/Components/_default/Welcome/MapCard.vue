<script setup>
import "leaflet/dist/leaflet.css";
import "/resources/css/map.css";
import { LMap, LTileLayer, LMarker, LPopup, LControl, LIcon } from "@vue-leaflet/vue-leaflet";
import { ref, computed, watch } from 'vue';
import { useClientStore } from "@/stores/client";
import { usePage } from "@inertiajs/vue3";
import { useHelperStore } from "@/stores/helpers";
import CompressIcon from "@/Icons/CompressIcon.vue";
import Tooltip from "../Tooltip.vue";
import { debounce } from "lodash";

const props = defineProps({
    properties: Array
});

const client = useClientStore();
const page = usePage();
const helpers = useHelperStore();

const zoom = ref(2);
const center = ref([0, 0]);
const bounds = ref([]);
const ready = ref(false);
const errorMessage = ref('');

const clientIcon = ref({
    size: [40, 40],
    url: new URL('/resources/images/map-markers/marker-red.svg', import.meta.url).href
});
const propertyIcon = ref({
    size: [40, 40],
    url: new URL('/resources/images/map-markers/marker-blue.svg', import.meta.url).href
});


// Watch for ready changes and trigger bounds reset
watch(ready, (newVal) => {
    if (newVal) resetBoundsDebounced();
}, { immediate: true });

watch(client, (newVal) => {
    if (newVal && ready.value) resetBoundsDebounced();
}, { immediate: true });

// Function to handle errors
const handleError = (error, message) => {
    console.error(message, error);
    errorMessage.value = `${message}. Please try again or contact support.`;
};

const groupedByCoordinates = computed(() => {
    try {
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
    } catch (error) {
        handleError(error, 'Failed to group coordinates');
    }
});

const propertiesCoordinates = () => {
    try {
        const bounds = [];

        Object.keys(groupedByCoordinates.value).forEach(coordinate => {
            const [lat, lng] = coordinate.split(',').map(parseFloat);
            bounds.push([lat, lng]);
        });

        if (client.location?.coords) {
            bounds.push(clientCoordinates.value);
        }

        return bounds;
    } catch (error) {
        handleError(error, 'Failed to get property coordinates');
    }
};

const clientCoordinates = computed(() => {
    if (client.location?.coords) {
        return [client.location.coords.latitude, client.location.coords.longitude];
    }
    return null;
});

const setReady = () => {
    helpers.delay(500).then(() => {
        ready.value = true;
    });
}
const resetBoundsDebounced = debounce(() => {
    bounds.value = propertiesCoordinates();
    helpers.delay(500).then(() => {
        zoom.value -= 1;
    });
}, 500)

/* const resetBounds = () => {
    bounds.value = propertiesCoordinates();
    helpers.delay(500).then(() => {
        zoom.value -= 1;
    });
};
 */
const options = ref({
    dragging: false,
    zoomControl: true,
    boxZoom: false,
    scrollWheelZoom: false
});
</script>

<template>
    <div class="w-full">
        <l-map ref="map" :options="options" :useGlobalLeaflet="false" v-model:zoom="zoom" :min-zoom="5" :max-zoom="20"
            v-model:bounds="bounds" @ready="setReady" v-model:center="center">
            <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" layer-type="base"
                name="OpenStreetMap"></l-tile-layer>

            <!-- Property Markers -->
            <l-marker v-for="(properties, key) in groupedByCoordinates" :key="key"
                :lat-lng="key.split(',').map(parseFloat)">
                <l-icon :popup-anchor="[0, -30]" :icon-url="propertyIcon.url" :icon-size="propertyIcon.size" />
                <l-popup>
                    <div class="content">
                        <div v-for="(property, index) in properties" :key="property.id"
                            :class="{ 'border-t': index !== 0 }" class="property-card py-2">
                            <inertia-link
                                :href="route('properties.show', { property: property, lang: $page.props?.locale })">
                                <!-- <img v-if="property.galleries.length > 0"
                                    :src="property.galleries[0].images[0].thumb_url"
                                    class="rounded w-24 h-16 float-left pr-2" /> -->
                                <div class="item-body text-gray-600 dark:text-gray-400">
                                    <h3 class="font-bold text-base leading-tight text-gray-900 dark:text-gray-200">
                                        {{ property.title[$page.props?.locale] }}
                                    </h3>

                                </div>
                            </inertia-link>
                        </div>
                    </div>
                </l-popup>
            </l-marker>

            <!-- Client Marker -->
            <!-- <l-marker v-if="clientCoordinates" :lat-lng="clientCoordinates" class="">
                <l-icon :popup-anchor="[0, -30]" class="drop-shadow-lg"
                    :icon-url="$page.props?.auth.user ? $page.props?.auth.user.profile_photo_url : clientIcon.url"
                    :icon-size="clientIcon.size" />
                <l-popup class="">
                    <div class="content py-2">
                        <div class="item-body">
                            <h3 class="font-bold text-base leading-tight">{{ __('You are here') }}</h3>
                        </div>
                    </div>
                </l-popup>
            </l-marker> -->

            <!-- Controls -->
            <l-control
                class="leaflet-control top-5 bg-white dark:bg-gray-700 border-primary-700 rounded-lg p-[1em] text-lg flex"
                position="topright">
                <button @click="resetBoundsDebounced">
                    <Tooltip :text="__('Reset map')">
                        <CompressIcon class="w-6 h-6" />
                    </Tooltip>
                </button>
            </l-control>
        </l-map>
        <div v-if="errorMessage" class="alert alert-danger mt-4">
            {{ errorMessage }}
        </div>
    </div>
</template>
