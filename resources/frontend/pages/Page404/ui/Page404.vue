<script setup lang="ts">
import {HomeIcon} from '@heroicons/vue/24/outline'
import {useRouter} from "vue-router";

const router = useRouter()

const home = () => {
    router.push({name: 'Register'})
}
</script>

<template>
    <div class="bg-gray-200 w-full px-16 md:px-0 h-screen flex items-center justify-center">
        <div
            class="bg-white border border-gray-200 flex flex-col items-center justify-center px-4 md:px-8 lg:px-24 py-8 rounded-lg shadow-2xl">
            <p class="text-6xl md:text-7xl lg:text-9xl font-bold tracking-wider text-gray-300">404</p>
            <p class="text-2xl md:text-3xl lg:text-5xl font-bold tracking-wider text-gray-500 mt-4">Page Not Found</p>
            <button @click="home"
                    class="focus:outline-0 active:bg-blue-800 flex items-center space-x-2 bg-blue-600 hover:bg-blue-700 text-gray-100 px-4 py-2 mt-6 rounded transition duration-150"
                    title="Return Home">
                <HomeIcon class="h-5 w-5"></HomeIcon>
                <span>Register page</span>
            </button>
        </div>
    </div>
</template>

<style scoped>

</style>
