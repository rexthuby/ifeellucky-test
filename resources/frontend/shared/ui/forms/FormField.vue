<script setup lang="ts">
import {computed,  useSlots} from "vue";

defineProps({
  label: {
    type: String,
    default: null,
  },
  labelFor: {
    type: String,
    default: null,
  },
  help: {
    type: String,
    default: null,
  },
  warnings: {
    type: Array,
    default: null
  }
});

const slots = useSlots();

const wrapperClass = computed(() => {
  const base = [];
  const slotsLength = slots.default().length;

  if (slotsLength > 1) {
    base.push("grid gap-3");
  }

  if (slotsLength === 1) {
    base.push("grid-cols-1");
  } else {
    base.push('grid-cols-2')
  }

  return base;
});
</script>

<template>
  <div>
    <label v-if="label" :for="labelFor" class="block font-bold text-sm">{{
        label
      }}</label>
    <div v-if="warnings" class="mb-1 flex flex-col gap-1">
      <div v-for="warn in warnings" class="text-xs text-red-400">
        {{ warn }}
      </div>
    </div>
    <div :class="wrapperClass">
      <slot/>
    </div>
    <div v-if="help" class="text-xs text-gray-500 mt-1">
      {{ help }}
    </div>
  </div>
</template>
