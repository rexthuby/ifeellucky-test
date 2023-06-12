<script setup lang="ts">
defineProps({
  isDisable: {
    type: Boolean,
    default: false
  },
  paddingClass: {
    type: String,
    default: 'py-2 px-6'
  }
})
</script>

<template>
  <button class="focus:outline-0 c-transition text-gray-800
  font-semibold border border-gray-400 rounded shadow"
          :class="[isDisable?'bg-gray-100 cursor-default':'bg-white hover:bg-gray-100 active:bg-gray-200', paddingClass]"
          :disabled="isDisable">
      <div class="flex items-center">
          <slot>
          </slot>
      </div>
  </button>
</template>

<style scoped>

</style>
