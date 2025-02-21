<script setup>
import {useRoomsStore} from "@/stores/RoomsStore.js";

const props = defineProps({
  reservation: {
    type: Object,
    required: true,
  },
});

const { deleteBookingRoom } = useRoomsStore()
const { getReservations } = useRoomsStore();

const calculateTotalPrice = () => {
  const startDate = new Date(props.reservation.start_date);
  const endDate = new Date(props.reservation.end_date);
  const days = (endDate - startDate) / (1000 * 60 * 60 * 24);
  return days * parseFloat(props.reservation.room.price);
};
const deleteBooking = async (id) =>{
  await deleteBookingRoom(id);
  await getReservations();
}
</script>


<template>
  <div
    v-if="reservation"
    class="reservation__card"
  >
    <router-link :to="`room/${reservation.room.id}`">
      <img
        v-if="reservation.room.photos && reservation.room.photos.length > 0"
        :src="reservation.room.photos[0].photo"
        alt="room-image"
        class="reservation__image"
      />
      <img
        v-else
        src="@/assets/images/no-image.png"
        alt="no-room-image"
        class="reservation__image"
      />
    </router-link>

    <div class="reservation__details">
      <h3 class="reservation__title">
        <router-link :to="`room/${reservation.room.id}`">
          <span>{{ reservation.room.name }}:</span>
        </router-link>
        {{ reservation.room.area }}м&sup2; - {{ calculateTotalPrice() }}руб.
      </h3>

      <div class="reservation__pets">
        <h4 class="reservation__pets-title">Питомцы:</h4>
        <ul>
          <li
            v-for="pet in reservation.pets"
            :key="pet.id"
            class="reservation__pet-item"
          >
            • {{ pet.name }}
          </li>
        </ul>
      </div>

      <div class="reservation__dates">
        <p class="reservation__date">
          <strong>Дата заезда:</strong> {{ reservation.start_date }}
        </p>
        <p class="reservation__date">
          <strong>Дата выезда:</strong> {{ reservation.end_date }}
        </p>
      </div>

      <button
        class="reservation__cancel-button"
        @click=deleteBooking(reservation.id)
      >
        Отменить
      </button>
    </div>
  </div>
</template>




<style lang="scss" scoped>
.reservation {
  &__card {
    @apply bg-white shadow-lg rounded-lg overflow-hidden flex flex-col;
    height: 100%;
  }

  &__image {
    @apply w-full h-56 object-cover;
    flex-shrink: 0;
  }

  &__details {
    @apply p-4 bg-gray-100 flex flex-col justify-between flex-grow;
  }

  &__title {
    @apply text-lg mb-3;
    span {
      @apply font-semibold tracking-wide;
    }
  }

  &__pets {
    @apply mb-3;
  }

  &__pets-title {
    @apply font-semibold mb-1;
  }

  &__pet-item {
    @apply text-gray-600;
  }

  &__dates {
    @apply mb-3;
  }

  &__date {
    @apply text-gray-700 mb-1;
  }

  &__cancel-button {
    @apply bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mt-auto;
  }
}
</style>
