<template>
  <div class="filter__group">
    <h3 class="filter__subtitle">Оснащение</h3>
    <div class="filter__checkbox-group">
      <filter-equipment
        v-for="equipment in equipments"
        :key="equipment.id"
        :equipment="equipment"
        :selected="selectedEquipments.includes(equipment.id)"
        @change="toggleEquipment(equipment)"
      />
    </div>
  </div>
</template>

<script setup>
import { FilterEquipment } from "@/components";
import { ref, watch } from 'vue';

const props = defineProps({
  equipments: {
    type: Array,
    required: true,
  },
  selected: {
    type: Array,
    default: () => [],
  },
});

const selectedEquipments = ref([...props.selected]);

const emit = defineEmits(['update:selected']);

const toggleEquipment = (equipment) => {
  if (selectedEquipments.value.includes(equipment.id)) {
    selectedEquipments.value = selectedEquipments.value.filter(id => id !== equipment.id);
  } else {
    selectedEquipments.value.push(equipment.id);
  }
  emit('update:selected', selectedEquipments.value);
};

// Следим за изменением `selected` и обновляем `selectedEquipments`
watch(() => props.selected, (newVal) => {
  selectedEquipments.value = [...newVal];
});
</script>

<style scoped lang="scss">
.filter {
  &__group {
    @apply mb-4;
  }

  &__subtitle {
    @apply text-sm font-medium mb-2;
  }

  &__checkbox-group {
    @apply space-y-2;
  }


}
</style>