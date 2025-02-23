<template>
  <div
    v-if="filters"
    class="filter"
  >
    <h2 class="filter__title">Фильтры</h2>
    <div class="filter__group">
      <filter-price-input
        v-model="minPrice"
        :min="filters.min_price"
        :max="filters.max_price"
      >
        Минимальная цена
      </filter-price-input>
      <filter-price-input
        v-model="maxPrice"
        :min="filters.min_price"
        :max="filters.max_price"
      >
        Максимальная цена
      </filter-price-input>
    </div>
    <filter-areas
      v-model:selected="selectedAreas"
      :areas="filters.areas"
    />
    <filter-equipments
      v-model:selected="selectedEquipments"
      :equipments="filters.equipments"
    />
    <filter-buttons
      @apply="applyFilters"
      @reset="resetFilters"
    />
  </div>
  <catalog-filters-skeleton v-else />
</template>

<script setup>
import { FilterPriceInput, FilterAreas, FilterEquipments, FilterButtons, CatalogFiltersSkeleton } from '@/components';
import { useCatalogStore } from "@/stores/CatalogStore.js";
import { onMounted, ref } from "vue";
import { storeToRefs } from "pinia";

const catalogStore = useCatalogStore();
const { filters, params } = storeToRefs(catalogStore);

// Локальные значения для фильтров
const selectedAreas = ref([]);
const selectedEquipments = ref([]);
const minPrice = ref(null);
const maxPrice = ref(null);

onMounted(async () => {
  await catalogStore.getFilters();
  minPrice.value = filters.value.min_price;
  maxPrice.value = filters.value.max_price;
});

const applyFilters = async () => {
  params.value.area = selectedAreas.value;
  params.value.equipment = selectedEquipments.value;
  params.value.min_price = minPrice.value;
  params.value.max_price = maxPrice.value;
  await catalogStore.applyFilters();
};

const resetFilters = async () => {
  selectedAreas.value = [];
  selectedEquipments.value = [];
  minPrice.value = filters.value.min_price;
  maxPrice.value = filters.value.max_price;
  await catalogStore.resetFilters();
};
</script>

<style scoped lang="scss">
.filter {
  @apply w-full max-w-xs bg-white shadow-md rounded-lg p-6 h-fit;
  position: sticky;
  top: 80px;

  &__title {
    @apply text-lg font-semibold mb-4;
  }

  &__group {
    @apply mb-4;
  }
}
</style>
