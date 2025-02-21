<template>
  <div>
    <div
      class="room__container"
    >
      <div class="room__gallery">
        <div class="room__gallery-main shimmer"></div>
        <div class="room__gallery-thumbnails">
          <div
            v-for="index in 3"
            :key="index"
            class="shimmer thumbnail-shimmer"
          ></div>
        </div>
      </div>

      <div class="room__details">
        <div class="room__details-title shimmer"></div>

        <div class="room__details-info">
          <div class="room__details-text shimmer"></div>
          <div class="room__details-text shimmer"></div>
          <div class="room__details-text shimmer"></div>
          <div class="room__details-text shimmer"></div>
          <div class="room__details-text shimmer price-shimmer"></div>
        </div>

        <div class="room__equipment">
          <div class="room__equipment-title shimmer"></div>
          <div class="flex flex-wrap gap-2">
            <div
              v-for="index in 3"
              :key="index"
              class="room__equipment-item shimmer"
            ></div>
          </div>
        </div>

        <div class="room__button shimmer"></div>
      </div>
    </div>
    <random-room-skeleton/>
  </div>
</template>

<style scoped lang="scss">
.room{
  &__container {
    @apply flex gap-5 m-5;
  }
  &__gallery{
    @apply flex-1;

    &-main {
      @apply w-full h-72 bg-gray-300 rounded-lg;
    }
    &-thumbnails {
      @apply flex gap-2 mt-2;

      .thumbnail-shimmer {
        @apply w-1/3 h-32 bg-gray-300 rounded-lg;
      }
    }
  }
  &__details {
    @apply flex flex-col gap-6 flex-1;

    &-title {
      @apply w-2/3 h-8 bg-gray-300 rounded;
    }

    &-info {
      @apply bg-gray-100 p-6 rounded-lg shadow-md;

      .room__details-text {
        @apply w-1/2 h-6 bg-gray-300 rounded mb-2;

        &.price-shimmer {
          @apply w-full h-8 mt-10;
        }
      }
    }
  }
  &__button {
    @apply w-full h-12 bg-gray-300 rounded mt-6;
  }
  &__equipment {
    @apply mt-4 p-4 rounded-lg shadow-md;

    &-title {
      @apply w-1/3 h-6 bg-gray-300 rounded mb-2;
    }

    &-item {
      @apply w-1/5 h-6 bg-gray-300 rounded-full mb-2;
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
import RandomRoomSkeleton from "@/components/room/RandomRoomSkeleton.vue";
</script>