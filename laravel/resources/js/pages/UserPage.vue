<script setup lang="ts">
import {onMounted, ref} from 'vue'
import axios from 'axios'
import { useRoute } from "vue-router";
import InputForm from "@/features/UserPage/InputForm.vue";
import MemopadView from "@/features/UserPage/MemopadView.vue";

const router = useRoute()
const memopads = ref([])

const get_memopads = async () => {
    try {
        const response = await axios.get(`http://localhost:48080/api/users/${router.params.user_id}/memopads`)
        memopads.value = response.data.memopads
        console.log(memopads.value)
    } catch (error) {
        console.error(error)
    }
}

onMounted(()=>{
    get_memopads()
    console.log(router.params.user_id)
})

</script>

<template>
    <InputForm :user_id="router.params.user_id"/>
    <MemopadView :user_id="router.params.user_id" :memopads="memopads"/>
</template>

<style scoped>

</style>
