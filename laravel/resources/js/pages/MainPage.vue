<script setup lang="ts">
import { useRouter } from "vue-router"
const router = useRouter()
const to_registration = () => {
    router.push({name: "Registrations"})
}
</script>

<template>
    <button type="button" @click="to_registration" class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5">新規登録</button>
</template>

<style scoped>

</style>
