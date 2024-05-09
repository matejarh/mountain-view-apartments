import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useHelperStore = defineStore('helpers', () => {
    const show = ref(false)
    const contactDrawer = ref(false)

    const hideContactDrawer = () => {
        contactDrawer.value = false
    }
    const showContactDrawer = () => {
        contactDrawer.value = true
    }

    return { show, contactDrawer, showContactDrawer, hideContactDrawer }
})
