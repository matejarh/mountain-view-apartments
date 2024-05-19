<script setup>
import RatingStars from '../Properties/RatingStars.vue';

defineProps({
    review: Object,
})
</script>

<template>


    <article class="bg-gray-50 dark:bg-gray-900 rounded-lg mb-4 p-4 shadow-lg">
        <div class="flex items-center mb-4">
            <img class="w-10 h-10 me-4 rounded-full" :src="review.owner.profile_photo_url" alt="">
            <div class="font-medium dark:text-white">
                <p>{{ review.owner.name }} <time datetime="2014-08-16 19:00"
                        class="block text-sm text-gray-500 dark:text-gray-400">{{__('Joined on')}} {{ review.owner.joined_on }}</time></p>
            </div>
        </div>
        <RatingStars :property="$page.props.property" :score="review.score" :size="'small'" :without-text="true" :on-dark="true" />

        <footer class="mb-5 text-sm text-gray-500 dark:text-gray-400">
            <p>{{__('Reviewed')}} <!-- in the --> <!-- {{ review.activity }} --> <time :datetime="review.created_at">{{ review.created_at_human_readable }}</time></p>
        </footer>
        <div class="mb-2 text-gray-500 dark:text-gray-400" v-html="review.text">

        </div>

            <!-- <aside>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">19 people found this helpful</p>
                <div class="flex items-center mt-3">
                    <a href="#"
                        class="px-2 py-1.5 text-xs font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Helpful</a>
                    <a href="#"
                        class="ps-4 text-sm font-medium text-blue-600 hover:underline dark:text-blue-500 border-gray-200 ms-4 border-s md:mb-0 dark:border-gray-600">Report
                        abuse</a>
                </div>
            </aside> -->
    </article>

</template>
