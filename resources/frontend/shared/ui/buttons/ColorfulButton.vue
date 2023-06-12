<script setup lang="ts">
import {computed} from "vue";

const props = defineProps({
    isDisable: {
        type: Boolean,
        required: false,
        default: false
    },
    bgColor: {
        type: String,//add to tailwind safelist this class and modification for them like hover:
        validator(value: unknown): boolean {
            return ['blue', 'red', 'green'].includes(value)
        },
        default: 'blue'
    },
    paddingClass: {
        type: String,
        default: 'py-2 px-6'
    }
})

const bgColor = computed(() => {
    const bg = props.bgColor
    return `bg-${bg}-300 hover:bg-${bg}-400 active:bg-${bg}-500`
})
</script>

<template>
    <button class="c-transition text-gray-800 font-semibold border border-gray-400 rounded shadow"
            :class="[isDisable?'bg-gray-100 cursor-default': `${bgColor} outline outline-transparent`, paddingClass]"
            :disabled="isDisable">
        <slot>
        </slot>
    </button>
</template>

<style scoped>

</style>
