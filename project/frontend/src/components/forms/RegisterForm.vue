<template>
  <form @submit.prevent="submit">
    <label
      class="label"
      for="chk"
      aria-hidden="true"
    >
      Регистрация
    </label>

    <input
      id="name"
      v-model="name"
      v-bind="nameAttrs"
      :class="{ 'error-input': errors.name }"
      type="text"
      name="name"
      placeholder="Ваше имя"
      required
    />
    <p
      v-if="errors.name"
      class="error-message"
    >
      {{ errors.name }}
    </p>

    <input
      v-bind="emailAttrs"
      id="email"
      v-model="email"
      :class="{ 'error-input': errors.email }"
      type="email"
      name="email"
      placeholder="Почта"
      required
    />
    <p
      v-if="errors.email"
      class="error-message"
    >
      {{ errors.email }}
    </p>

    <input
      v-bind="phoneAttrs"
      id="phone"
      v-model="phone"
      v-mask="'+7(###)###-##-##'"
      :class="{ 'error-input': errors.phone }"
      type="text"
      name="phone"
      placeholder="Телефон (в формате +7(XXX)XXX-XX-XX)"
      required
    />
    <p
      v-if="errors.phone"
      class="error-message"
    >
      {{ errors.phone }}
    </p>

    <input
      v-bind="passwordAttrs"
      id="password"
      v-model="password"
      :class="{ 'error-input': errors.password }"
      type="password"
      name="password"
      placeholder="Пароль"
      required
      autocomplete="on"
    />
    <p
      v-if="errors.password"
      class="error-message"
    >
      {{ errors.password }}
    </p>

    <input
      id="photo"
      type="file"
      name="photo"
      accept="image/jpeg, image/png"
      v-bind="photoAttrs"
      @change="handlePhotoUpload"
    />
    <p
      v-if="errors.photo"
      class="error-message"
    >
      {{ errors.photo }}
    </p>


    <button
      :disabled="errors.name || errors.email || errors.phone || errors.password || errors.photo"
      :class="{ 'error-button': errors.name || errors.email || errors.phone || errors.password || errors.photo }"
      type="submit"
      @click="goHome"
    >
      Зарегистрироваться
    </button>
  </form>
</template>


<script setup>
import { useForm } from "vee-validate";
import { useAuthStore } from "@/stores";
import { storeToRefs } from "pinia";
import { useRouter } from "vue-router";
import { registrationSchema } from "@/shared";

const { isAuthenticated } = storeToRefs(useAuthStore());
const authStore = useAuthStore();
const router = useRouter();

const { defineField, errors, handleSubmit } = useForm({
  validationSchema: registrationSchema,
});

const [name, nameAttrs] = defineField("name");
const [email, emailAttrs] = defineField("email");
const [phone, phoneAttrs] = defineField("phone");
const [password, passwordAttrs] = defineField("password");
const [photo, photoAttrs] = defineField("photo");

const handlePhotoUpload = (e) => {
  photo.value = e.target.files[0];
};

const submit = handleSubmit((values) => {
  const formData = new FormData();
  formData.append("name", values.name);
  formData.append("email", values.email);
  formData.append("phone", values.phone);
  formData.append("password", values.password);

  if (photo.value) {
    formData.append("photo", photo.value);
  }

  authStore.register(formData);
});

const goHome = () => {
  if (isAuthenticated.value) router.push("/");
};
</script>


<style scoped lang="scss">
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:active,
input:-webkit-autofill:focus {
  background-color: #ffffff !important;
  color: #555 !important;
  -webkit-box-shadow: 0 0 0 1000px #fff1d2 inset !important;
  -webkit-text-fill-color: #9c6006 !important;
}

.error-message{
  @apply ml-40 text-base -mt-3.5 opacity-80 text-blue-950;

  @media screen and (max-width:550px ) {
    @apply ml-0 text-center
  }
}
.error-input{
  border: 0.15rem solid rgba(255, 0, 0, 0.78);
}
.error-button{
  background: #aca2a2;
  &:hover{
    background: #aca2a2;
  }
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
}
.label {
  letter-spacing: 2px;
}
label {
  @apply text-white text-4xl/normal justify-center flex mt-10 font-bold cursor-pointer;
  transition: 0.5s ease-in-out;
}
input {
  @apply w-3/5 h-9 bg-white justify-center flex my-4 mx-auto p-3 border-none outline-none rounded-md;
}
input[type="file"] {
  @apply h-12;
}
button {
  @apply w-3/5 h-10 my-6 mx-auto justify-center block text-white text-base font-bold border-none outline-none rounded-md cursor-pointer;
  background: $button-auth-color;
  transition: 0.2s ease-in;
}
button:hover {
  background: $button-auth-hover;
}
#chk:checked ~ .signup label {
  transform: scale(0.6);
}
</style>