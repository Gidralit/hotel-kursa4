<template>
  <form
    class="profile__form"
    @submit.prevent="emit('save')"
  >
    <div
      v-if="errors.general"
      class="profile__error"
    >
      {{ errors.general }}
    </div>

    <div class="profile__form-group">
      <label
        for="name"
        class="profile__form-label"
      >
        Имя:
      </label>
      <input
        id="name"
        v-model="formDataRef.name"
        placeholder="Имя"
        class="profile__form-input"
      />
    </div>

    <div class="profile__form-group">
      <label
        for="phone"
        class="profile__form-label"
      >
        Телефон:
      </label>
      <input
        id="phone"
        v-model="formDataRef.phone"
        placeholder="Телефон"
        class="profile__form-input"
      />
    </div>

    <div class="profile__form-group">
      <label
        for="email"
        class="profile__form-label"
      >
        Email:
      </label>
      <input
        id="email"
        v-model="formDataRef.email"
        placeholder="Email"
        class="profile__form-input"
      />
    </div>

    <div class="profile__form-group">
      <label
        for="password"
        class="profile__form-label"
      >
        Новый пароль:
      </label>
      <input
        id="password"
        v-model="formDataRef.password"
        type="password"
        placeholder="Введите новый пароль"
        class="profile__form-input"
        autocomplete="on"
      />
      <p
        v-if="errors.password"
        class="profile__error"
      >
        {{ errors.password }}
      </p>
    </div>
    
    <div class="profile__form-group">
      <label
        for="password_confirmation"
        class="profile__form-label"
      >
        Подтверждение пароля:
      </label>
      <input
        id="password_confirmation"
        v-model="formDataRef.password_confirmation"
        type="password"
        placeholder="Подтвердите новый пароль"
        class="profile__form-input"
        autocomplete="on"
      />
      <p
        v-if="errors.password_confirmation"
        class="profile__error"
      >
        {{ errors.password_confirmation }}
      </p>
    </div>

    <div class="profile__photo-upload">
      <input
        type="file"
        @change="handleFileUpload"
      />
      <button @click="uploadPhoto">Загрузить фото</button>
    </div>

    <div class="profile__buttons">
      <button
        type="submit"
        class="profile__button"
      >
        Сохранить
      </button>
      <button
        type="button"
        class="profile__button cancel"
        @click="emit('cancel')"
      >
        Отмена
      </button>
    </div>
  </form>
</template>

<script setup>
import { ref } from 'vue'
import { useAuthStore } from '@/stores/AuthStore';

const props = defineProps({
  errors: {
    type: Object,
    required: true,
  },
  formData: {
    type: Object,
    required: true,
  },
});

const formDataRef = ref(props.formData)
const emit = defineEmits(['save', 'cancel']);


const authStore = useAuthStore();
const selectedFile = ref(null);

const handleFileUpload = (event) => {
  selectedFile.value = event.target.files[0];
};

const uploadPhoto = async () => {
  if (selectedFile.value) {
    await authStore.updatePhoto(selectedFile.value);
  } else {
    console.log('Файл не выбран');
  }
};

</script>


<style scoped lang="scss">
.profile {
  &__form{
    @apply w-7/12 bg-gray-50 p-6 rounded-lg shadow-md;
  }
  &__error {
    @apply text-red-500 text-sm mt-1;
  }

  &__form-group {
    @apply mb-4;
  }

  &__form-label {
    @apply block mb-2 font-medium text-gray-700;
  }

  &__form-input {
    @apply w-full p-2 border border-gray-300 rounded-lg;
  }
  &__photo-upload{
    @apply flex flex-wrap gap-4 items-center  justify-between;

    button{
      @apply bg-gray-400 py-1.5 px-4 rounded text-white;
    }
  }
  &__buttons {
    @apply flex justify-between;
  }

  &__button {
    @apply flex items-center text-white mt-8 p-2.5 justify-center w-48 tracking-widest rounded-lg bg-gray-600;
    transition: all 0.3s ease-in-out;
    cursor: pointer;

    &:hover {
      background: #444;
    }

    &.cancel {
      @apply bg-red-500;

      &:hover {
        background: #c53030;
      }
    }
  }
}
</style>