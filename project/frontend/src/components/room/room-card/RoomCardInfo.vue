<script setup>
import ReservedButton from "@/components/button/ReservedButton.vue";
defineProps({
  room: {
    type: Object,
    required: true
  }
})
const emit = defineEmits(['start'])
</script>

<template>
  <div class="room__details">
    <h2 class="room__details-title">{{ room.name }}</h2>

    <div class="room__details-info">
      <p class="room__details-text">
        Ширина: <span>{{ room.width }} м</span>
      </p>
      <p class="room__details-text">
        Длина: <span>{{ room.length }} м</span>
      </p>
      <p class="room__details-text">
        Высота: <span>{{ room.height }} м</span>
      </p>
      <p class="room__details-text">
        Площадь: <span>{{ room.area }} м&sup2;</span>
      </p>
      <p class="room__details-text bg-white p-1.5 rounded mt-10">
        Цена: <span>{{ room.price }} руб.</span>
      </p>
    </div>

    <div
      v-if="room.equipment && room.equipment.length > 0"
      class="room__equipment"
    >
      <h3 class="room__equipment-title">Оборудование:</h3>
      <ul class="room__equipment-list">
        <li
          v-for="item in room.equipment"
          :key="item.id"
          class="room__equipment-item"
        >
          {{ item.name }}
        </li>
      </ul>
    </div>

    <reserved-button
      class="max-w-full"
      @click="emit('start', room.id)"
    />
  </div>
</template>

<style scoped lang="scss">
.room__details {
  @apply flex flex-col gap-6 flex-1;

  &-title {
    @apply text-3xl font-bold text-gray-700;
  }

  &-info {
    @apply bg-gray-100 p-6 rounded-lg shadow-md;

    .room__details-text {
      @apply font-semibold text-gray-900 mb-2;

      span {
        @apply font-light text-gray-700;
      }
    }
  }

  &-book-btn {
    @apply mt-5 px-6 py-3 bg-blue-500 text-white text-lg font-medium rounded-lg hover:bg-blue-700 transition-colors;
  }
}

.room__equipment {
  @apply mt-4 bg-white p-4 rounded-lg shadow-md;

  &-title {
    @apply text-lg font-semibold mb-2 text-gray-800;
  }

  &-list {
    @apply flex flex-wrap gap-2;

    .room__equipment-item {
      @apply bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold;
    }
  }
}
</style>