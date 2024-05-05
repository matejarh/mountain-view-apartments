import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useHelperStore = defineStore('helpers', () => {
    const show = ref(false)

    return { show }
})
