<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'
import TextareaForm from "@/components/MemoPage/TextareaForm.vue"
import MemoView from "@/components/MemoPage/MemoView.vue"
import { useRoute } from "vue-router";
import TitleView from "@/components/MemoPage/TitleView.vue";
import ButtonView from "@/components/MemoPage/ButtonView.vue";

const route = useRoute()
const memos = ref([])

const get_memos = async () => {
    try {
        console.log(route.params.id)
        const response = await axios.get('http://localhost:48080/api/memopads/' + route.params.id + '/memos')
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

const deletememo = (memo, index) => {
    memos.value.splice(index, 1)
}

const editmemo = (memo, index) => {
    memos.value.splice(index, 1, memo)
}

</script>

<template>
    <TitleView :title="route.query.title"/>
    <ButtonView />
    <TextareaForm :id="route.params.id" @added="addmemo"/>
    <MemoView :memos="memos" :id="route.params.id" @deleted="deletememo" @edited="editmemo"/>
</template>

<style scoped>

</style>
