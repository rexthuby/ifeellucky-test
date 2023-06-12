<script setup lang="ts">
import {ref} from "vue";
import WhiteButton from "@/shared/ui/buttons/WhiteButton.vue";
import {updateKey as apiUpdateKey} from '../api/updateKey.ts'
import {XMarkIcon} from '@heroicons/vue/24/outline'
import {toast} from "vue3-toastify";

const props = defineProps({
    accessKey: {
        type: String,
        required: true
    }
})

const updated = ref<boolean>(false)
const isButtonAvailable = ref<boolean>(true)
const newKey=ref('')

const emit = defineEmits<{
    (e: 'update', key: string): void
}>()

const updateKey = async () => {
    isButtonAvailable.value = false
    console.log(props.accessKey)
    const response = await apiUpdateKey(props.accessKey)
    newKey.value = response.data.key
    updated.value = true
    toast.success('New key ready')
    emit('update', newKey)
    isButtonAvailable.value = true
}
</script>

<template>
    <div>
        <WhiteButton @click="updateKey" :is-disable="!isButtonAvailable">Update access key</WhiteButton>
        <div v-if="updated" class="flex items-center gap-2 py-1">
                <router-link :to="{name:'Home', params:{key:newKey}}" class="text-blue-200 hover:underline">New key: {{newKey}}</router-link>
            <WhiteButton padding-class="p-1 rounded" @click="updated = false"><XMarkIcon class="w-2 h-2"></XMarkIcon></WhiteButton>
        </div>
    </div>
</template>

<style scoped>

</style>
