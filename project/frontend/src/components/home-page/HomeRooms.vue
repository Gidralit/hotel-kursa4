<template>
  <section
    id="rooms"
    class="rooms"
  >
    <h2 class="rooms__title">Номера и цены</h2>
    <div
      v-if="mainRooms"
      class="rooms__block"
    >
      <room-home-card
        v-for="room in mainRooms"
        :key="room"
        :room="room"
      />
    </div>
    <div
      v-else
      class="rooms__block"
    >
      <room-home-skeleton
        v-for="room in [1,2,3,4]"
        :key="room"
      />
    </div>
  </section>
</template>

<script setup>
import { RoomHomeCard, RoomHomeSkeleton } from "@/components";

import {storeToRefs} from "pinia";
import {useRoomsStore} from "@/stores/RoomsStore.js";
import {onMounted} from "vue";
const { mainRooms } = storeToRefs(useRoomsStore())
const { getMainRooms } = useRoomsStore()

onMounted(async ()=>{
  mainRooms.value = null
  await getMainRooms()
})
</script>

<style scoped lang="scss">
.rooms {
  background: linear-gradient(to bottom, $orange, #f0bc87);
  padding: 40px 20px;
  text-align: center;
  &__block {
    @apply flex justify-center flex-wrap;
    gap: 20px 120px;
  }
  &__title {
    @apply text-2xl mb-5;
    color: $light-black;
  }
}
</style>