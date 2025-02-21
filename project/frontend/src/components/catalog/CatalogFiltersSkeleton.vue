<template>
  <div class="filter">
    <h2 class="shimmer h-6 w-1/4 mb-4 rounded"></h2>

    <div class="filter__group">
      <div class="shimmer h-5 w-1/3 mb-2 rounded"></div>
      <div class="shimmer h-10 w-full rounded"></div>
    </div>

    <div class="filter__group">
      <div class="shimmer h-5 w-1/3 mb-2 rounded"></div>
      <div class="shimmer h-10 w-full rounded"></div>
    </div>

    <div class="filter__group">
      <div class="shimmer h-5 w-1/4 mb-2 rounded"></div>
      <div class="grid grid-cols-2 gap-2">
        <div class="shimmer h-8 w-full rounded"></div>
        <div class="shimmer h-8 w-full rounded"></div>
        <div class="shimmer h-8 w-full rounded"></div>
        <div class="shimmer h-8 w-full rounded"></div>
      </div>
    </div>

    <div class="filter__group">
      <div class="shimmer h-5 w-1/4 mb-2 rounded"></div>
      <div class="space-y-2">
        <div class="shimmer h-8 w-full rounded"></div>
        <div class="shimmer h-8 w-full rounded"></div>
        <div class="shimmer h-8 w-full rounded"></div>
      </div>
    </div>

    <div class="filter__buttons">
      <div class="shimmer h-10 w-1/2 rounded"></div>
      <div class="shimmer h-10 w-1/2 rounded"></div>
    </div>
  </div>
</template>

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

  &__buttons {
    @apply flex space-x-2;
  }
}

.shimmer {
  position: relative;
  background: linear-gradient(90deg, #e0e0e0 0%, #f0f0f0 50%, #e0e0e0 100%);
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite linear;
  border-radius: 4px;
}

@keyframes shimmer {
  0% {
    background-position: -100% 0;
  }
  100% {
    background-position: 100% 0;
  }
}

</style>