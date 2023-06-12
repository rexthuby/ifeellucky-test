<script setup lang="ts">
import BaseIcon from "./BaseIcon.vue";

defineProps({
  svgPath: {
    type: String,
    default: null,
  },
  heightClass: {
    type: String,
    default: null,
  },
});
</script>

<template>
  <BaseIcon
      icon-box-width-class="w-10"
      :icon-box-height-class="heightClass"
      class="absolute top-0 left-0 z-10 pointer-events-none text-gray-500 dark:text-slate-400"
      :svg-path="svgPath"/>
</template>
