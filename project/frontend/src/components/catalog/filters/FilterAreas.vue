<script setup>
import FilterArea from "@/components/catalog/filters/FilterArea.vue";
import { ref, watch } from 'vue';

const props = defineProps({
  areas: {
    type: Array,
    required: true,
  },
  selected: {
    type: Array,
    default: () => [],
  },
});

const selectedAreas = ref([...props.selected]);

const emit = defineEmits(['update:selected']);

const toggleArea = (area) => {
  if (selectedAreas.value.includes(area)) {
    selectedAreas.value = selectedAreas.value.filter(a => a !== area);
  } else {
    selectedAreas.value.push(area);
  }
  emit('update:selected', selectedAreas.value);
};

// Следим за изменением `selected` и обновляем `selectedAreas`
watch(() => props.selected, (newVal) => {
  selectedAreas.value = [...newVal];
});
</script>

<template>
  <div class="filter__group">
    <h3 class="filter__subtitle">Площадь</h3>
    <div class="filter__checkbox-group">
      <filter-area
        v-for="area in areas"
        :key="area"
        :area="area"
        :selected="selectedAreas.includes(area)"
        @change="toggleArea(area)"
      />
    </div>
  </div>
</template>



<style scoped lang="scss">
.filter {
  &__group {
    @apply mb-4;
  }

  &__subtitle {
    @apply text-sm font-medium mb-2;
  }

  &__checkbox-group {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.5rem;
  }

}
</style>