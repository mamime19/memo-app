<script setup lang="ts">
import axios from 'axios'
import { ref } from 'vue'
import { useRouter } from "vue-router";

const router = useRouter()
const name = ref('')
const email = ref('')
const password = ref('')

const register = async () => {
    try {
        const response = await axios.post('http://localhost:48080/api/users', {
            name: name.value,
            email: email.value,
            password: password.value
        })
        const message = response.data.message
        const id = response.data.user.id
        name.value = ""
        email.value = ""
        password.value = ""
        router.push({name: 'User', params: { user_id: id }})
        console.log(message)
    } catch (error) {
        console.error(error)
    }
}
</script>

<template>
    <div class="flex justify-center">
        <div class="flex flex-col items-center justify-center w-[500px] bg-white rounded-2xl shadow-md m-10 p-8 gap-16">
            <div class="flex flex-col gap-4 w-full">
                <div class="flex justify-center text-2xl">新規登録</div>
                <div class="flex flex-col gap-0.5">
                    <label for="name" class="block mb-2 text-md font-medium">名前</label>
                    <input v-model="name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2" placeholder="（例）山田太郎"/>
                </div>
                <div class="flex flex-col gap-0.5">
                    <label for="email" class="block mb-2 text-md font-medium">メールアドレス</label>
                    <input v-model="email" type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2" placeholder="（例）example@example.com"/>
                </div>
                <div class="flex flex-col gap-0.5">
                    <label for="password" class="block mb-2 text-md font-medium">パスワード</label>
                    <input v-model="password" type="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2" placeholder="（例）example@example.com"/>
                </div>
            </div>
            <button type="button" @click="register" class="w-full text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5">新規登録</button>
        </div>
    </div>
</template>

<style scoped>

</style>
