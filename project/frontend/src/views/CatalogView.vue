<template>
  <div class="flex justify-between position-relative">
    <div class="flex flex-col">
      <catalog-sorting />

      <template v-if="roomsStore.rooms.length">
        <section class="rooms">
          <room-catalog-card
            v-for="room in roomsStore.rooms"
            :key="room.id"
            :room="room"
            :book="book"
            @start="startBook(room.id)"
          />
        </section>
      </template>

      <template v-else>
        <section class="rooms">
          <room-catalog-skeleton
            v-for="item in 6"
            :key="item"
          />
        </section>
      </template>
    </div>

    <catalog-filters />

    <booking-modal
      v-if="book"
      :room-id="selectedRoomId"
      @cancel="cancelBook"
      @success="cancelBook"
    />
  </div>
</template>

<script setup>
import { CatalogFilters, CatalogSorting,RoomCatalogCard,RoomCatalogSkeleton,BookingModal } from '@/components'

import { onMounted, ref } from "vue";
import {useRoomsStore} from "@/stores/RoomsStore.js";
import {storeToRefs} from "pinia";
import {useAuthStore} from "@/stores/AuthStore.js";

const roomsStore = useRoomsStore();
const { getRooms } = roomsStore;

const { user } = storeToRefs(useAuthStore())

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

onMounted(async () => {
  await getRooms();
});
</script>

<style scoped lang="scss">
.rooms {
  @apply flex flex-col gap-y-10 py-12;
}
</style>
