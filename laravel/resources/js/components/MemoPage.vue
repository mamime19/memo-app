<script setup lang="ts">
import {ref,onMounted} from 'vue'
import axios from 'axios'
import TextareaForm from "@/components/TextareaForm.vue";
import MemoView from "@/components/MemoView.vue";

const memos = ref([])

const get_memos = async () => {
    try {
        const response = await axios.get('http://localhost:48080/api/memos')
        memos.value = response.data
        console.log('APIレスポンス data:', response.data)
        console.log("メモの取得に成功しました")
        console.log(memos.value)
    } catch(error) {
        console.error('メモの取得に失敗しました', error)
    }
}

onMounted(() => {
    get_memos()
})

const addmemo = (newmemo) => {
    memos.value.push(newmemo)
    console.log(newmemo)
}

</script>

<template>
    <TextareaForm @added="addmemo" />
    <MemoView :memos="memos"/>
</template>

<style scoped>

</style>
