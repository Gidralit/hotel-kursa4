<template>
  <router-link :to="`/room/${randomRoom.id}`">
    <div
      v-if="randomRoom"
      class="room"
    >
      <img
        v-if="randomRoom.photos && randomRoom.photos.length > 0"
        :src="randomRoom.photos[0].photo"
        alt="image-room"
        class="room__img"
      >
      <img
        v-else
        class="room__img"
        src="@/assets/images/no-image.png"
        alt="no-image"
      >
      <div class="room__info">
        <span>{{ randomRoom.name }}</span> - {{ randomRoom.price }} руб.
      </div>
    </div>
  </router-link>
</template>

<script setup>
defineProps({
  randomRoom:{
    type: Object,
    required: true
  }
})
</script>

<style scoped lang="scss">
.room{
  @apply flex flex-col items-center shadow-md p-5;

  &__img{
    @apply h-[300px] w-[310px];
  }
  &__info{
    @apply text-lg mt-2;
    span{
      @apply font-semibold;
    }
  }
}
</style>