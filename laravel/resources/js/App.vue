<script setup lang="ts">
import Header from "./components/Header.vue";
import TextareaForm from "@/components/TextareaForm.vue";
</script>

<template>
    <Header class="header-color"></Header>
    <TextareaForm></TextareaForm>
</template>

<style>
body {
    background-color: antiquewhite;
}
.header-color {
    background-color: white;
}
</style>
