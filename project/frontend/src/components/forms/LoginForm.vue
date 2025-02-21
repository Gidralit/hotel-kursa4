<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/stores/AuthStore.js';

const email = ref('');
const password = ref('');
const authStore = useAuthStore();

const handleLogin = () => {
  authStore.login({ email: email.value, password: password.value });
};

</script>

<template>
  <div class="login">
    <form @submit.prevent="handleLogin">
      <label
        class="label"
        for="chk"
        aria-hidden="true"
      >
        Вход
      </label>
      <p
        v-if="authStore.loginError"
        class="text-red-600 text-center"
      >
        {{ authStore.loginError }}
      </p>
      <input
        v-model="email"
        type="email"
        name="email"
        placeholder="Почта"
        autocomplete="username"
        required
      />
      <input
        v-model="password"
        type="password"
        name="pswd"
        autocomplete="current-password"
        placeholder="Пароль"
        required
      />
      <button
        type="submit"
      >
        Войти
      </button>
    </form>
  </div>
</template>

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

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
}
.label {
  letter-spacing: 2px;
}
label {
  @apply text-white text-5xl/normal justify-center flex m-12 font-bold cursor-pointer;
  transition: 0.5s ease-in-out;
}
input {
  @apply w-3/5 h-9 bg-white justify-center flex my-5 mx-auto p-3 border-none outline-none rounded-md;
}
button {
  @apply w-3/5 h-10 my-8 mx-auto justify-center block text-white text-base font-bold border-none outline-none rounded-md cursor-pointer;
  background: $button-auth-color;
  transition: all 0.2s ease-in;

  &:hover {
    background: $button-auth-hover;
  }
}
.login {
  @apply h-[490px] -translate-y-48;
  background: #eee;
  border-radius: 60% / 10%;
  transition: 0.8s ease-in-out;

  & label {
    color: #d8980e;
    transform: scale(0.6);
  }
}

#chk:checked ~ .login {
  transform: translateY(-500px);
}
#chk:checked ~ .login label {
  transform: scale(1);
}
</style>