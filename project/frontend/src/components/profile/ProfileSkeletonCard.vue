<template>
  <div class="profile container">
    <div class="profile__avatar">
      <div class="profile__avatar-image shimmer"></div>
    </div>

    <div class="profile__info">
      <div class="profile__info-name shimmer"></div>

      <div class="profile__info-detail shimmer"></div>
      <div class="profile__info-detail shimmer"></div>
      <div class="profile__info-detail shimmer mt-8"></div>
      <div class="profile__info-detail shimmer"></div>
      <div class="profile__info-button shimmer"></div>
    </div>
  </div>
</template>

<style scoped lang="scss">
.profile {
  @apply my-12 mx-auto justify-between p-8 flex bg-white rounded-lg shadow-lg;
  width: 80% !important;

  &__avatar {
    @apply flex-shrink-0;

    &-image {
      @apply w-80 h-80 rounded-full border-4 border-gray-300 shadow-md;
    }
  }

  &__info {
    @apply w-7/12 bg-gray-50 p-6 rounded-lg shadow-md;

    &-name {
      @apply w-2/3 h-8 mb-4 rounded;
    }

    &-detail {
      @apply w-full h-6 mb-4 rounded;
    }
    &-button{
      @apply mt-8 p-5 w-48 rounded-lg bg-gray-600;
    }
  }


  .shimmer {
    position: relative;
    background: linear-gradient(
            90deg,
            rgb(211, 211, 211) 0%,
            rgba(240, 240, 240, 1) 50%,
            rgb(211, 211, 211) 100%
    );
    background-size: 200% 100%;
    animation: shimmer 1.5s infinite linear;
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
<script setup lang="ts">
</script>