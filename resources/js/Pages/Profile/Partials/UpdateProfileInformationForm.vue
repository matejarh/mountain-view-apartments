<script setup>
import { computed, onBeforeUnmount, onMounted, ref } from 'vue';
import { Link, router, useForm, usePage } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    user: Object,
});

const page = usePage()

const form = useForm({
    _method: 'PUT',
    name: props.user.name,
    email: props.user.email,
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    phone: props.user.phone,
    address: props.user.address,
    country: props.user.country,
    email: props.user.email,
    photo: null,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const lastSeenActive=ref(null)

let interval
onMounted(() => {
    interval = setInterval(() => {
        //moment().locale('sl')
        // router.reload({ only: ['user'] })
        lastSeenActive.value = props.user.last_seen_diff_for_humans

    }, 1000);

})

onBeforeUnmount(() => {
    clearInterval(interval)
})

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    router.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title>
            <span class="flex justify-between items-center w-full">
                <span>
                    {{__("Profile Information")}}

                </span>
                <span class="text-sm text-right" v-html="lastSeenActive">

                </span>
            </span>
        </template>

        <template #description>
            {{__("Update your account's profile information and email address.")}}

        </template>

        <template #form>
            <!-- Profile Photo -->
            <div v-if="$page.props?.jetstream.managesProfilePhotos" class="col-span-6 md:col-span-4">
                <!-- Profile Photo File Input -->
                <input
                    id="photo"
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                >

                <InputLabel for="photo" :value="__('Photo')" />

                <!-- Current Profile Photo -->
                <div v-show="! photoPreview" class="mt-2">
                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'"
                    />
                </div>

                <SecondaryButton class="mt-2 me-2" type="button" @click.prevent="selectNewPhoto">
                    {{__("Select A New Photo")}}
                </SecondaryButton>

                <SecondaryButton
                v-if="user.profile_photo_path"
                type="button"
                class="mt-2"
                @click.prevent="deletePhoto"
                >
                {{__("Remove Photo")}}

                </SecondaryButton>

                <InputError :message="form.errors.photo" class="mt-2" />
            </div>

            <!-- Name -->
            <div class="col-span-6 md:col-span-4">
                <InputLabel
                :has-error="!!form.errors.name" for="name" :value="__('Name')" />
                <TextInput
                    id="name"
                    v-model="form.name"
                    type="text"
                    class="mt-1 block w-full"
                    required
                    autocomplete="name"
                    :has-error="!!form.errors.name"
                />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-span-6 md:col-span-4">
                <InputLabel
                :has-error="!!form.errors.email" for="email" :value="__('Email')" />
                <TextInput
                    id="email"
                    v-model="form.email"
                    type="email"
                    class="mt-1 block w-full"
                    required
                    autocomplete="username"
                    :has-error="!!form.errors.email"
                />
                <InputError :message="form.errors.email" class="mt-2" />

                <div v-if="$page.props?.jetstream.hasEmailVerification && user.email_verified_at === null">
                    <p class="text-sm mt-2">
                        {{__('Your email address is unverified.')}}

                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            @click.prevent="sendEmailVerification"
                        >
                            {{__('Click here to re-send the verification email.')}}
                        </Link>
                    </p>

                    <div v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        {{__('A new verification link has been sent to your email address.')}}
                    </div>
                </div>
            </div>
        </template>

        <template #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3">
                {{__('Saved.')}}
            </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{__('Save')}}
            </PrimaryButton>
        </template>
    </FormSection>
</template>
