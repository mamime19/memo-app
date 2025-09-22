<script setup lang="ts">
import { ref } from 'vue'
import axios from 'axios'
import { useRoute } from "vue-router";
import InputForm from "@/features/MemoPadPage/InputForm.vue";

const router = useRoute()
const memopads = ref([])

const get_memopads = async () => {
    try {
        const response = await axios.get(`http://localhost:48080/api/users/${router.params.id}`)
        memopads.value = response.data.memopads
        console.log(memopads.value)
    } catch (error) {
        console.error(error)
    }
}

</script>

<template>
    <InputForm :id="router.params.id"/>
    <div class="flex justify-center m-10">
        <div class="text-3xl">作成したメモ帳</div>
    </div>
    <ul>
        <li v-for="memopad in memopads" :key="memopad.id">
            {{ memopad.title }}
        </li>
    </ul>
</template>

<style scoped>

</style>
