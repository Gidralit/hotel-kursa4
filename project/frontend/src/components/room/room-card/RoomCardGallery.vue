<template>
  <div class="room__gallery">
    <div
      v-if="room.photos.length > 0"
      class="room__gallery-main"
    >
      <img
        :src="room.photos[0].photo"
        alt="Main Photo"
        @click="emit('open', 0)"
      />
    </div>
    <div
      v-else
      class="room__gallery-main"
    >
      <img
        src="@/assets/images/no-image.png"
        alt="no-image"
      >
    </div>

    <div
      v-if="room.photos.length > 1"
      class="room__gallery-thumbnails"
    >
      <img
        v-for="(photo, index) in room.photos.slice(1)"
        :key="index"
        :src="photo.photo"
        alt="Thumbnail"
        @click="emit('open', index + 1)"
      />
    </div>
  </div>
</template>

<script setup>
defineProps({
  room: {
    type: Object,
    required: true
  }
});

const emit = defineEmits(['open']);
</script>

<style scoped lang="scss">
.room__gallery {
  @apply flex flex-col flex-1;

  &-main img {
    @apply w-full h-80 object-cover cursor-pointer rounded-lg;
  }

  &-thumbnails {
    @apply flex gap-2 mt-2;

    img {
      @apply w-1/3 h-32 object-cover cursor-pointer border-2 border-transparent hover:border-green-500 rounded-lg;
    }
  }
}
</style>
