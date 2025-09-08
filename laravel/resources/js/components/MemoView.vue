<script setup lang="ts">
import DocumentSvg from "@/components/svgs/DocumentSvg.vue";
import TrashSvg from "@/components/svgs/TrashSvg.vue";
import axios from 'axios'
import { ref } from 'vue'
import { defineProps } from 'vue'
import {defineEmits} from 'vue'


const mouseover_index = ref(-1)
const emit = defineEmits(['deleted'])

const props = defineProps({
    memos: {
        type: Array,
        default: () => []
    }
})

const show_time = (date_str: string) => {
    const date_utc = new Date(date_str)
    const date_japan = new Date(date_utc.getTime()+9*60*60*1000)
    const japan_time = date_japan.toISOString()
    console.log(japan_time)
    const date = japan_time.substring(0,10)
    const time = japan_time.substring(11,16)
    return date + ' ' + time
}

const delete_memo = async (index: number) => {
    try {
        const response = await axios.get('http://localhost:48080/api/memos/'+index.toString())
        const message = response.data.message
        console.log(message)
        emit('deleted', response.data.memo, index)
    } catch(error) {
        console.error(error)
    }
}

</script>

<template>
    <div class="flex justify-center">
        <div class="w-[650px] m-1 p-1">
            <div class="flex justify-between">
                <div class="flex justify-start items-center gap-[0.5em]">
                    <DocumentSvg size="20"></DocumentSvg>
                    <div class="text-lg">保存されたメモ</div>
                </div>
                <div class="bg-orange-200 ps-2 pe-2 pt-1 pb-1 rounded-2xl">
                    <div class="text-gray-600 text-sm">{{props.memos.length}}件</div>
                </div>
            </div>
        </div>
    </div>
    <div v-for="(memo, index) in props.memos" class="flex justify-center">
        <div @mouseover="mouseover_index=index" @mouseleave="mouseover_index=-1" class="w-[650px] m-2 p-5 bg-white rounded-lg shadow-md">
            <div v-if="mouseover_index==index" class="flex flex-col gap-[1.0em]">
                <div class="flex justify-between">
                    <div class="whitespace-pre-line">
                        {{memo.text}}
                    </div>
                    <TrashSvg @click="delete_memo(index)"/>
                </div>
                <div class="text-xs text-gray-500">
                    {{show_time(memo.created_at)}}
                </div>
            </div>
            <div v-else class="flex flex-col gap-[1.0em]">
                <div class="whitespace-pre-line">
                    {{memo.text}}
                </div>
                <div class="text-xs text-gray-500">
                    {{show_time(memo.created_at)}}
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
