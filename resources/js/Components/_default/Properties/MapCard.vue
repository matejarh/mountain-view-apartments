<script setup>
import "leaflet/dist/leaflet.css";
import "/resources/css/map.css";
import { LMap, LTileLayer, LMarker, LPopup, LControl, LIcon } from "@vue-leaflet/vue-leaflet";
import { ref, computed, watch, onMounted } from 'vue';
import Tooltip from "@/Components/_default/Tooltip.vue";
import { useClientStore } from "@/stores/client";
import { usePage } from "@inertiajs/vue3";
import { useHelperStore } from "@/stores/helpers";
import { icons } from "@/icons";
import debounce from 'lodash/debounce';

const props = defineProps({
    property: Object
});

const helpers = useHelperStore();
const client = useClientStore();
const page = usePage();

const zoom = ref(3);
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

const clientCoordinates = computed(() => {
    try {
        if (client.location && client.location.coords) {
            const { latitude, longitude } = client.location.coords;
            return [latitude, longitude];
        }
        return null;
    } catch (error) {
        handleError(error, 'Failed to compute client coordinates');
        return null;
    }
});

// Function to handle errors
const handleError = (error, message) => {
    console.error(message, error);
    errorMessage.value = `${message}. Please try again or contact support.`;
};

// Debounced function to reset bounds
const resetBoundsDebounced = debounce(() => {
    try {
        const boundsList = [];
        if (page.props?.property.coordinates) {
            const { lat, lng } = page.props.property.coordinates;
            boundsList.push([parseFloat(lat), parseFloat(lng)]);
        }
        if (clientCoordinates.value) {
            boundsList.push(clientCoordinates.value);
        }
        bounds.value = boundsList;
        helpers.delay(500).then(() => {
            zoom.value -= 2;
        });
    } catch (error) {
        handleError(error, 'Failed to reset bounds');
    }
}, 500); // Adjust debounce delay as needed

const setReady = () => {
    helpers.delay(500).then(() => {
        ready.value = true;
    });
}

// Watch for ready changes and trigger bounds reset
watch(ready, (newVal) => {
    if (newVal) resetBoundsDebounced();
}, { immediate: true });

watch(client, (newVal) => {
    if (newVal && ready.value) resetBoundsDebounced();
}, { immediate: true });

const options = ref({
    dragging: false,
    zoomControl: true,
    boxZoom: false,
    scrollWheelZoom: false
});

// On mount, ensure property coordinates are available
onMounted(() => {
    try {
        if (!page.props?.property.coordinates) {
            throw new Error('Property coordinates are not available.');
        }
    } catch (error) {
        handleError(error, 'Failed to initialize map');
    }
});
</script>

<template>
    <div class="z-0">
        <l-map ref="map" :options="options" :useGlobalLeaflet="false" v-model:zoom="zoom" :min-zoom="6" :max-zoom="20"
            v-model:bounds="bounds" @ready="setReady" v-model:center="center">
            <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" layer-type="base"
                name="OpenStreetMap"></l-tile-layer>

            <!-- Property Marker -->
            <l-marker :key="`property_marker_${page.props.property.slug}`" v-if="page.props?.property.coordinates"
                :lat-lng="[parseFloat(page.props.property.coordinates.lat), parseFloat(page.props.property.coordinates.lng)]">
                <l-icon :popup-anchor="[0, -30]" :icon-url="propertyIcon.url" :icon-size="propertyIcon.size" />
                <l-popup>
                    <div class="content py-2">
                        <img v-if="page.props?.property.galleries.length > 0"
                            :src="page.props.property.galleries[0].images[0].thumb_url"
                            class="rounded w-24 h-16 float-left pr-2" />
                        <div class="item-body">
                            <h3 class="font-bold text-base leading-tight">
                                {{ page.props.property.title[$page.props?.locale] }}
                            </h3>
                            {{ page.props.property.seo_description[$page.props?.locale] }}
                        </div>
                    </div>
                </l-popup>
            </l-marker>

            <!-- Client Marker -->
            <!-- <l-marker :key="`client_marker`" v-if="clientCoordinates" :lat-lng="clientCoordinates">
                <l-icon
                    :popup-anchor="[0, -30]"
                    :icon-url="$page.props?.auth.user ? $page.props?.auth.user.profile_photo_url : clientIcon.url"
                    :icon-size="clientIcon.size"
                />
                <l-popup>
                    <div class="content py-2">
                        <div class="item-body">
                            <h3 class="font-bold text-base leading-tight">{{ __('You are here') }}</h3>
                        </div>
                    </div>
                </l-popup>
            </l-marker> -->

            <!-- Controls -->
            <l-control
                class="leaflet-control top-5 bg-white dark:bg-gray-700 border-primary-600 rounded-lg p-[1em] text-lg flex"
                position="topright">
                <button @click="resetBoundsDebounced">
                    <Tooltip :text="__('Reset map')">
                        <icons.CompressIcon class="w-6 h-6" />
                    </Tooltip>
                </button>
            </l-control>
            <l-control
                class="leaflet-control bottom-10 bg-white dark:bg-gray-700 border-primary-600 rounded-lg p-[1em] text-lg"
                position="bottomleft">
                <a :href="page.props?.property.google_maps_link" target="_blank" class="dark:text-gray-100">
                    <Tooltip :text="__('Get Travel Directions')" key="map_directions" placement="top">
                        <div class="flex items-center">
                            <icons.MapLocationIcon class="w-8 h-5" />
                            {{ __('Get Travel Directions') }}
                        </div>
                    </Tooltip>
                </a>
            </l-control>
        </l-map>

        <div v-if="errorMessage" class="alert alert-danger mt-4">
            {{ errorMessage }}
        </div>
    </div>
</template>
