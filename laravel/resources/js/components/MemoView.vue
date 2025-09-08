<script setup lang="ts">
import DocumentSvg from "@/components/svgs/DocumentSvg.vue";
import TrashSvg from "@/components/svgs/TrashSvg.vue";
import { ref } from 'vue'

const memos = ref([
    {text: 'vueの勉強をする', time: '2024-07-30 10:30'},
    {text: 'Laravelの勉強をする', time: '2025-09-08 15:27'}
])
const mouseover_index = ref(-1)

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
                    <div class="text-gray-600 text-sm">{{memos.length}}件</div>
                </div>
            </div>
        </div>
    </div>
    <div v-for="(memo, index) in memos" class="flex justify-center">
        <div v-on:mouseover="mouseover_index=index" v-on:mouseleave="mouseover_index=-1" class="w-[650px] m-2 p-5 bg-white rounded-lg shadow-md">
            <div v-if="mouseover_index==index" class="flex flex-col gap-[1.0em]">
                <div class="flex justify-between">
                    {{memo.text}}
                    <TrashSvg />
                </div>
                <div class="text-xs text-gray-500">
                    {{memo.time}}
                </div>
            </div>
            <div v-else class="flex flex-col gap-[1.0em]">
                {{memo.text}}
                <div class="text-xs text-gray-500">
                    {{memo.time}}
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
