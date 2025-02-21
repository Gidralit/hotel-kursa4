<script setup>
import ReservedButton from "@/components/button/ReservedButton.vue";

const props = defineProps({
  room: {
    type: Object,
    required: true,
  },
  book: {
    type: Boolean,
    required: true,
  },
});

const emit = defineEmits(["start"]);
</script>

<template>
  <div>
    <article
      v-if="room"
      class="room"
    >
      <router-link
        v-if="room.photos && room.photos.length > 0"
        :to="{ name: 'room', params: { id: room.id} }"
      >
        <img
          :src="room.photos[0].photo"
          alt="room-image"
        />
      </router-link>
      <img
        v-else
        src="@/assets/images/no-image.png"
        alt="no-image"
      />
      <div class="room__info">
        <router-link :to="{ name: 'room', params: { id: room.id} }">
          <h2 class="room__title">
            <span>Номер:</span>
            {{ room.name }}
          </h2>
        </router-link>
        <p class="room__size">Площадь: {{ room.area }} кв.м.</p>
        <p class="room__list-title">Оснащение номера:</p>
        <ul class="room__list">
          <li
            v-for="item in room.equipment"
            :key="item.id"
            class="room__list-item"
          >
            {{ item.name }}
          </li>
        </ul>
        <p class="room__price">
          <span>Стоимость за сутки:</span>
          {{ room.price }} руб.
        </p>
        <reserved-button
          class="room__button"
          @click="emit('start', room.id)"
        />
      </div>
    </article>
  </div>
</template>
<style scoped lang="scss">
.room{
  letter-spacing: 0.05em;
  max-width: 940px;
  @apply flex gap-16 py-10 px-12;
  box-shadow: 0 4px 4px 0 rgba(0, 0, 0, 0.25);
  img{
    width: 350px;
    height: 350px;
  }
  &__info{
    @apply flex flex-col;
  }
  &__title{
    font-size: 32px;
    margin-bottom: 20px;
    span{
      font-weight: 600;
    }
  }
  &__size{
    font-weight: 600;
    font-size: 24px;
    margin-bottom: 20px;
  }
  &__list-title {
    font-weight: 600;
    font-size: 24px;
  }
  &__list{
    @apply text-lg list-none p-0 mb-7;
    & li {
      @apply  relative pl-5;
      color: $light-black;

      &::before {
        content: "•";
        color: $orange;
        @apply text-lg absolute left-0 top-0;
      }
    }
  }
  &__price{
    font-size: 24px;
    margin-bottom: 60px;
    span{
      font-weight: 600;
      color: $bright-green;
    }
  }
  &__button{
    padding-inline:50% ;
    @apply w-full;
  }
}
</style>