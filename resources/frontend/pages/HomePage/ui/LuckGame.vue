<script setup lang="ts">
import WhiteButton from "@/shared/ui/buttons/WhiteButton.vue";
import {computed, nextTick, ref, watch} from "vue";
import {playLuckGame} from "../api/playLuckGame.ts";
import StandardTable from "@/shared/ui/tables/StandardTable.vue";
import {getGameHistory} from "../api/getGameHistory.ts/";
import moment from 'moment'

const props = defineProps({
    accessKey: {
        type: String,
        required: true
    }
});

const spinResult = ref(0)
const history = ref<{ createdAt: string, winningAmount: number }[]>([])
const historyIsShowing = ref(false)
const needLoadNewHistory = ref(true)
const borderColor = ref('#000000')
const play = async () => {
    const response = await playLuckGame(props.accessKey)
    const winningAmount = response.data.data.winning_amount
    spinResult.value = winningAmount.toString()
}

watch(()=>spinResult.value,()=>{
    const randomColor = Math.floor(Math.random() * 16777215).toString(16);
    borderColor.value = '#' + randomColor
    historyIsShowing.value = false
    needLoadNewHistory.value = true
})

const spinResultStandardize = computed(()=>{
    let arr = spinResult.value.toString().split('')
    if (arr.length > 3) {
        arr = arr.slice(0, 2)
    }
    while (arr.length < 3) {
        arr.unshift('0')
    }
    //@ts-ignore
    return arr
})

const showHistory = async () => {
    if (!needLoadNewHistory.value) {
        historyIsShowing.value = true
        return
    }
    const response = await getGameHistory(props.accessKey)
    if (response.data.length) {
        history.value = response.data
    }
    needLoadNewHistory.value = false
    historyIsShowing.value = true
}

const closeHistory = () => {
    historyIsShowing.value = false
}

const tableData = computed(() => {
    return history.value.map(result => [moment(result.createdAt).fromNow(), result.winningAmount])
})
</script>

<template>
    <div class="flex flex-col gap-2">
        <div>Check your luck</div>
        <div class="flex items-center gap-2">
            <WhiteButton @click="play">Play</WhiteButton>
            <div class="flex items-center gap-1">
                <div v-for="(value, idx) in spinResultStandardize" :key="idx" :style="{borderColor:borderColor}"
                     class="w-10 h-10 p-1 bg-gray-100 flex justify-center items-center rounded border">
                    {{ value }}
                </div>
            </div>
        </div>
        <div>
            <div>
                <WhiteButton @click="showHistory" v-if="!historyIsShowing">Show game history</WhiteButton>
                <WhiteButton @click="closeHistory" v-else>Close game history</WhiteButton>
            </div>
            <div v-if="historyIsShowing">
                <hr class="my-4">
                <div v-if="!tableData.length" class="text-xt">You newer play</div>
                <div v-else>
                    <StandardTable :column-data="tableData" :headers="['Last game', 'Amount']"></StandardTable>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
