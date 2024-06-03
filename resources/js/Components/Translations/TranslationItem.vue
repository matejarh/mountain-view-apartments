<script setup>
import { getCurrentInstance, ref } from 'vue';
import TextInput from '../TextInput.vue';

defineProps({
    keysWithTranslations: Object,
})
const instance = getCurrentInstance();

const show=ref(false)

</script>

<template>
    <div class="border rounded-lg p-4 mt-4 shadow-lg">
        <div class="flex justify-between" @click.prevent="show = !show">
            <h5 class="font-semibold text-md">{{ instance.vnode.key }}</h5>

                {{ show ? '-' : '+' }}

        </div>

        <div class="" v-show="show">
            <div v-for="locale in $page.props.supported_locales" :key="locale">
                <p>

                    {{ locale }}
                </p>
                <TextInput v-model="keysWithTranslations[instance.vnode.key][locale]" class="w-full" />
            </div>
        </div>
    </div>
</template>
