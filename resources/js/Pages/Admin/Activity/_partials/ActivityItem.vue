<script setup>
import { usePage } from '@inertiajs/vue3'
import { convertToPascalCase } from '@/utils/strings'
import CreatedLogout from '@/Components/Activities/CreatedLogout.vue';
import UpdatedUser from '@/Components/Activities/UpdatedUser.vue';
import UpdatedProperty from '@/Components/Activities/UpdatedProperty.vue';
import UpdatedImage from '@/Components/Activities/UpdatedImage.vue';
import UpdatedGallery from '@/Components/Activities/UpdatedGallery.vue';
import CreatedGallery from '@/Components/Activities/CreatedGallery.vue';
import CreatedImage from '@/Components/Activities/CreatedImage.vue';
import UpdatedPage from '@/Components/Activities/UpdatedPage.vue';
import CreatedLike from '@/Components/Activities/CreatedLike.vue';
import CreatedReview from '@/Components/Activities/CreatedReview.vue';
import UpdatedReview from '@/Components/Activities/UpdatedReview.vue';
import DeletedReview from '@/Components/Activities/DeletedReview.vue';
import CreatedLogin from '@/Components/Activities/CreatedLogin.vue';
import CreatedInquiry from '@/Components/Activities/CreatedInquiry.vue';
import { onMounted } from 'vue';


defineProps({
    item: Object
})

const page = usePage()

const componentMap = {
    created_login: CreatedLogin,
    created_inquiry: CreatedInquiry,
    created_review: CreatedReview,
    updated_user: UpdatedUser,
    created_logout: CreatedLogout,
    created_like: CreatedLike,
    updated_property: UpdatedProperty,
    updated_page: UpdatedPage,
    created_gallery: CreatedGallery,
    updated_gallery: UpdatedGallery,
    created_image: CreatedImage,
    updated_image: UpdatedImage,
    updated_review: UpdatedReview,
    deleted_review: DeletedReview,
};


const createComponentMap = () => {
    page.props.types.forEach(type => {
        componentMap[type] = convertToPascalCase(type)
    });
}

const getComponentType = (type) => {
    return componentMap[type] || null;
};

onMounted(() => {
    //createComponentMap()
})
</script>

<template>
    <li class="mb-10 ms-6">
        <span
            class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full -start-3 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
            <img class="rounded-full shadow-lg" :src="item?.owner.profile_photo_url"
                :alt="`${item?.owner.name}s avatar`" />
        </span>
        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-700 dark:border-gray-600">
            <div class="items-center justify-between mb-0 sm:flex">
                <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">
                    {{ item?.created_at_diff_for_humans }} from {{ item?.location.cityName }}, {{
                        item?.location.countryName }}
                </time>
                <div class="text-sm font-normal text-gray-500 lex dark:text-gray-300">
                    <component :is="getComponentType(item?.type)" :item="item" />
                </div>
            </div>
        </div>
    </li>
</template>
