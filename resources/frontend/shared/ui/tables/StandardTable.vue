<script setup lang="ts">
import type {PropType} from "vue";

defineProps({
  headers: {
    type: Object as PropType<Array<string | number>>,
    required: true
  },
  columnData: {
    type: Object as PropType<Array<string | number | null>[]>,
    required: true
  }
})
</script>

<template>
  <table class="table-auto w-full">
    <thead>
    <tr class="p-2">
      <th class="px-2 text-left" v-for="(header,idx) in headers" :key="idx">
        {{ header }}
      </th>
    </tr>
    </thead>
    <tbody>
    <tr class="p-2" v-for="(row,idx) in columnData" :key="idx">
      <td class="px-2" v-for="(value, index) in row" :key="index">
        {{ value != null ? value : '-' }}
      </td>
    </tr>
    </tbody>
  </table>
</template>

<style scoped>

</style>