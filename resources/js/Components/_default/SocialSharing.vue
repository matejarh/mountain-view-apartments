<script setup>
import Tooltip from './Tooltip.vue';
import { reactive } from 'vue';
import DinamicIcon from '../DinamicIcon.vue';
defineProps({
    // property: Object
})

const networks = reactive([
    { name: 'facebook', title:"Facebook", icon: 'FacebookIcon', },
    { name: 'messenger', title:"Facebook Messenger", icon: 'FbMessengerIcon', },
    { name: 'viber', title:"Viber", icon: 'ViberIcon', },
    { name: 'twitter', title:"X", icon: 'XIcon', },
    { name: 'whatsapp', title:"WhatsApp", icon: 'WhatsUpIcon', },
    { name: 'pinterest', title:"Pinterest", icon: 'PinterestIcon', },
    { name: 'tumblr', title:"Tumblr", icon: 'TumblrIcon', },
])

</script>

<template>
    <div class="grid grid-cols-3 gap-4 sm:grid-cols-4">
        <ShareNetwork v-for="network,key in networks" :key="key"
            class="text-gray-500 hover:text-gray-900 dark:hover:text-white mx-auto" :network="network.name"
            :url="route('properties.show', { property: $page.props.property, lang: $page.props.locale })"
            :title="$page.props.property?.title[$page.props.locale]"
            :description="$page.props?.property.description[$page.props.locale]"
            :quote="$page.props.property?.quote[$page.props.locale]"
            :hashtags="$page.props.property?.keywords[$page.props.locale]"
            :media="$page.props.property?.galleries[0]?.images[0].photo_url">

            <Tooltip :text="__('Share on ') + network.title" :key="'tooltip-' + key">
                <DinamicIcon class="w-20 h-20" :icon="network.icon" />
            </Tooltip>
        </ShareNetwork>
    </div>
</template>
