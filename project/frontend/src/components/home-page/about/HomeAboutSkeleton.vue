<template>
  <div>
    <div class="about__info-block">
      <h4 class="shimmer h-6 w-1/4"></h4>
      <p class="shimmer h-6 w-1/2 mt-1"></p>
    </div>
    <div class="about__info-block">
      <h4 class="shimmer h-6 w-1/4"></h4>
      <p class="shimmer h-6 w-1/2 mt-1"></p>
    </div>
    <div class="about__info-block">
      <h4 class="shimmer h-6 w-1/4"></h4>
      <p class="shimmer h-6 w-1/2 mt-1"></p>
    </div>
    <div class="about__info-block">
      <h4 class="shimmer h-6 w-1/4"></h4>
      <p class="shimmer h-6 w-1/2 mt-1"></p>
    </div>
    <p class="shimmer h-6 w-1/3 mt-8"></p>
    <div class="about__messengers">
      <div class="shimmer h-8 w-8 rounded-full"></div>
      <div class="shimmer h-8 w-8 rounded-full"></div>
      <div class="shimmer h-8 w-8 rounded-full"></div>
    </div>
  </div>
</template>

<style scoped lang="scss">
.about {
  &__info-block {
    @apply flex flex-col mt-2;
  }

  &__messengers {
    @apply flex gap-1 items-center mt-3;

    & img {
      width: 32px;
    }
  }
}

.shimmer {
  position: relative;
  background: linear-gradient(
          90deg,
          #e0e0e0 0%,
          #f0f0f0 50%,
          #e0e0e0 100%
  );
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