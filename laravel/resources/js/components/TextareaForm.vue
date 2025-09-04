<script setup lang="ts">
import PlusSvg from "@/components/svgs/PlusSvg.vue";
</script>

<template>
    <div class="flex justify-center">
        <div class="bg-white w-[600px] h-[300px] m-10 rounded-2xl">
            <div class="flex justify-start items-center m-[1.5em] gap-[0.3em]">
                <PlusSvg size=28></PlusSvg>
                <div class="text-lg">新しいメモ</div>
            </div>
            <div class="flex justify-center m-2">
                <textarea class="w-full ms-5 me-5 h-[100px]">こんにちは</textarea>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
