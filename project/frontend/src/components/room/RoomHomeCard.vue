<script setup>
import ReservedButton from "@/components/button/ReservedButton.vue";
defineProps({
  room:{
    type: Object,
    required: true
  }
})
</script>

<template>
  <div class="room">
    <div>
      <h3 class="room-title">{{ room.name }}</h3>
      <img
        v-if="room.photos.length > 0"
        :src="room.photos[0].photo"
        alt="room-image"
      >
      <img
        v-else
        src="@/assets/images/no-image.png"
        alt="room-no-image"
      >
      <ul class="room-features">
        <li>Площадь {{ room.area }} кв.м</li>
        <li
          v-for="equipment in room.equipment"
          :key="equipment.id"
        >
          {{ equipment.name }}
        </li>
      </ul>
    </div>
    <div>
      <router-link :to="`/room/${room.id}`">
        <reserved-button class="mx-auto px-10"/>
      </router-link>
      <p class="room-price">{{ room.price }} руб. / сутки</p>
    </div>
  </div>
</template>

<style scoped lang="scss">
.room {
  background-color: $white;
  @apply rounded-2xl text-left flex flex-col justify-between;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  padding: 30px 60px 40px;

  &-price {
    @apply mt-4 text-base text-center font-bold;
    color: $light-black;
  }
  
  & img{
    @apply mb-5 rounded;
    width:300px;
    height: 225px;
  }
  &-title {
    @apply text-xl mb-4;
    font-weight: 600;
    color: $light-black;
  }
  &-features {
    @apply text-sm list-none p-0 mb-11;

    & li {
      @apply mb-2.5 relative pl-5;
      color: $light-black;

      &::before {
        content: "•";
        color: $orange;
        @apply text-lg absolute left-0 top-0;
      }
    }
  }
}
</style>