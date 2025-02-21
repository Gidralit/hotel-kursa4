<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/stores/AuthStore';

import ProfileCardForm from "@/components/profile/ProfileCardForm.vue";
import ProfileCardInfo from "@/components/profile/ProfileCardInfo.vue";
import ProfileCardAvatar from "@/components/profile/ProfileCardAvatar.vue";
import {storeToRefs} from "pinia";

const props = defineProps({
  user: {
    type: Object,
    required: true,
  },
  isLoading:{
    type: Boolean,
    required: true
  }
});

const authStore = useAuthStore();

const { isAdmin } = storeToRefs(useAuthStore())

const editing = ref(false);
const errors = ref({});

const formData = ref({
  name: props.user.name,
  phone: props.user.phone,
  email: props.user.email,
  password: '',
  password_confirmation: '',
});

const startEditing = () => {
  editing.value = true;
};

const cancelEditing = () => {
  editing.value = false;
  formData.value = {
    name: props.user.name,
    phone: props.user.phone,
    email: props.user.email,
    password: '',
    password_confirmation: '',
  };
};

const saveChanges = async () => {
  errors.value = {};

  if (formData.value.password && formData.value.password.length < 8) {
    errors.value.password = 'Пароль должен содержать не менее 8 символов.';
    return;
  }

  if (formData.value.password !== formData.value.password_confirmation) {
    errors.value.password_confirmation = 'Пароли не совпадают.';
    return;
  }

  const updateData = { ...formData.value };

  if (!updateData.password) {
    delete updateData.password;
    delete updateData.password_confirmation;
  }

  try {
    await authStore.updateUser(updateData);
    editing.value = false;
    await authStore.userData();
  } catch (error) {
    if (error.response && error.response.data && error.response.data.errors) {
      errors.value = error.response.data.errors;
    } else {
      errors.value.general = 'Произошла ошибка при обновлении профиля.';
    }
  }
};
</script>

<template>
  <div
    v-if="!isLoading"
    class="profile container"
  >
    <profile-card-avatar
      :photo="user.photo"
      :is-admin="isAdmin"
    />

    <profile-card-info
      v-if="!editing"
      :user="user"
      @start="startEditing"
    />

    <profile-card-form
      v-else
      :errors="errors"
      :form-data="formData"
      @save="saveChanges"
      @cancel="cancelEditing"
    />
  </div>
</template>

<style scoped lang="scss">
.profile {
  @apply my-12 items-center mx-auto justify-between p-8 flex bg-white rounded-lg shadow-lg;
  width: 80% !important;
}
</style>
