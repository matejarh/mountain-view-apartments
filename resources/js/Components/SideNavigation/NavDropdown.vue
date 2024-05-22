<script setup>
import ArrowDownIcon from '@/Icons/ArrowDownIcon.vue';
import ExpandDownUpTransition from '@/Transitions/ExpandDownUpTransition.vue';
import { usePage } from '@inertiajs/vue3';
import { ref, getCurrentInstance, onBeforeMount, computed } from 'vue';

const props = defineProps({
    id: String,
    active: [String, Array]
})

const page = usePage()

const component = getCurrentInstance();

const show = ref(false)

const isCurrent = computed(() => {
    if (props.active.constructor === Array) {
        let any = []
        props.active.forEach(active => {
            any.push(page.url.startsWith(active))
        })

        if(any.indexOf(true) != -1)
        {
            return true
        }
        return false

    }
    return page.url.startsWith(props.active)
})

const handleShow = () => {
    show.value = !show.value
    show.value === true ? localStorage.setItem(component.vnode.key, true) : localStorage.removeItem(component.vnode.key)

}

onBeforeMount(() => {
    if (localStorage.getItem(component.vnode.key) || isCurrent) {
        show.value = true
    }

})

</script>

<template>
    <li>
        <button type="button"
            @click="handleShow"
            :class="{'bg-primary-600 hover:bg-primary-500 text-white dark:bg-primary-800 dark:hover:bg-primary-900' : isCurrent}"
            class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-l-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"

            >
            <div v-if="$slots.icon"
            :class="{'text-white group-hover:text-white dark:text-white dark:group-hover:text-white' : isCurrent}"
                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">

                <slot name="icon" />
            </div>

            <span class="flex-1 ml-3 text-left whitespace-nowrap">
                <slot name="title" />
            </span>
            <ArrowDownIcon class="w-6 h-6 transition-transform" :class="{'rotate-180' : show === true}" />
        </button>
        <div class="relative">

            <ExpandDownUpTransition>

                <ul :id="id" v-show="show" class="origin-top py-2 space-y-2 ">
                    <slot />

                </ul>
            </ExpandDownUpTransition>
        </div>
    </li>
</template>
