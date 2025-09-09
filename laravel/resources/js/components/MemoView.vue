<script setup lang="ts">
import DocumentSvg from "@/components/svgs/DocumentSvg.vue";
import TrashSvg from "@/components/svgs/TrashSvg.vue";
import EditSvg from "@/components/svgs/EditSvg.vue";
import axios from 'axios'
import { ref } from 'vue'
import { defineProps } from 'vue'
import {defineEmits} from 'vue'
import {watch} from 'vue'
import {nextTick} from 'vue'


const mouseover_index = ref(-1)
const edit_index = ref(-1)
const is_focused = ref(false)
const emit = defineEmits(['deleted','edited'])
const edit_text = ref('')
const message=ref('')
const edit_rows = ref(1)

const props = defineProps({
    memos: {
        type: Array,
        default: () => []
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
    const id=props.memos[index].id
    console.log(id)
    try {
        const response = await axios.delete('http://localhost:48080/api/memos/'+id.toString())
        const message = response.data.message
        console.log(message)
        console.log(index)
        emit('deleted', response.data.memo, index)
    } catch(error) {
        console.error(error)
        console.log('削除に失敗しました')
    }
}

watch(edit_text, ()=>{
    edit_rows.value = 1
    for(let i = 0; i < edit_text.value.length; i++) {
        if(edit_text.value[i] === '\n') {
            edit_rows.value++
        }
    }
})

const save = async (index: number) => {
    const id = props.memos[index].id
    try {
        const response = await axios.post('http://localhost:48080/api/memos/' + id.toString(), {
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
    <div v-for="(memo, index) in props.memos" class="flex justify-center">
        <div @mouseover="mouseover_index=index" @mouseleave="mouseover_index=-1" class="w-[650px] m-2 p-5 bg-white rounded-lg shadow-md">
            <div class="flex flex-col gap-3">
                <div :class="[mouseover_index==index? 'flex gap-2':'']">
                    <div class="whitespace-pre-line flex-grow">
                        <div v-if="edit_index==index" class="flex justify-center">
                            <textarea
                                v-model="edit_text"
                                @focus="is_focused=true"
                                @blur="is_focused=false"
                                @keydown="(e) => enterkey_process(e, index)"
                                :class="['w-full field-sizing-content p-2 border outline-none resize-none rounded-xl',
                                is_focused ? 'border-blue-400' : 'border-gray-300']"
                                :rows="edit_rows"
                            ></textarea>
                        </div>
                        <div v-else>
                            {{memo.text}}
                        </div>
                    </div>
                    <div v-if="mouseover_index==index" class="flex gap-2">
                        <EditSvg @click="edit_index=index,edit_text=memo.text"/>
                        <TrashSvg @click="delete_memo(index)"/>
                    </div>
                </div>
                <div class="text-xs text-gray-500">
                    {{show_time(memo.created_at)}}
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
