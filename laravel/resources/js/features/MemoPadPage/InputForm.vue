<script setup lang="ts">
import { useRouter } from "vue-router"
import { ref } from 'vue'
import axios from 'axios'
import { defineProps } from 'vue'
const router = useRouter()
const title = ref('')
const message = ref('')
const id = ref(-1)

const props = defineProps({
    id: {
    }
})

const tomemo = () => {
    router.push({name: 'Memopad', params: { id: id.value }})
}

const submit = async () => {
    try {
        const response = await axios.post(`http://localhost:48080/api/users/${props.id}/memopads`,{
            title: title.value
        })
        message.value = response.data.message
        id.value = response.data.id
        console.log(message)
        console.log(id)
        tomemo()
        title.value = ""
    } catch(error) {
        console.error(error)
    }
}

</script>

<template>
    <div class="flex justify-center">
        <div class="w-[600px] bg-white m-10 p-10 rounded-xl shadow-md">
            <div class="flex flex-col items-center gap-8">
                <div class="text-2xl">メモ帳の新規作成</div>
                <div class="w-full">
                    <label for="default-input" class="block mb-2 text-md text-gray-900 dark:text-white">メモ帳のタイトルを入力</label>
                    <input v-model="title" type="text" placeholder="（例）台湾旅行で行きたい場所" id="default-input" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <button type="button" @click="submit" class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5">メモ帳を新規作成</button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
