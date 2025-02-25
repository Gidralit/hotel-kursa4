<template>
  <div>
    <room-card
      v-if="room"
      :key="route.params.id"
      :room="room"
      :random-rooms="randomRooms"
      @start-book="startBook(room.id)"
    />
    <room-card-skeleton v-else />

    <booking-modal
      v-if="book"
      :room-id="selectedRoomId"
      @cancel="cancelBook"
      @success="cancelBook"
    />
  </div>
</template>

<script setup>
import {ref, onMounted, watch} from 'vue';
import { useRoute } from 'vue-router';
import { RoomCard, RoomCardSkeleton, BookingModal } from '@/components'

import {useRoomsStore} from "@/stores";
import {storeToRefs} from "pinia";

const { getRooms, getRandomRooms } = useRoomsStore();
const { randomRooms } = storeToRefs(useRoomsStore())

const room = ref(null);
const route = useRoute();

const book = ref(false);
const selectedRoomId = ref(null);


const startBook = (roomId) => {
  selectedRoomId.value = roomId;
  book.value = true;
};

const cancelBook = () => {
  book.value = false;
  selectedRoomId.value = null;
};
const loadRoom = async () => {
  room.value = null;
  room.value = await getRooms(route.params.id).catch((error) => {
    console.log('Ошибка загрузки комнаты:', error);
  });
};


onMounted(async () => {
  await getRandomRooms();

  room.value = await getRooms(route.params.id).catch((error) => {
    console.log('Ошибка загрузки комнаты:', error);
  });
});

watch(() => route.params.id, async () => {
  await loadRoom();
  await getRandomRooms();
});
</script>

