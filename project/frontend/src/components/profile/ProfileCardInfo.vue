<script setup>
defineProps({
  user:{
    type:Object,
    required:true
  }
})

const emit = defineEmits(['start']);

const formattedDate = (date) => {
  if (!date) return 'Дата неизвестна';
  const parsedDate = new Date(date);
  return parsedDate.toLocaleDateString('ru-RU', {
    day: 'numeric',
    month: 'long',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
  });
};
</script>

<template>
  <div
    class="profile__info"
  >
    <h2 class="profile__info-name">{{ user.name }}</h2>
    <p class="profile__info-detail">
      <span class="profile__info-label">Телефон:</span>
      {{ user.phone }}
    </p>
    <p class="profile__info-detail">
      <span class="profile__info-label">Email:</span>
      {{ user.email }}
    </p>
    <p class="profile__info-detail mt-5">
      <span class="profile__info-label">Дата регистрации:</span>
      {{ formattedDate(user.created_at) }}
    </p>
    <p class="profile__info-detail">
      <span class="profile__info-label">Последняя дата изменения:</span>
      {{ formattedDate(user.updated_at) }}
    </p>
    <button
      class="profile__button"
      @click="emit('start')"
    >
      Изменить
    </button>
  </div>
</template>

<style scoped lang="scss">
.profile {
  &__info {
    @apply w-7/12 bg-gray-50 p-6 rounded-lg shadow-md;
  }

  &__info-name {
    @apply text-3xl font-bold text-gray-800 mb-4;
  }

  &__info-detail {
    @apply text-lg text-gray-600 mb-2;
  }

  &__info-label {
    @apply font-medium text-gray-700;
  }

  &__button {
    @apply flex items-center text-white mt-8 p-2.5 justify-center w-48 tracking-widest rounded-lg bg-gray-600;
    transition: all 0.3s ease-in-out;
    cursor: pointer;

    &:hover {
      background: #444;
    }
  }
}
</style>