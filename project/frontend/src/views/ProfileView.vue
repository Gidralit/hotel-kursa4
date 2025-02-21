<script setup>
import { ProfileSkeletonCard, ProfileCard, ProfileBooking } from '@/components/profile/index.js'
import { onMounted } from 'vue';
import { useAuthStore } from "@/stores/AuthStore.js";
import {storeToRefs} from "pinia";
import {useRoomsStore} from "@/stores/RoomsStore.js";
import ReservationCardSkeleton from "@/components/reservations/ReservationCardSkeleton.vue";


const { user, isLoading } = storeToRefs(useAuthStore())
const { userData } = useAuthStore();

const { reservations } = storeToRefs(useRoomsStore());
const { getReservations } = useRoomsStore();

onMounted(async ()=>{
  await userData();
  await getReservations();
})
</script>
<template>
  <div>
    <template v-if="user && reservations">
      <profile-card
        :user="user"
        :is-loading="isLoading"
      />
      <profile-booking
        :is-loading="isLoading"
        :reservations="reservations"
      />
    </template>


    <template v-if="isLoading">
      <profile-skeleton-card/>
      
      <div class="booking__list mb-10">
        <reservation-card-skeleton
          v-for="reservation in [1,2,3]"
          :key="reservation"
        />
      </div>
    </template>
  </div>
</template>
<style scoped lang="scss">
.booking__list {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  @apply gap-x-10 gap-y-14;
}
</style>
