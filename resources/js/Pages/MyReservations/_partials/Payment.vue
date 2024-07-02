<template>
    <ActionSection>
        <template #title>{{ __('Create Reservation') }}</template>
        <template #content>

            <StripeElements v-if="stripeLoaded" v-slot="{ elements, instance }" ref="elms" :stripe-key="stripeKey"
                :instance-options="instanceOptions" :elements-options="elementsOptions">
                <StripeElement ref="card" :elements="elements" :options="cardOptions" />
            </StripeElements>
            <button type="button" @click="pay">Pay</button>
        </template>
    </ActionSection>
</template>

<script setup>
import { ref, onMounted, onBeforeMount } from 'vue';
import { StripeElements, StripeElement } from 'vue-stripe-js'
import { loadStripe } from '@stripe/stripe-js'
import { usePage } from '@inertiajs/vue3';
import ActionSection from '@/Components/ActionSection.vue';

const page = usePage()

const stripeKey = ref(page.props.stripe_pub_key)
const instanceOptions = ref({

})
const elementsOptions = ref({
    appearance: {
        theme: 'stripe',
    },
})
const cardOptions = ref({
    value: {
        postalCode: '12345',
    },
    style: {
            base: {
                iconColor: '#c4f0ff',
                color: '#fff',
                fontWeight: '500',
                fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
                fontSize: '16px',
                fontSmoothing: 'antialiased',
                ':-webkit-autofill': {
                    color: '#fce883',
                },
                '::placeholder': {
                    color: '#87BBFD',
                },
            },
            invalid: {
                iconColor: '#FFC7EE',
                color: '#FFC7EE',
            },
        },
})
const stripeLoaded = ref(false)
const card = ref()
const elms = ref()

onBeforeMount(() => {
    const stripePromise = loadStripe(stripeKey.value)
    stripePromise.then(() => {
        stripeLoaded.value = true
    })
})

const pay = () => {
    // Get stripe element
    const cardElement = card.value.stripeElement

    // Access instance methods, e.g. createToken()
    elms.value.instance.createToken(cardElement).then((result) => {
        // Handle result.error or result.token
        console.log(result)
    })
}
</script>

<style scoped>

</style>
