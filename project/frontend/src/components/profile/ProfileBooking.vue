<template>
  <section
    v-if="!isLoading"
    class="booking"
  >
    <h2 class="booking__title">Ваши забронированные комнаты:</h2>
    <div class="booking__list">
      <reservation-card
        v-for="reservation in reservations"
        :key="reservation.id"
        :reservation="reservation"
      />
    </div>
    <div
      v-if="reservations.length < 1"
      class="flex flex-col gap-5 mx-auto items-center"
    >
      <h3 class="text-lg font-medium tracking-wide">У вас пока нету забронированных комнат</h3>
      <router-link
        to="catalog"
        class="bg-gray-300 p-2 rounded hover:bg-gray-400 transition"
      >
        Перейти в каталог
      </router-link>
    </div>
  </section>
</template>

<script setup>
defineProps({
  isLoading:{
    type: Boolean,
    required: true,
  },
  reservations:{
    type: Array,
    required: true,
  }
})
import { ReservationCard } from "@/components";
</script>

<style scoped lang="scss">
.booking {
  @apply flex flex-col gap-5 mb-10;

  &__title {
    @apply font-semibold text-lg tracking-wide;
  }

  &__list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    @apply gap-x-10 gap-y-14;
  }
}
</style>