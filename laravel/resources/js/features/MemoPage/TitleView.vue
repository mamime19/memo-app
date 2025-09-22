<script setup lang="ts">
import { defineProps } from 'vue'
const props = defineProps({
    title:{
        type: String
    }
})
</script>

<template>
    <div class="flex justify-center mt-9 mb-6">
        <div class="flex flex-col gap-3">
            <div class="text-4xl m-2">{{ props.title }}</div>
        </div>
    </div>
</template>

<style scoped>

</style>
