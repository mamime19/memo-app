<script setup lang="ts">
import PlusSvg from "@/components/svgs/PlusSvg.vue";
import { ref, computed } from 'vue'
import axios from 'axios'
import {defineEmits} from 'vue'
import {defineProps} from 'vue'
import TitleView from "@/features/MemoPage/TitleView.vue";

const is_focused = ref(false)
const is_composing = ref(false)
const text = ref('')
const message = ref('')
const filename = ref('')
const nowfile = ref(null)
const emit = defineEmits(['added'])
const props = defineProps({
    id: {
        type: Number,
    },
})

const is_disabled = computed(()=>{
    return !is_composing.value && text.value.trim() === ''
})

const submit = async () => {
    try {
        const formData = new FormData()
        formData.append('text', text.value)
        formData.append('image', nowfile.value)
        const response = await axios.post('http://localhost:48080/api/memopads/' + props.id + '/memos', formData)
        message.value = response.data.message
        text.value = ''
        nowfile.value = null
        console.log('POST レスポンス:', response.data)
        emit('added', response.data.memo)
    } catch (error) {
        message.value = 'エラーが発生しました。'
        console.error(error.message)
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

const file_change = (event) => {
    if(event.target.files.length > 0) {
        const file = event.target.files[0]
        nowfile.value = file
        console.log(filename)
    }
}

</script>

<template>
    <div class="flex justify-center">
        <div class="flex flex-col items-start bg-white w-[650px] ms-10 me-10 mt-5 mb-5 rounded-2xl shadow-lg p-7 gap-5">
            <div class="flex justify-start items-center gap-1">
                <PlusSvg size=28></PlusSvg>
                <div class="text-lg">新しいメモ</div>
            </div>
                <textarea v-model="text"
                          @keydown="enterkey_process"
                          @focus="is_focused=true"
                          @blur="is_focused=false"
                          @compositionstart="is_composing=true"
                          @compositionend="is_composing=false"
                          :class="['w-full p-3 h-[150px] text-md rounded-lg border resize-none outline-none transition-colors duration-100',
                          is_focused ? 'border-blue-400' : 'border-gray-300']"
                          placeholder="メモを入力してください... &#13; （Enterで保存、Shift+Enterで改行）"></textarea>
            <div class="flex gap-3 items-center">
                <label for="file-upload" class="px-4 py-2 bg-orange-400 text-white rounded cursor-pointer hover:bg-orange-600 transition">ファイルを選択</label>
                <input id="file-upload" type="file" class="hidden" @change="file_change"/>
                <p v-if="nowfile" class="text-md">{{ nowfile.name }}</p>
                </div>
                <button @click="submit" :class="['w-full bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 text-white font-bold p-3 rounded-lg', is_disabled ? 'opacity-50 cursor-not-allowed':'']">
                    <div class="flex justify-center items-center gap-1">
                        <PlusSvg color="white"/>
                        メモを保存
                    </div>
                </button>
            </div>
    </div>
</template>

<style scoped>

</style>
