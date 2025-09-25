
<script setup lang="ts">
import DocumentSvg from "@/components/svgs/DocumentSvg.vue";
import { useRouter } from "vue-router";

const router = useRouter()
const to_home = () => {
    router.push({name: 'Main'})
}

const to_registration = () => {
    router.push({name: 'Registrations'})
}
</script>

<template>
    <div class="flex items-center justify-between ps-5 pe-5 pt-5 pb-8 bg-white shadow-md">
            <button type="button" class="invisible text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5">新規登録</button>
            <div @click="to_home" class="flex flex-col gap-2 ">
                <div class="flex justify-center items-center gap-2">
                    <DocumentSvg size=40></DocumentSvg>
                    <div class="text-3xl text-orange-600">かんたんメモ</div>
                </div>
                <div class="text-sm">思いついたことをサッと記録しよう</div>
            </div>
            <button type="button" @click="to_registration" class="text-orange-500 bg-white border border-orange-500 hover:bg-orange-500 hover:text-white focus:ring-2 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5">新規登録</button>
    </div>
</template>

<style scoped>

</style>
