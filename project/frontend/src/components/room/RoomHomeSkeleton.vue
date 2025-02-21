<template>
  <div class="room">
    <div class="room-title shimmer w-1/2 h-6 mb-4"></div>
    <div class="room-img shimmer mb-5"></div>
    <ul class="room-features">
      <li class="shimmer w-3/4 h-4 mb-2.5"></li>
      <li class="shimmer w-2/3 h-4 mb-2.5"></li>
      <li class="shimmer w-3/4 h-4 mb-2.5"></li>
    </ul>
    <div class="shimmer w-1/2 h-10 mx-auto mb-4"></div>
    <div class="room-price shimmer w-1/3 h-6 mx-auto"></div>
  </div>
</template>

<style scoped lang="scss">
.room {
  background-color: $white;
  @apply rounded-2xl text-left flex flex-col;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  padding: 30px 60px 40px;
  
  &__block {
    @apply flex justify-center flex-wrap;
    gap: 20px 120px;
  }
  &-price {
    @apply mt-4 text-base text-center font-bold;
    color: $light-black;
  }

  & img {
    @apply mb-5 rounded;
    width: 300px;
    height: 225px;
  }

  &-title {
    @apply text-xl mb-4;
    font-weight: 600;
    color: $light-black;
  }

  &-features {
    @apply text-sm list-none p-0 mb-11;

    & li {
      @apply mb-2.5 relative pl-5;
      color: $light-black;
    }
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

.room-img {
  width: 300px;
  height: 225px;
  @apply bg-gray-200 rounded;
}
</style>