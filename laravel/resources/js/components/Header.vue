
<script setup lang="ts">

import DocumentSvg from "@/components/svgs/DocumentSvg.vue";
</script>

<template>
    <div class="flex-title-subtitle">
        <div class="flex-icon-title">
            <DocumentSvg size="40"></DocumentSvg>
            <div class="title-setting">かんたんメモ</div>
        </div>
        <div class="subtitle-setting">思いついたことをサッと記録しよう</div>
    </div>
</template>

<style scoped>
.flex-icon-title {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.7em;
    padding: 0.2em;
}
.flex-title-subtitle {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.0em;
    padding-top: 1.0em;
    padding-bottom: 2.0em;
}
.title-setting {
    font-size: 30px;
    color: #FF6347;
}
.subtitle-setting {
    font-size: 13px;
}
</style>
