<script setup lang="ts">
import { computed } from "vue";

const props = defineProps({
  svgPath: {
    type: String,
    required: true,
  },
  iconBoxWidthClass: {
    type: String,
    default: "w-6",
  },
  iconBoxHeightClass: {
    type: String,
    default: "h-6",
  },
  svgSize: {
    type: Number,
    default: 16,
  },
});

const spanSize = computed(
  () => `${props.iconBoxWidthClass} ${props.iconBoxHeightClass}`
);
</script>

<template>
  <span class="inline-flex justify-center items-center" :class="spanSize">
    <svg
      viewBox="0 0 24 24"
      :width="svgSize"
      :height="svgSize"
      class="inline-block"
    >
      <path fill="currentColor" :d="svgPath" />
    </svg>
    <slot />
  </span>
</template>
