<script setup lang="ts">
import Header from "./components/Header.vue";
import TextareaForm from "@/components/TextareaForm.vue";
import MemoView from "@/components/MemoView.vue";
import MemoPage from "@/components/MemoPage.vue";
import MainPage from "@/components/MainPage.vue";
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
