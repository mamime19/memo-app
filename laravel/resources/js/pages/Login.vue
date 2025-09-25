<script setup lang="ts">
import { ref } from 'vue'
const email = ref('')
const password = ref('')
</script>

<template>
    <div class="flex justify-center">
        <div class="flex flex-col items-center justify-center w-[500px] bg-white rounded-2xl shadow-md m-10 p-8 gap-14">
            <div class="flex flex-col gap-5 w-full">
                <div class="flex justify-center text-2xl">ログイン</div>
                <div class="flex flex-col gap-0.5">
                    <label for="email" class="block mb-2 text-md font-medium">メールアドレス</label>
                    <input v-model="email" type="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2" placeholder="（例）example@example.com"/>
                </div>
                <div class="flex flex-col gap-0.5">
                    <label for="password" class="block mb-2 text-md font-medium">パスワード</label>
                    <input v-model="password" type="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2" placeholder="（例）example@example.com"/>
                </div>
            </div>
            <button type="button" class="w-full text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5">ログイン</button>
        </div>
    </div>
</template>

<style scoped>

</style>
