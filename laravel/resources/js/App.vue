<script setup lang="ts">
import Header from "./components/Header.vue";
import TextareaForm from "@/components/TextareaForm.vue";
import MemoView from "@/components/MemoView.vue";
import MemoPage from "@/components/MemoPage.vue";
</script>

<template>
    <Header class="header-color"></Header>
    <MemoPage />
</template>

<style>
body {
    background-color: antiquewhite;
}
.header-color {
    background-color: white;
}
</style>
