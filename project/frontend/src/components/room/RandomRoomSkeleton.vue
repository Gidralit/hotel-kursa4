<template>
  <div class="flex justify-between my-10">
    <div
      v-for="room in [1, 2, 3]"
      :key="room"
      class="room"
    >
      <div class="room__img shimmer"></div>
      <div class="room__info w-3/4 h-6 shimmer mt-4"></div>
    </div>
  </div>
</template>

<style scoped lang="scss">
.room {
  @apply flex flex-col items-center shadow-md p-5 w-1/4;

  &__img {
    height: 300px;
    @apply w-full bg-gray-200 rounded;
  }

  &__info {
    @apply text-lg mt-2 h-6 w-3/4 bg-gray-200 rounded;
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
