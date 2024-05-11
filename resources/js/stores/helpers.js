import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useHelperStore = defineStore('helpers', () => {
    const show = ref(true)
    const showMain = ref(false)
    const showNav = ref(false)
    const showFooter = ref(false)
    const showLogo = ref(false)
    const showIcons = ref(false)
    const showLang = ref(false)
    const showTheme = ref(false)
    const showUserDropdown = ref(false)
    const contactDrawer = ref(false)
    const pageLoaded = ref(false)
    const showNavItems = []
    const isDark = ref(localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches))

    const hideContactDrawer = () => {
        contactDrawer.value = false
    }
    const showContactDrawer = () => {
        contactDrawer.value = true
    }

    const delay = function (ms) {
        return new Promise(resolve => setTimeout(resolve, ms));
    }

    return { show, contactDrawer, showContactDrawer, hideContactDrawer, delay, isDark, showFooter, showMain, showLogo, showNav, showIcons, showLang, showTheme, showUserDropdown, pageLoaded, showNavItems }
})
