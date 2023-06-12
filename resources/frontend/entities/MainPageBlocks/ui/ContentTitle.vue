<script setup lang="ts">
import {useSlots} from "vue";

defineProps({
    title: {
        type: String,
    },
});

const slots = useSlots()
</script>

<template>
    <section class="flex items-center flex-wrap p-4 gap-4">
        <slot name="left"></slot>
        <div class="text-2xl leading-tight">
            {{ title }}
        </div>
        <slot name="right"></slot>
    </section>
</template>
