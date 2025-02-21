<script setup>
import RandomRoom from "@/components/room/RandomRoom.vue";
import { RoomCardInfo, RoomCardGallery, RoomCardLightbox } from '@/components/room/room-card/index.js'
import { ref } from "vue";

const props = defineProps({
  room: {
    type: Object,
    required: true
  },
  randomRooms: {
    type: Array,
    required:true
  }
});

const emit = defineEmits(['start-book']);

const showLightbox = ref(false);
const currentImageIndex = ref(0);

const openLightbox = (index) => {
  currentImageIndex.value = index;
  showLightbox.value = true;
};

const closeLightbox = () => {
  showLightbox.value = false;
};

const prevImage = () => {
  if (currentImageIndex.value > 0) {
    currentImageIndex.value--;
  }
};

const nextImage = () => {
  if (currentImageIndex.value < props.room.photos.length - 1) {
    currentImageIndex.value++;
  }
};

</script>

<template>
  <div>
    <div class="room__container">
      <room-card-gallery
        :room="props.room"
        @open="openLightbox"
      />

      <room-card-info
        :room="room"
        @start="emit('start-book', room.id)"
      />

      <room-card-lightbox
        v-if="showLightbox"
        :room="room"
        :current-image-index="currentImageIndex"
        @click.self="closeLightbox"
        @close="closeLightbox"
        @next="nextImage"
        @prev="prevImage"
      />
    </div>

    <div
      v-if="randomRooms"
      class="flex justify-between my-10"
    >
      <random-room
        v-for="randomRoom in randomRooms"
        :key="randomRoom.id"
        :random-room="randomRoom"
      />
    </div>
  </div>
</template>

<style scoped lang="scss">
.room__container {
  @apply flex gap-5 m-5;
}
</style>
