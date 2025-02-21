<script setup>
import { useCatalogStore } from '@/stores/CatalogStore.js';
import { useRoomsStore } from '@/stores/RoomsStore.js';
import { storeToRefs } from 'pinia';
import { onMounted } from 'vue';

const catalogStore = useCatalogStore();
const roomsStore = useRoomsStore();
const { params } = storeToRefs(catalogStore);
const { isLoading } = storeToRefs(roomsStore);

const emitSort = async () => {
  await catalogStore.updateSortOrder(params.value.sort_order);
};

onMounted(async () => {
  await roomsStore.getRooms();
});
</script>

<template>
  <div class="sort">
    <div class="flex flex-col">
      <label
        for="sortSelect"
        class="sort__label"
      >
        Сортировать по цене:
      </label>
      <select
        id="sortSelect"
        v-model="params.sort_order"
        class="sort__select"
        @change="emitSort"
      >
        <option value="asc">По возрастанию</option>
        <option value="desc">По убыванию</option>
      </select>
    </div>

    <div
      v-if="isLoading"
      class="loading-spinner"
    >
      <div class="spinner"></div>
      <span>Загрузка...</span>
    </div>
  </div>
</template>

<style lang="scss">
.sort {
  @apply flex space-y-2 items-center gap-4;

  &__label {
    @apply text-sm font-medium text-gray-700;
  }

  &__select {
    @apply w-48 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500;
  }
}

.loading-spinner {
  @apply flex items-center space-x-2 mt-4 text-green-500;

  .spinner {
    @apply w-6 h-6 border-4 border-t-green-500 border-gray-200 rounded-full animate-spin;
  }
}
</style>
