<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { usePage } from '@inertiajs/vue3';
import LikeButton from '@/Components/_default/Reviews/LikeButton.vue';
import RatingStars from '@/Components/_default/Properties/RatingStars.vue';
import HeroTitle from '@/Components/_default/HeroTitle.vue';
import TransparentButton from '@/Components/_default/TransparentButton.vue';
import { icons } from '@/icons';

const page = usePage();
const defaultBackgroundImage = new URL('/resources/images/backgrounds/winter-sunrise.jpg', import.meta.url);
const backgroundImage = ref(defaultBackgroundImage);
const interval = ref(null);

const initBgImageRotation = () => {
    const gallery = page.props?.property?.galleries?.[0];
    if (!gallery || gallery.images.length <= 0) {
        clearInterval(interval.value);
        return;
    }

    let current = 0;
    const image = new Image();

    const setImage = (index) => {
        image.src = gallery.images[index].photo_url;
        image.onload = () => {
            backgroundImage.value = gallery.images[index].photo_url;
        };
    };

    setImage(current);

    interval.value = setInterval(() => {
        current = (current + 1) % gallery.images.length;
        setImage(current);
    }, page.props?.settings?.find(setting => setting.slug === 'intervals')?.attributes?.hero_background_interval * 1000 || 5000);
};

const handleInitialImage = () => {
    const gallery = page.props?.property?.galleries?.[0];
    if (gallery?.images?.length > 0) {
        const image = new Image();
        image.src = gallery.images[0].photo_url;
        image.onload = () => {
            backgroundImage.value = gallery.images[0].photo_url;
        };
    }
};

onMounted(() => {
    handleInitialImage();
    initBgImageRotation();
});

onBeforeUnmount(() => {
    clearInterval(interval.value);
});
</script>

<template>
    <section :style="`background-image: url(${backgroundImage});`" class="bg-center bg-cover bg-no-repeat bg-gray-700 bg-blend-multiply transition-all duration-[2000ms] ease-in-out bg-paralax">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
            <HeroTitle>
                <inertia-link :href="route('properties.show', { lang: $page.props?.locale, property: $page.props?.property })">
                    {{ $page.props?.property.title[$page.props?.locale] }}
                </inertia-link>
            </HeroTitle>

            <div class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">
                {{ $page.props?.property.quote[$page.props?.locale] }}
            </div>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <RatingStars :property="$page.props?.property" :size="'large'" :without-text="false" :on-dark="true" />
            </div>

            <div class="mt-8 flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <TransparentButton type="button" @click="$inertia.get(route('reviews.create', { property: $page.props?.property, lang: $page.props?.locale }))">
                    {{ __('Post Review') }}
                    <icons.PenNibIcon class="w-3.5 h-3.5 ms-2 rtl:rotate-180" />
                </TransparentButton>

                <LikeButton :item="$page.props?.property" />

                <TransparentButton type="button" @click="$inertia.get(route('reservations.create', $page.props.locale))">
                    {{ __('Book Now') }}
                    <icons.CalendarIcon class="w-3.5 h-3.5 ms-2 rtl:rotate-180" />
                </TransparentButton>
            </div>
        </div>
    </section>
</template>
