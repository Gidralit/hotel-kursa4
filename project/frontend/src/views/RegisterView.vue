<template>
  <div
    class="m-0 my-12 p-0 justify-center items-center flex"
  >
    <div class="main">
      <input
        id="chk"
        class="hidden"
        type="checkbox"
        aria-hidden="true"
      />
      <div class="relative w-full h-full">
        <register-form/>
      </div>
      <login-form/>
    </div>
  </div>
</template>

<script setup>
import { RegisterForm,LoginForm } from "@/components";
</script>

<style scoped lang="scss">
.main {
  @apply overflow-hidden rounded-xl drop-shadow-2xl w-[800px] h-[550px];
  background: linear-gradient($orange, rgba(182, 159, 65, 0.13));
}
</style>
