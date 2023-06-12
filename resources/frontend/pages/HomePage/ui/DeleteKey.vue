<script setup lang="ts">
import {ref} from "vue";
import {deleteKey as apiDeleteKey} from '../api/deleteKey.ts'
import ColorfulButton from "@/shared/ui/buttons/ColorfulButton.vue";

const props = defineProps({
    accessKey: {
        type: String,
        required: true
    }
})

const isButtonAvailable = ref<boolean>(true)

const emit = defineEmits<{
    (e: 'delete'): void
}>()

const deleteKey = async () => {
    isButtonAvailable.value = false
    await apiDeleteKey(props.accessKey)
    emit('delete')
}
</script>

<template>
    <div>
        <ColorfulButton bg-color="red" @click="deleteKey" :is-disable="!isButtonAvailable">Delete access key
        </ColorfulButton>
    </div>
</template>

<style scoped>

</style>
