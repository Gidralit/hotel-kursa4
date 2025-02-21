<script setup>
import {useMainStore} from "@/stores/MainStore.js";
import {storeToRefs} from "pinia";
import {onMounted} from "vue";
import HomeAboutSkeleton from "@/components/home-page/about/HomeAboutSkeleton.vue";

const { getMainInfo } = useMainStore();
const { data } = storeToRefs(useMainStore())

onMounted(async () => {
  await getMainInfo();
})
</script>

<template>
  <div>
    <div v-if="data">
      <div class="about__info-block">
        <h4 class="font-semibold">Адрес</h4>
        <p>{{ data.adress }}</p>
      </div>
      <div class="about__info-block">
        <h4 class="font-semibold">Телефон</h4>
        <p>{{ data.phone }}</p>
      </div>
      <div class="about__info-block">
        <h4 class="font-semibold">Email</h4>
        <p>{{ data.email }}</p>
      </div>
      <div class="about__info-block">
        <h4 class="font-semibold">Время работы</h4>
        <p>{{ data.worktime }}</p>
      </div>
      <p class="mt-8">Присоединяйтесь к нам!</p>
      <div class="about__messengers">
        <a
          :href="data.tg"
          target="_blank"
          class="about__telegram"
        >
          <img
            alt="telegram"
            src="@/assets/images/home-page/telegram.svg"
          >
        </a>
        <a
          :href="data.vk"
          target="_blank"
        >
          <img
            alt="vk"
            src="@/assets/images/home-page/vk.svg"
          >
        </a>
        <a
          :href="data.whatsapp"
          target="_blank"
        >
          <img
            alt="whatsapp"
            src="@/assets/images/home-page/whatsapp.svg"
          >
        </a>
      </div>
    </div>

    <home-about-skeleton v-else/>
  </div>
</template>
<style scoped lang="scss">
.about{
  &__info-block{
    @apply flex flex-col mt-2;
  }
  &__messengers{
    @apply flex gap-1 items-center mt-3;
    & img{
      width: 32px;
    }
  }
}
</style>

