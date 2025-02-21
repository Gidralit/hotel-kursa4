<template>
  <div class="reservation__card">
    <div class="reservation__image shimmer"></div>

    <div class="reservation__details">
      <div class="reservation__title shimmer w-3/4 h-6 mb-4"></div>

      <div class="reservation__pets">
        <div class="reservation__pets-title shimmer w-1/4 h-5 mb-2"></div>
        <div class="reservation__pet-item shimmer w-1/2 h-4 mb-2"></div>
        <div class="reservation__pet-item shimmer w-1/3 h-4 mb-2"></div>
      </div>

      <div class="reservation__dates">
        <div class="reservation__date shimmer w-1/2 h-4 mb-2"></div>
        <div class="reservation__date shimmer w-1/2 h-4 mb-2"></div>
      </div>

      <div class="reservation__cancel-button shimmer w-1/3 h-10 mt-auto"></div>
    </div>
  </div>
</template>
<style lang="scss" scoped>
.reservation {
  &__card {
    @apply bg-white shadow-lg rounded-lg overflow-hidden flex flex-col;
    height: 100%;
  }

  &__image {
    @apply w-full h-40 object-cover;
    flex-shrink: 0;
  }

  &__details {
    @apply p-4 bg-gray-100 flex flex-col justify-between flex-grow;
  }

  &__title {
    @apply text-lg mb-3;
    span {
      @apply font-semibold tracking-wide;
    }
  }

  &__pets {
    @apply mb-3;
  }

  &__pets-title {
    @apply font-semibold mb-1;
  }

  &__pet-item {
    @apply text-gray-600;
  }

  &__dates {
    @apply mb-3;
  }

  &__date {
    @apply text-gray-700 mb-1;
  }

  &__cancel-button {
    @apply bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mt-auto;
  }
}

/* Шиммер-анимация */
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

.reservation__image.shimmer {
  @apply w-full h-40;
}
</style>

