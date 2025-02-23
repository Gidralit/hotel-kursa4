<template>
  <label
    class="filter__label"
    for="price"
  >
    <slot/>
  </label>
  <input
    id="price"
    v-model="userInput"
    type="number"
    class="filter__input"
    :placeholder="`от ${min} до ${max}`"
    :min="min"
    :max="max"
    @change="handleInputChange"
  />
</template>

<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  modelValue: {
    type: [Number, String],
    default: null,
  },
  min: {
    type: String,
    default: '500',
  },
  max: {
    type: String,
    default: '10000',
  },
});

const emit = defineEmits(['update:modelValue']);

const userInput = ref(props.modelValue);

watch(() => props.modelValue, (newValue) => {
  userInput.value = newValue;
});

const handleInputChange = () => {
  if (userInput.value > props.max) {
    userInput.value = props.max;
  } else if (userInput.value < props.min) {
    userInput.value = props.min;
  }
  emit('update:modelValue', userInput.value);
};
</script>

<style scoped lang="scss">
.filter__label {
  @apply block text-sm font-medium mt-1 mb-1;
}

.filter__input {
  @apply w-full border rounded-md p-2 text-sm focus:outline-none focus:ring focus:ring-green-300;
}
</style>
