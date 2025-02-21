<script setup>
defineProps({
  area: {
    type: Number,
    required: true,
  },
  selected: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(['change']);
</script>

<template>
  <label class="filter__checkbox-label">
    <input
      type="checkbox"
      class="filter__checkbox"
      :checked="selected"
      @change="emit('change')"
    />
    <span>{{ area }} м&sup2;</span>
  </label>
</template>


<style scoped lang="scss">
.filter__checkbox {
  @apply h-4 w-4 rounded border-gray-300;
  &-label {
    @apply flex items-center space-x-2;
  }
}
</style>