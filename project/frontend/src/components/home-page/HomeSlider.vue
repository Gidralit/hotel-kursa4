<template>
  <div
    id="gallery"
    class="slider max-w-6xl mx-auto mt-20"
  >
    <h2 class="slider__title">Фотогалерея</h2>
    <div class="slider__wrapper">
      <div class="slider__track">
        <div
          v-for="(slide, index) in slides"
          :key="index"
          :class="['slider__slide', { 'slider__slide--active': index === currentSlide }]"
          :style="getSlideStyle(index)"
        >
          <img
            :src="slide"
            alt="Cat photo"
            class="slider__image"
          />
        </div>
      </div>
    </div>
  </div>
  <div class="w-full flex justify-center mt-8 gap-10">
    <button
      class="slider__button slider__button--prev"
      @click="prevSlide"
    >
      ❮
    </button>
    <button
      class="slider__button slider__button--next"
      @click="nextSlide"
    >
      ❯
    </button>
  </div>
</template>

<script setup>
import { ref } from "vue";

const slides = ref([
  `${import.meta.env.VITE_API_URL}storage/rooms/photo1.jpeg`,
  `${import.meta.env.VITE_API_URL}storage/rooms/photo2.png`,
  `${import.meta.env.VITE_API_URL}storage/rooms/photo3.jpg`,
  `${import.meta.env.VITE_API_URL}storage/rooms/photo4.jpg`,
  `${import.meta.env.VITE_API_URL}storage/rooms/photo5.jpg`
]);

const currentSlide = ref(0);

const nextSlide = () => {
  currentSlide.value = (currentSlide.value + 1) % slides.value.length;
};

const prevSlide = () => {
  currentSlide.value = (currentSlide.value - 1 + slides.value.length) % slides.value.length;
};

const getSlideStyle = (index) => {
  const offset = index - currentSlide.value;

  if (offset === 0) {
    return {
      transform: "translateX(0) scale(1)",
      zIndex: 10,
      opacity: 1,
    };
  } else if (offset === -1 || offset === slides.value.length - 1) {
    return {
      transform: "translateX(-50%) scale(0.8)",
      zIndex: 5,
      opacity: 0.6,
    };
  } else if (offset === 1 || offset === -(slides.value.length - 1)) {
    return {
      transform: "translateX(50%) scale(0.8)",
      zIndex: 5,
      opacity: 0.6,
    };
  } else {
    return {
      transform: `translateX(60%)`,
      zIndex: 0,
      opacity: 0,
    };
  }
};
</script>

<style lang="scss" scoped>
.slider {
  @apply bg-white p-12 rounded-lg shadow-md;

  &__title {
    @apply text-center text-2xl font-bold mb-6;
  }

  &__wrapper {
    @apply overflow-hidden w-full h-64 flex justify-center items-center;
  }

  &__track {
    @apply relative w-full h-full flex items-center justify-center;
  }

  &__slide {
    @apply absolute top-0 left-0 w-full h-64 transition-all duration-500 flex items-center justify-center;
    opacity: 0;
    transform: scale(0.8);
  }

  &__slide--active {
    @apply opacity-100 scale-100;
  }

  &__image {
    @apply rounded-lg object-cover w-3/6 h-72;
  }

  &__button {
    @apply bg-teal-500 text-white rounded-full w-10 h-10 hover:bg-teal-600 focus:outline-none;
    pointer-events: auto;
  }
}
</style>
