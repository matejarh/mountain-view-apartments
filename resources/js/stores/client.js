import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useClientStore = defineStore('client', () => {
    const location = ref(null)

    const getLocation = () => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(handlePosition);
        }
    }

    const handlePosition = (position) => {
        location.value = position
        console.log(location.value)
    }

    return { location, getLocation }
})

