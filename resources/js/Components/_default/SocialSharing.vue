<script setup>
import Tooltip from './Tooltip.vue';
import { reactive, ref } from 'vue';
import DinamicIcon from '../DinamicIcon.vue';
import { useShareLink } from "vue3-social-sharing";

import { usePage, } from '@inertiajs/vue3';

defineProps({
    // property: Object
})

const page = usePage()

const networks = reactive([
    { name: 'facebook', title: "Facebook", icon: 'FacebookIcon', },
    { name: 'messenger', title: "Facebook Messenger", icon: 'FbMessengerIcon', },
    { name: 'viber', title: "Viber", icon: 'ViberIcon', },
    { name: 'twitter', title: "X", icon: 'XIcon', },
    { name: 'whatsapp', title: "WhatsApp", icon: 'WhatsUpIcon', },
    { name: 'pinterest', title: "Pinterest", icon: 'PinterestIcon', },
    { name: 'tumblr', title: "Tumblr", icon: 'TumblrIcon', },
])

const shareData = ref({
    title: page.props?.property?.title[page.props?.locale],
    description: page.props?.property.description[page.props?.locale],
    quote: page.props?.property?.quote[page.props?.locale],
    hashtags: page.props?.property?.keywords[page.props?.locale],
    media: page.props?.property?.galleries[0]?.images[0].photo_url,
})

const { shareLink } = useShareLink();
const share = (network, url) => {
    shareData.value.network = network
    shareData.value.url = url
    shareLink(shareData.value)
}

</script>

<template>
    <div class="grid grid-cols-3 gap-4 sm:grid-cols-4">
        <div class="" v-for="network, key in networks" :key="key">
            <button
                @click="share(network.name, route('properties.show', { property: $page.props?.property, lang: $page.props?.locale }))">
                <Tooltip :text="__('Share on ') + network.title" :key="'tooltip-' + key">
                    <DinamicIcon class="w-20 h-20" :icon="network.icon" />
                </Tooltip>
            </button>
        </div>
    </div>
</template>
