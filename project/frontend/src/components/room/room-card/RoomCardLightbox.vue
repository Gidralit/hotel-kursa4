<template>
  <div class="room__lightbox">
    <button
      class="room__lightbox-close"
      @click="emit('close')"
    >
      &times;
    </button>
    <button
      class="room__lightbox-nav room__lightbox-nav--prev"
      :disabled="currentImageIndex === 0"
      @click="emit('prev')"
    >
      &#10094;
    </button>
    <img
      :src="room.photos[currentImageIndex].photo"
      class="room__lightbox-image"
      alt="room-image"
    />
    <button
      class="room__lightbox-nav room__lightbox-nav--next"
      :disabled="currentImageIndex === room.photos.length - 1"
      @click="emit('next')"
    >
      &#10095;
    </button>
  </div>
</template>

<script setup>
import { onMounted, onUnmounted } from "vue";

defineProps({
  room: {
    type: Object,
    required: true,
  },
  currentImageIndex: {
    type: Number,
    required: true,
  },
});

const emit = defineEmits(['close', 'prev', 'next']);

const handleKeydown = (event) => {
  if (event.key === 'Escape') {
    emit('close');
  } else if (event.key === 'ArrowLeft') {
    emit('prev');
  } else if (event.key === 'ArrowRight') {
    emit('next');
  }
};

onMounted(() => {
  window.addEventListener('keydown', handleKeydown);
});

onUnmounted(() => {
  window.removeEventListener('keydown', handleKeydown);
});
</script>

<style scoped lang="scss">
.room__lightbox {
  @apply fixed top-0 left-0 w-full h-full bg-black bg-opacity-90 flex justify-center items-center z-50;

  &-close {
    @apply absolute top-5 right-7 text-white text-4xl cursor-pointer;
  }

  &-nav {
    @apply absolute top-1/2 text-white text-4xl bg-black bg-opacity-50 px-4 py-2 rounded-full disabled:opacity-50 disabled:cursor-not-allowed;

    &--prev {
      @apply left-5;
    }

    &--next {
      @apply right-5;
    }
  }

  &-image {
    @apply max-w-[90%] max-h-[80%] rounded-lg shadow-lg;
  }
}
</style>
