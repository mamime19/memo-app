<script setup lang="ts">
import PlusSvg from "@/components/svgs/PlusSvg.vue";
import { ref,computed } from 'vue'
const is_focused = ref(false)
const is_composing = ref(false)
const text = ref('')
const is_disabled = computed(()=>{
    return !is_composing.value && text.value.trim()　== ''
})
</script>

<template>
    <div class="flex justify-center">
        <div class="bg-white w-[650px] h-[325px] m-10 rounded-2xl">
            <div class="flex justify-start items-center m-[1.4em] gap-[0.3em]">
                <PlusSvg size=28></PlusSvg>
                <div class="text-lg">新しいメモ</div>
            </div>
            <div class="flex justify-center m-2">
                <textarea v-model="text" @focus="is_focused=true" @blur="is_focused=false" @compositionstart="is_composing=true" @compositionend="is_composing=false" :class="['w-full ms-5 me-5 p-3 h-[150px] text-md rounded-lg border resize-none outline-none transition-colors duration-200',is_focused ? 'border-blue-400' : 'border-gray-300']" placeholder="メモを入力してください... &#13; （Enterで保存、Shift+Enterで改行）"></textarea>
            </div>
            <div class="flex justify-center m-2">
                <button :class="['w-full bg-gradient-to-r from-orange-400 via-orange-500 to-orange-600 text-white font-bold mt-3 ms-5 me-5 p-3 rounded-lg', is_disabled ? 'opacity-50 cursor-not-allowed':'']">
                    <div class="flex justify-center items-center gap-1">
                        <PlusSvg color="white"/>
                        メモを保存
                    </div>
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
