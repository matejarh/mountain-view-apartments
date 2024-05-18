import { defineStore } from 'pinia'
import { computed, ref } from 'vue'

export const useScrollStore = defineStore('scroll', () => {
    const scrollPosition = ref(0)
    const wrapperHeight = ref(0)
    const windowHeight = ref(0)

    const isBottom = computed(() => {
        return wrapperHeight.value <= scrollPosition.value + windowHeight.value
    })

    const updateScrollPosition = (newScrollPosition) => {
        scrollPosition.value = newScrollPosition
    }
    const updateWrapperHeight = (newHeight) => {
        wrapperHeight.value = newHeight
    }
    const updateWindowHeight = (newHeight) => {
        windowHeight.value = newHeight
    }

    return { scrollPosition, updateScrollPosition, wrapperHeight, updateWrapperHeight, windowHeight, updateWindowHeight, isBottom}
})
