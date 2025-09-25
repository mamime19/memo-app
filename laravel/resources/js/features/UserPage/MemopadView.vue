<script setup lang="ts">
import { ref } from 'vue'
import { defineProps } from 'vue'
import { useRouter } from "vue-router";

const router = useRouter()
const props = defineProps({
    memopads: {
        type: Array,
    },
    user_id: {
        type: Number,
    },
})

const to_memo = (memopad_id) => {
    router.push({name: 'Memo', params: {user_id: props.user_id, memopad_id: memopad_id}})
}
</script>

<template>
    <div class="flex justify-center m-10">
        <div class="text-3xl">作成したメモ帳</div>
    </div>
    <div class="flex justify-center m-10">
        <div class="flex flex-col gap-10">
            <div v-for="memopad in props.memopads">
                <div class="bg-white w-[700px] p-7 rounded-2xl shadow-md text-lg font-bold">
                    <div class="flex justify-between items-center">
                        {{ memopad.title }}
                        <button type="button" @click="to_memo(memopad.id)" class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5">詳細</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
