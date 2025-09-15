<script setup lang="ts">
import { useRoute } from 'vue-router'
import { ref } from 'vue'
import { onMounted } from 'vue'

const route = useRoute();
const fullurl = ref('')

onMounted(()=>{
    fullurl.value = window.location.origin + route.fullPath
})

const copy_to_clipboard = () => {
    navigator.clipboard.writeText(fullurl.value)
}

</script>

<template>
    <div class="flex justify-center items-center mt-7 mb-5 gap-3">
        <div class="flex w-[600px] gap-5">
            <div class="grow">
                <input :value="fullurl" class="w-full col-span-6 bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
          </div>
            <div class="grow-0">
                <button type="button" @click="copy_to_clipboard" class="text-white bg-orange-500 hover:bg-orange-600 focus:ring-4 focus:ring-orange-300 font-medium rounded-lg text-sm px-5 py-2.5">コピー</button>
            </div>
            </div>
        </div>
</template>

<style scoped>

</style>
