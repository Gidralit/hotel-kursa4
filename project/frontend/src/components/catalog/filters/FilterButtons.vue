<script setup>
const emit = defineEmits(['apply', 'reset']);
</script>

<template>
  <div class="filter__buttons">
    <button
      class="filter__button filter__button--apply"
      @click="emit('apply')"
    >
      Применить
    </button>
    <button
      class="filter__button filter__button--reset"
      @click="emit('reset')"
    >
      Сбросить фильтр
    </button>
  </div>
</template>

<style scoped lang="scss">
.filter {
  &__buttons {
    @apply flex space-x-2;
  }

  &__button {
    @apply w-full py-2 rounded-md text-sm focus:outline-none;

    &--apply {
      @apply bg-green-500 text-white hover:bg-green-600 focus:ring focus:ring-green-300;
    }

    &--reset {
      @apply bg-gray-200 text-gray-700 hover:bg-gray-300 focus:ring focus:ring-gray-300;
    }
  }
}
</style>
