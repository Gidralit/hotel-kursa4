<script setup>
import TheHeaderLogo from '@/components/header/TheHeaderLogo.vue'
import TheHeaderNav from '@/components/header/TheHeaderNav.vue'

import {onMounted} from "vue";
import {storeToRefs} from "pinia";
import {useMainStore} from "@/stores/MainStore.js";

const { getMainInfo } = useMainStore();
const { city, slogan } = storeToRefs(useMainStore())

onMounted(async () => {
  await getMainInfo();
})

</script>

<template>
  <header
    v-if="city"
    class="header"
  >
    <div class="flex justify-between">
      <router-link to="/"><the-header-logo/></router-link>
      <div class="flex gap-20">
        <the-header-nav/>
        <span
          class="header__city"
        >
          <b>Город</b> - {{ city }}
        </span>
      </div>
    </div>
    <span class="header__slogan">{{ slogan }}</span>
  </header>
</template>

<style scoped lang="scss">
.header{
  @apply flex flex-col w-full p-4;
  color: $light-black;

  &__slogan{
    color: $light-gray;
    font-size: 14px;
  }
}
</style>