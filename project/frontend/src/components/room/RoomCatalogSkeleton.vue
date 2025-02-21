<template>
  <article class="room">
    <div class="room__img shimmer"></div>
    <div class="room__info">
      <div class="room__title shimmer"></div>
      <p class="room__size shimmer"></p>
      <p class="room__list-title shimmer"></p>
      <div class="room__list">
        <div class="room__list-item shimmer"></div>
        <div class="room__list-item shimmer"></div>
        <div class="room__list-item shimmer"></div>
      </div>
      <div class="room__price shimmer"></div>
      <div class="room__button shimmer"></div>
    </div>
  </article>
</template>

<style scoped lang="scss">
.room {
  width: 910px;
  @apply flex gap-16 py-10 px-12;
  box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.25);

  &__img {
    width: 350px;
    height: 350px;
    @apply bg-gray-300;
  }

  &__info {
    @apply flex flex-col;
  }

  &__title {
    width: 300px;
    height: 32px;
    margin-bottom: 20px;
    @apply bg-gray-300;
  }

  &__size {
    width: 200px;
    height: 24px;
    margin-bottom: 20px;
    @apply bg-gray-300;
  }

  &__list-title {
    width: 250px;
    height: 24px;
    margin-bottom: 10px;
    @apply bg-gray-300;
  }

  &__list {
    @apply list-none p-0 mb-7;

    &-item {
      width: 220px;
      height: 20px;
      margin-bottom: 10px;
      @apply bg-gray-300;
    }
  }

  &__price {
    width: 180px;
    height: 24px;
    margin-bottom: 60px;
    @apply bg-gray-300;
  }
  &__button{
    width: 100%;
    height: 44px;
  }

  .shimmer {
    position: relative;
    background: linear-gradient(
            90deg,
            rgb(211, 211, 211) 0%,
            rgba(240, 240, 240, 1) 50%,
            rgba(211, 211, 211, 1) 100%
    );
    background-size: 200% 100%;
    animation: shimmer 1.5s infinite linear;
    border-radius: 4px;
  }
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
