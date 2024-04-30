import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useScrollStore = defineStore('scroll', () => {
    const scrollPosition = ref(0)


    const updateScrollPosition = (newScrollPosition) => {
        scrollPosition.value = newScrollPosition
    }

    return { scrollPosition, updateScrollPosition }
})
