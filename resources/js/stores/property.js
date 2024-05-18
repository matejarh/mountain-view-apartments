import { ref } from 'vue'
import { defineStore } from 'pinia'

export const usePropertyStore = defineStore('property', () => {
    const list = ref([])


    const storeList = (properties) => {
        list.value = properties
    }

    return { list, storeList }
})

