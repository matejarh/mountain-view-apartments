<script setup>
import { ref } from 'vue';
import TextInput from '@/Components/TextInput.vue';
import TrashBinIcon from '@/Icons/TrashBinIcon.vue';
import SelectInput from '@/Components/SelectInput.vue';

const props = defineProps({
    bedTypes: Object,
    modelValue: Array,
})

const emit = defineEmits(['remove', 'update'])
const form = {
    name: '',
    key: '',
    icon: '',
}

const bedTypesProxy = ref(props.bedTypes)
const bedTypeProxy = ref(null)

const showEditDialog = ref(false)


const handleUpdated = (form, key) => {
    emit('update', [form, key])
}
</script>

<template>
    <div class="flex items-center space-x-2" v-for="type, key in bedTypes">
        <!-- <BedTypeIcon :icon="type.icon" /> -->

        <div class="w-full">

            <TextInput :id="`bed_type_${key}_title`" v-model="form.bed_types[key].title" type="text"
                class="mt-1 block w-full" required :has-error="!!form.errors['bed_types.' + key + '.title']"
                :placeholder="__('Enter title') + '...'" />
        </div>
        <div class="w-full">

            <TextInput :id="`bed_type_${key}_name`" v-model="form.bed_types[key].name" type="text"
                class="mt-1 block w-full" required :has-error="!!form.errors['bed_types.' + key + '.name']"
                :placeholder="__('Enter name') + '...'" />
        </div>
        <div class="w-full">

            <SelectInput v-model="form.bed_types[key].icon" :id="`bed_type_${key}_icon`">
                <option disabled value="">- {{ __('select icon') }} -</option>
                <option value="QueenBedIcon">{{ __('Queen Bed') }}</option>
                <option value="SingleBedIcon">{{ __('Single Bed') }}</option>
                <option value="SofaBedIcon">{{ __('Sofa Bed') }}</option>
            </SelectInput>
        </div>
        <div class="">
            <button @click="handleRemoveBedType(type)">
                <TrashBinIcon class="text-bittersweet-700 dark:text-bittersweet-500" />
            </button>
        </div>

    </div>

    <!-- <EditBedTypeDialog :show="showEditDialog" @close="showEditDialog = false" :bed-type="bedTypeProxy"
        @updated="handleUpdated" /> -->
</template>
