<script setup>
import ActionSection from '@/Components/ActionSection.vue'
import TableSection from '@/Components/TableSection.vue'
import TableRow from './TableRow.vue'
import { ref, watch } from 'vue';
import FiltersSection from '@/Components/FiltersSection.vue';
import Checkbox from '@/Components/Checkbox.vue';
import TableHeader from '@/Components/TableHeader.vue';
import { usePage } from '@inertiajs/vue3';

const showReservationEditDialog = ref(false)
const editingReservation = ref({})

const handleEditReservation = (user) => {
    editingReservation.value = user
    showReservationEditDialog.value = true
}

const page = usePage()

const filters = ref({
    confirmed: !!page.props?.filters.confirmed,
    rejected: !!page.props?.filters.rejected,
    paymentReceived: !!page.props?.filters.paymentReceived,
    paymentNotReceived: !!page.props?.filters.paymentNotReceived,
})

// Watch for changes in the confirmed checkbox
watch(() => filters.value.confirmed, (newVal) => {
    if (newVal) {
        filters.value.rejected = false;
    }
});

// Watch for changes in the rejected checkbox
watch(() => filters.value.rejected, (newVal) => {
    if (newVal) {
        filters.value.confirmed = false;
    }
});

watch(() => filters.value.paymentReceived, (newVal) => {
    if (newVal) {
        filters.value.paymentNotReceived = false;
    }
});

// Watch for changes in the rejected checkbox
watch(() => filters.value.paymentNotReceived, (newVal) => {
    if (newVal) {
        filters.value.paymentReceived = false;
    }
});

const headers = ref([
    'Guest',
    'Apartment',
    'Arrival/Departure',
    'Guests',
    'Message',
    'Confirmed/Payment',
    'Action'
])

</script>

<template>

    <ActionSection :fullwidth="true">
        <template #title>
            {{ __("Reservations List") }}
        </template>
        <template #content>
            <TableSection :paginator="$page.props?.reservations">
                <template #header>
                    <!-- <TableHeader /> -->
                    <FiltersSection id="reservations-filters" route="admin.reservations.index" :filters="filters"
                        placeholder="Search for reservations">
                        <div class="flex">
                            <div class="flex flex-col ms-4">
                                <label class="text-gray-500 block" for="confirmed">
                                    <Checkbox class="w-12 h-12" id="confirmed" v-model:checked="filters.confirmed" />
                                    {{__('Approved')}}
                                </label>
                                <label class="text-gray-500 block" for="rejected">
                                    <Checkbox class="w-12 h-12" id="rejected" v-model:checked="filters.rejected" />
                                    {{__('Not Approved')}}
                                </label>
                            </div>
                            <div class="flex flex-col ms-4">
                                <label class="text-gray-500 block" for="payment_received">
                                    <Checkbox class="w-12 h-12" id="payment_received" v-model:checked="filters.paymentReceived" />
                                    {{__('Payment Received')}}
                                </label>
                                <label class="text-gray-500 block" for="payment_not_received">
                                    <Checkbox class="w-12 h-12" id="payment_not_received" v-model:checked="filters.paymentNotReceived" />
                                    {{__('Payment Not Received')}}
                                </label>
                            </div>

                        </div>
                    </FiltersSection>
                </template>

                <template #tablehead>
                    <TableHeader :headers="headers" />
                </template>
                <TableRow v-for="reservation in $page.props?.reservations.data" :key="reservation.id" :item="reservation"
                    @edit-reservation="handleEditReservation" />
            </TableSection>
        </template>
    </ActionSection>
</template>
