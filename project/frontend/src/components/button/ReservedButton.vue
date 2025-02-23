<template>
  <button
    v-if="isAuthenticated"
    class="link"
  >
    Забронировать
  </button>
  <router-link
    v-else
    to="/register"
    class="link"
  >
    Забронировать
  </router-link>
</template>

<script setup>
import {storeToRefs} from "pinia";
import {useAuthStore} from "@/stores/AuthStore.js";

const { isAuthenticated } = storeToRefs(useAuthStore());
</script>

<style scoped lang="scss">
.link{
  @apply flex items-center text-white p-2.5 justify-center max-w-48 tracking-wide rounded-lg;
  background: $green;
  color: $white !important;
  font-weight: 600;
  transition: all 0.3s ease-in-out;
  cursor: pointer;
  &:hover{
    background: $green-hover;
  }
}
</style>