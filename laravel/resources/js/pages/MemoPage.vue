<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'
import TextareaForm from "@/features/MemoPage/TextareaForm.vue"
import MemoView from "@/features/MemoPage/MemoView.vue"
import { useRoute } from "vue-router";
import TitleView from "@/features/MemoPage/TitleView.vue";
import ButtonView from "@/features/MemoPage/ButtonView.vue";
import NotFound from "@/components/NotFound.vue";

const route = useRoute()
const memos = ref([])
const title = ref('')
const is_memopad_existed = ref(false)

const get_memos = async () => {
    try {
        console.log(route.params.id)
        const response = await axios.get(`http://localhost:48080/api/users/${route.params.user_id}/memopads/${route.params.memopad_id}/memos`)
        const status = response.data.status
        if(status == 'success') {
            is_memopad_existed.value = true
            memos.value = response.data.memos
            console.log('APIレスポンス data:', response.data)
            console.log('メモの取得に成功しました')
            console.log(memos.value)
        }
    } catch(error) {
        console.error('メモの取得に失敗しました', error)
    }
}

const get_title = async () => {
    try {
        const response = await axios.get(`http://localhost:48080/api/users/${route.params.user_id}/memopads/${route.params.memopad_id}`)
        title.value = response.data.title
        console.log('タイトルの取得に成功しました')
        console.log(title.value)
    } catch(error) {
        console.error('タイトルの取得に失敗しました', error)
    }
}

onMounted(() => {
    get_memos()
    get_title()
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
    <div v-if="is_memopad_existed==true">
        <TitleView :title="title" />
        <ButtonView />
        <TextareaForm :user_id="route.params.user_id" :memopad_id="route.params.memopad_id" @added="addmemo"/>
        <MemoView :memos="memos" :user_id="route.params.user_id" :memopad_id="route.params.memopad_id" @deleted="deletememo" @edited="editmemo"/>
    </div>
    <div v-else>
        <NotFound />
    </div>
</template>

<style scoped>

</style>
