<script setup lang="ts">
import DocumentSvg from "@/components/svgs/DocumentSvg.vue";
import TrashSvg from "@/components/svgs/TrashSvg.vue";
import EditSvg from "@/components/svgs/EditSvg.vue";
import axios from 'axios'
import { ref } from 'vue'
import { defineProps } from 'vue'
import { defineEmits } from 'vue'
import { watch } from 'vue'
import { nextTick } from 'vue'
import { computed } from 'vue'


const mouseover_index = ref(-1)
const edit_index = ref(-1)
const is_focused = ref(false)
const emit = defineEmits(['deleted','edited'])
const edit_text = ref('')
const message=ref('')
const edit_textarea = ref(null)
const modal_open = ref(false)
const modal_index = ref(-1)

const props = defineProps({
    memos: {
        type: Array,
        default: () => []
    },
    user_id: {
        type: Number,
    },
    memopad_id: {
        type: Number,
    }
})

const show_time = (date_str: string) => {
    const date_utc = new Date(date_str)
    const date_japan = new Date(date_utc.getTime()+9*60*60*1000)
    const japan_time = date_japan.toISOString()
    const date = japan_time.substring(0,10)
    const time = japan_time.substring(11,16)
    return date + ' ' + time
}

const delete_memo = async (index: number) => {
    const id = props.memos[index].id
    console.log(id)
    try {
        const response = await axios.delete(`http://localhost:48080/api/users/${props.user_id}/memopads/${props.memopad_id}/memos/${id}`)
        const message = response.data.message
        console.log(message)
        console.log(index)
        emit('deleted', response.data.memo, index)
    } catch (error) {
        console.error(error)
        console.log('削除に失敗しました')
    }
}

watch(edit_index, async (new_index) => {
    if(new_index != -1) {
        await nextTick()
        edit_textarea.value.focus()
    }
})

const edit_rows = computed(()=>{
    let count = 1
    for(let char of edit_text.value) {
        if(char === '\n'){
            count++
        }
    }
    return count
})

const update_editdata = (newindex, newtext) => {
    edit_index.value = newindex
    edit_text.value = newtext
}

const save = async (index: number) => {
    const id = props.memos[index].id
    try {
        const response = await axios.post(`http://localhost:48080/api/users/${props.user_id}/memopads/${props.memopad_id}/memos/${id}`, {
            text: edit_text.value
        })
        console.log(edit_text)
        message.value = response.data.message
        console.log(message)
        emit('edited', response.data.memo, index)
        edit_index.value = -1
    } catch(error) {
        console.error(error)
        console.log('編集に失敗しました')
    }
}

const enterkey_process = (event: KeyboardEvent, index: number) => {
    if(event.key === 'Enter') {
        if(event.shiftKey){
            return;
        }else{
            event.preventDefault()
            save(index)
            console.log(index)
        }
    }
}

const url_check = (str) => {
    let list = []
    let http = 'http://'
    let https = 'https://'
    let curstr = []
    let mode = 0
    for(let i = 0; i < str.length; i++) {
        if(i < str.length - http.length && mode === 0 && str.substring(i,i + http.length) === http) {
            if(curstr.length > 0){
                list.push([curstr, mode])
            }
            curstr = ''
            mode = 1
        } else if(i < str.length - https.length && mode === 0 && str.substring(i,i + https.length) === https) {
            if(curstr.length > 0){
                list.push([curstr, mode])
            }
            curstr = ''
            mode = 1
        } else if(str[i]===' ' || str[i]==='　' || str[i]=='\n') {
            if(curstr.length > 0){
                list.push([curstr, mode])
            }
            curstr = ''
            mode = 0
        }
        curstr += str[i]
    }
    if (curstr.length > 0) {
        list.push([curstr, mode]);
    }
    return list
}


</script>

<template>
    <div class="flex justify-center">
        <div class="w-[650px] m-1 p-1">
            <div class="flex justify-between">
                <div class="flex justify-start items-center gap-[0.5em]">
                    <DocumentSvg size="20"></DocumentSvg>
                    <div class="text-lg">保存されたメモ</div>
                </div>
                <div class="bg-orange-200 ps-2 pe-2 pt-1 pb-1 rounded-2xl">
                    <div class="text-gray-600 text-sm">{{props.memos.length}}件</div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-9">
        <div v-for="(memo, index) in props.memos" class="flex justify-center">
            <div @mouseover="mouseover_index=index" @mouseleave="mouseover_index=-1" class="w-[650px] m-2 p-5 bg-white rounded-lg shadow-md">
                <div class="flex flex-col gap-3">
                    <div :class="[mouseover_index==index? 'flex gap-2':'']">
                        <div class="whitespace-pre-line flex-grow">
                            <div v-if="edit_index==index" class="flex justify-center">
                                <textarea
                                    v-model="edit_text"
                                    @focus="is_focused=true"
                                    @blur="is_focused=false;edit_index=-1"
                                    @keydown="e => enterkey_process(e, index)"
                                    :class="['w-full field-sizing-content p-2 border outline-none resize-none rounded-xl',
                                    is_focused ? 'border-blue-400' : 'border-gray-300']"
                                    :rows="edit_rows"
                                    :ref="e => { edit_textarea = e }"
                                ></textarea>
                            </div>
                            <div v-else>
                                <span v-for="str in url_check(memo.text)">
                                    <span v-if="str[1] === 0">{{ str[0] }}</span>
                                    <span v-else>
                                        <a :href="str[0]" target="_blank" class="text-blue-500 underline hover:text-blue-700">{{ str[0] }}</a>
                                    </span>
                                </span>
                            </div>
                        </div>
                        <div v-if="mouseover_index==index && modal_open==false" class="flex gap-2">
                            <EditSvg @click="update_editdata(index, memo.text)"/>
                            <TrashSvg @click="modal_open=true;modal_index=index" />
                        </div>
                    </div>
                    <img v-if="memo.image" :src="memo.image" class="w-[200px]">
                    <div class="text-xs text-gray-500">
                        {{show_time(memo.created_at)}}
                    </div>
                    <Teleport to="body">
                        <div class="flex justify-center items-center">
                            <div v-if="modal_open" class="modal bg-white flex flex-col items-center justify-center gap-7 rounded-2xl shadow-md border border-gray-300">
                                <p>メモを削除しますか？</p>
                                <div class="flex justify-center gap-3">
                                    <button type="button" @click="delete_memo(modal_index);modal_open=false" class="h-10 w-20 focus:outline-none text-white bg-red-700 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm dark:bg-red-600 dark:focus:ring-red-900">削除</button>
                                    <button type="button" @click="modal_open=false" class="h-10 w-20 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">キャンセル</button>
                                </div>
                            </div>
                        </div>
                    </Teleport>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 250px;
    height: 180px;
    z-index: 1000;
}
</style>
