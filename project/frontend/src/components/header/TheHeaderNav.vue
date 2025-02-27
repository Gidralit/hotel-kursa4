<template>
  <nav class="header__menu flex gap-8">
    <router-link
      class="header__link"
      to="/catalog"
    >
      Каталог номеров
    </router-link>
    <template v-if="isAuthenticated">
      <router-link
        class="header__link"
        to="/profile"
      >
        Профиль
      </router-link>

      <button
        class="header__link"
        @click="authStore.logout"
      >
        Выйти
      </button>
    </template>
    
    <div
      v-if="!isAuthenticated"
      class="flex gap-1"
    >
      <router-link
        to="/register"
        class="header__link"
      >
        Вход
        &frasl;
        Регистрация
      </router-link>
    </div>
  </nav>
</template>

<script setup>
import { useAuthStore } from '@/stores/AuthStore.js';
import {storeToRefs} from "pinia";

const { isAuthenticated } = storeToRefs(useAuthStore());
const authStore = useAuthStore();
</script>

<style scoped lang="scss">
.header__menu{
  a{
    transition: all 0.3s ease;
    &:hover{
      color: $black;
    }
  }
}
</style>