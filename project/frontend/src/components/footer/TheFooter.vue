<template>
  <footer class="footer">
    <the-footer-nav/>
    <p class="text-sm text-gray-500 mt-4 ml-10">Правовая информация</p>
  </footer>
</template>

<script setup>
import { TheFooterNav } from "@/components";
</script>

<style scoped lang="scss">
.footer {
  @apply flex flex-col w-full items-center border-t border-gray-300 py-4;
}
</style>
