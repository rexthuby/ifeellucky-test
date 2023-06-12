<script setup lang="ts">

import {onMounted, ref, watch} from "vue";
import {getUsersData} from "../api/getUsersData.ts";
import {useRoute, useRouter} from "vue-router";
import {ContentTitle, MainContentWrapper} from "@/entities/MainPageBlocks";
import LuckGame from "./LuckGame.vue";
import UpdateKey from "./UpdateKey.vue";
import DeleteKey from "./DeleteKey.vue";

const router = useRouter()
const route = useRoute()

const username = ref<string>('')
const phoneNumber = ref<string>('')
const key = ref('')

watch(route, (to) => {
    key.value = <string>to.params.key
    setUserData(<string>to.params.key)
})

onMounted(() => {
    const routeKey = route.params.key
    if (!routeKey) {
        router.push({name: 'NotFound'})
    }
    //@ts-ignore
    key.value = routeKey
    setUserData(key.value)
})

const setUserData = async (key: string) => {
    try {
        const response = await getUsersData(key)
        username.value = response.data.data.user.username
        phoneNumber.value = response.data.data.user.phone_number
    } catch (err) {
        router.push({name: 'NotFound'})
    }
}

const deleteKey = () => {
    router.push({name: 'Register'})
}

</script>

<template>
    <MainContentWrapper>
        <ContentTitle title="Home page"></ContentTitle>
        <div v-if="username && phoneNumber" class="text-lg my-4">
            <div>Username: {{ username }}</div>
            <div>Phone number: {{ phoneNumber }}</div>
        </div>
        <div class="flex flex-col gap-1" v-if="key">
            <UpdateKey :access-key="key"></UpdateKey>
            <DeleteKey :access-key="key" @delete="deleteKey"></DeleteKey>
        </div>
        <LuckGame :access-key="key" class="py-4"></LuckGame>
    </MainContentWrapper>
</template>

<style scoped>

</style>
