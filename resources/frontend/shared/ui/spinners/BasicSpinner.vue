<script setup lang="ts">
defineProps({
    heightClass:{
        type:String,
        default:'h-20'
    },
    widthClass:{
        type:String,
        default:'w-20'
    }
})
</script>

<template>
  <div class="border-gray-300 animate-spin rounded-full border-8 border-t-blue-600" :class="[widthClass, heightClass]" />
</template>

<style scoped>

</style>
