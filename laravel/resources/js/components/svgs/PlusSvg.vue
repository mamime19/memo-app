<script>
export default {
    props: {
        size: {
            type: Number,
            default: 20,
        },
        color: {
            type:String,
            default: "currentColor"
        },
    }
}
</script>

<template>

  <svg
    xmlns="http://www.w3.org/2000/svg"
    v-bind:width="size"
    v-bind:height="size"
    viewBox="0 0 24 24"
    fill="none"
    v-bind:stroke="color"
    stroke-width="2"
    stroke-linecap="round"
    stroke-linejoin="round"
    class="lucide lucide-plus text-primary-500"
  >
    <path d="M5 12h14"></path>
    <path d="M12 5v14"></path>
  </svg>
</template>
