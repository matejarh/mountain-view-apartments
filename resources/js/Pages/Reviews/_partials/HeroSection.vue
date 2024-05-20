<script setup>
import LikeButton from '@/Components/_default/Reviews/LikeButton.vue';
import RatingStars from '@/Components/_default/Properties/RatingStars.vue';
import { usePage } from '@inertiajs/vue3';
import { onBeforeUnmount, onMounted, ref } from 'vue';

defineEmits(['create'])

const page = usePage()
const bgImage = ref(new URL('/resources/images/backgrounds/winter-sunrise.jpg', import.meta.url))

const int = ref(page.props.settings.find(setting => setting.slug === 'intervals'))
const interval = ref(null)
const initBgImageRotation = () => {
    if (page.props.property?.galleries.length <= 0) {
        clearInterval(interval)
        return
    }
    //const gallery = _.filter(page.props.property?.galleries, ['name', page.props.property?.name])[0]
    //const gallery = page.props.property?.galleries.find('name', page.props.property?.name);
    const gallery = page.props.property?.galleries[0];

    bgImage.value = gallery.images[0].photo_url
    let current = 0

    interval.value = setInterval(() => {
        bgImage.value = gallery.images[current].photo_url

        if (current + 1 >= gallery.images.length) {
            current = 0
        } else {
            current++
        }
    }, int.value.attributes.hero_background_interval * 1000);
}

const handleInitialImage = () => {
    if (page.property?.galeries.length > 0) {
        if (page.property?.galeries[0].images.length > 0) {
            bgImage.value = new URL(page.props.property?.galleries[0].images[0].photo_url, import.meta.url)
        }
    }
}

onMounted(() => {
    handleInitialImage()
    initBgImageRotation()
})
onBeforeUnmount(() => {
    clearInterval(interval.value)
})
</script>

<template>


    <section :style="`background-image: url(${bgImage});`"
        class="bg-center bg-cover bg-no-repeat  bg-gray-700 bg-blend-multiply transition-all duration-[2000ms] ease-in-out bg-paralax">
        <div class="px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                <inertia-link
                    :href="route('properties.show', { lang: $page.props.locale, property: $page.props.property })">
                    {{ $page.props.property.title[$page.props.locale] }}
                </inertia-link>
            </h1>

            <div class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">
                {{ $page.props.property.quote[$page.props.locale] }}
            </div>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <RatingStars :property="$page.props.property" :size="'large'" :without-text="false" :on-dark="true" />

            </div>

            <div class="mt-8 flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <inertia-link
                    :href="route('reviews.create', { property: $page.props.property, lang: $page.props.locale })"
                    class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-0 focus:ring-primary-300 dark:focus:ring-primary-900">
                    Post Review
                    <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </inertia-link>
                <LikeButton :item="$page.props.property" />
                <a href="#"
                    class="inline-flex justify-center hover:text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center text-white rounded-lg border border-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-400">
                    Book
                </a>
            </div>
        </div>
    </section>

</template>
