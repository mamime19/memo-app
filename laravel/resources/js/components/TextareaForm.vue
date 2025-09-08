<script setup lang="ts">
import PlusSvg from "@/components/svgs/PlusSvg.vue";
import { ref,computed } from 'vue'
import axios from 'axios'
import {defineEmits} from 'vue'

const is_focused = ref(false)
const is_composing = ref(false)
const text = ref('')
const message = ref('')
const emit = defineEmits(['added'])

const is_disabled = computed(()=>{
    return !is_composing.value && text.value.trim() === ''
})

const submit = async () => {
    try {
        const response = await axios.post('http://localhost:48080/api/memos', {
            text: text.value,
        })
        message.value = response.data.message
        text.value = ''
        console.log('POST レスポンス:', response.data)
        emit('added', response.data.memo)
    } catch (error) {
        message.value = 'エラーが発生しました。'
        console.error(error.response?.data || error.message)
    }
}

const enterkey_process = (event: KeyboardEvent) => {
    if(event.key === 'Enter'){
        if(event.shiftKey) {
            return;
        } else {
            event.preventDefault()
            submit()
        }
    }
}

</script>

<template>
    <div class="flex justify-center">
        <div class="bg-white w-[650px] h-[325px] ms-10 me-10 mt-10 mb-5 rounded-2xl shadow-lg">
            <div class="flex justify-start items-center m-[1.4em] gap-[0.3em]">
                <PlusSvg size=28></PlusSvg>
                <div class="text-lg">新しいメモ</div>
            </div>
            <div class="flex justify-center m-2">
                <textarea v-model="text" @keydown="enterkey_process" @focus="is_focused=true" @blur="is_focused=false" @compositionstart="is_composing=true" @compositionend="is_composing=false" :class="['w-full ms-5 me-5 p-3 h-[150px] text-md rounded-lg border resize-none outline-none transition-colors duration-100',is_focused ? 'border-blue-400' : 'border-gray-300']" placeholder="メモを入力してください... &#13; （Enterで保存、Shift+Enterで改行）"></textarea>
            </div>
            <div class="flex justify-center m-2">
                <button @click="submit" :class="['w-full bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 text-white font-bold mt-3 ms-5 me-5 p-3 rounded-lg', is_disabled ? 'opacity-50 cursor-not-allowed':'']">
                    <div class="flex justify-center items-center gap-1">
                        <PlusSvg color="white"/>
                        メモを保存
                    </div>
                </button>
            </div>
        </div>
    </div>
    <p>{{ message }}</p>
</template>

<style scoped>

</style>
