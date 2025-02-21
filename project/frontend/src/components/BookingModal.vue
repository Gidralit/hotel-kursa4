<script setup>
import { onMounted, onUnmounted, ref, watch } from "vue";
import { useRoomsStore } from "@/stores/RoomsStore.js";

const props = defineProps({
  roomId: {
    type: Number,
    required: true,
  },
});

const roomsStore = useRoomsStore();

const numberOfPets = ref(1);
const petNames = ref([""]);
const checkIn = ref("");
const checkOut = ref("");
const errors = ref({});

const emit = defineEmits(["success", "cancel"]);

const validate = () => {
  errors.value = {};

  // Проверка всех имен питомцев
  petNames.value.forEach((name, index) => {
    if (!/^[A-Za-zА-Яа-яёЁ\s\-]+$/.test(name)) {
      errors.value[`petName${index}`] = "Имя питомца может содержать только буквы, пробелы и тире.";
    }
  });

  if (!checkIn.value || new Date(checkIn.value - 1) < new Date()) {
    errors.value.checkIn = "Дата заезда не может быть раньше сегодняшнего дня.";
  }

  if (!checkOut.value || new Date(checkOut.value) <= new Date(checkIn.value)) {
    errors.value.checkOut = "Дата выезда должна быть позже даты заезда.";
  }

  if (numberOfPets.value < 1 || numberOfPets.value > 4) {
    errors.value.numberOfPets = "Можно забронировать для 1-4 питомцев.";
  }

  return Object.keys(errors.value).length === 0;
};

const submitBooking = async () => {
  if (!validate()) return;

  const formData = {
    room_id: props.roomId,
    pet_name: petNames.value,
    start_date: checkIn.value,
    end_date: checkOut.value,

  };

  await roomsStore.bookingRoom(formData);
  emit("success");
};

const handleEscape = (event) => {
  if (event.key === "Escape") {
    emit("cancel");
  }
};

// Обновление количества полей для ввода имен питомцев

watch(numberOfPets, (newCount) => {
  if (newCount > petNames.value.length && newCount < 5) {
    while (petNames.value.length < newCount) {
      petNames.value.push("");
    }
  } else {
    petNames.value = petNames.value.slice(0, newCount);
  }
});

onMounted(async () => {
  window.addEventListener("keydown", handleEscape);

});

onUnmounted(() => {
  window.removeEventListener("keydown", handleEscape);
});
</script>

<template>
  <div class="booking-modal__overlay">
    <div class="booking-modal__content">
      <h2 class="booking-modal__title">Забронировать номер</h2>
      <form
        class="booking-modal__form"
        @submit.prevent="submitBooking"
      >
        <div class="booking-modal__field">
          <label class="booking-modal__label">Количество питомцев (макс. 4)</label>
          <input
            v-model.number="numberOfPets"
            type="number"
            class="booking-modal__input"
            min="1"
            max="4"
            required
          />
          <span
            v-if="errors.numberOfPets"
            class="booking-modal__error"
          >
            {{ errors.numberOfPets }}
          </span>
        </div>

        <div
          v-for="(name, index) in petNames"
          :key="index"
          class="booking-modal__field"
        >
          <label
            :for="`petName${index}`"
            class="booking-modal__label"
          >
            Имя питомца {{ index + 1 }}
          </label>
          <input
            :id="`petName${index}`"
            v-model="petNames[index]"
            type="text"
            class="booking-modal__input"
            placeholder="Имя питомца"
            required
          />
          <span
            v-if="errors[`petName${index}`]"
            class="booking-modal__error"
          >
            {{ errors[`petName${index}`] }}
          </span>
        </div>

        <div class="booking-modal__field">
          <label
            for="checkIn"
            class="booking-modal__label"
          >
            Дата заезда
          </label>
          <input
            id="checkIn"
            v-model="checkIn"
            type="date"
            class="booking-modal__input"
            required
          />
          <span
            v-if="errors.checkIn"
            class="booking-modal__error"
          >
            {{ errors.checkIn }}
          </span>
        </div>

        <div class="booking-modal__field">
          <label
            for="checkOut"
            class="booking-modal__label"
          >
            Дата выезда
          </label>
          <input
            id="checkOut"
            v-model="checkOut"
            type="date"
            class="booking-modal__input"
            required
          />
          <span
            v-if="errors.checkOut"
            class="booking-modal__error"
          >
            {{ errors.checkOut }}
          </span>
        </div>

        <div class="booking-modal__buttons">
          <button
            type="submit"
            class="booking-modal__button booking-modal__button--submit"
          >
            Отправить заявку
          </button>
          <button
            type="button"
            class="booking-modal__button booking-modal__button--cancel"
            @click="emit('cancel')"
          >
            Отменить
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<style scoped lang="scss">
.booking-modal {
  &__overlay {
    @apply fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center;
  }

  &__content {
    @apply bg-white p-8 rounded-lg w-full max-w-md;
  }

  &__title {
    @apply text-xl font-bold mb-6;
  }

  &__form {
    @apply flex flex-col gap-y-4;
  }

  &__field {
    @apply flex flex-col;
  }

  &__label {
    @apply text-sm font-medium mb-1;
  }

  &__input {
    @apply border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400;
  }

  &__error {
    @apply text-red-500 text-xs mt-1;
  }

  &__buttons {
    @apply flex justify-between mt-6;
  }

  &__button {
    @apply px-4 py-2 rounded text-white font-medium cursor-pointer;

    &--submit {
      @apply bg-blue-500 hover:bg-blue-600;
    }

    &--cancel {
      @apply bg-gray-400 hover:bg-gray-500;
    }
  }
}
</style>
