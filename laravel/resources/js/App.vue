<script setup lang="ts">
import Header from "./components/Header.vue";
import TextareaForm from "@/features/MemoPage/TextareaForm.vue";
import MemoView from "@/features/MemoPage/MemoView.vue";
import MemoPage from "@/pages/MemoPage.vue";
import MainPage from "@/pages/MainPage.vue";
</script>

<template>
    <Header />
    <router-view />
</template>

<style>
body {
    background-color: antiquewhite;
}
</style>
