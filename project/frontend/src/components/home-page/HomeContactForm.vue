<script setup>

</script>

<template>
  <div
    id="contact-form"
    class="form"
  >
    <h2 class="form__title">Остались вопросы?</h2>
    <p class="form__subtitle">
      Оставьте контакты и оператор свяжется с Вами в течение 10 минут.
    </p>
    <form class="form__fields">
      <input
        type="text"
        placeholder="Фамилия и имя"
        class="form__input"
      >
      <input
        type="tel"
        placeholder="Телефон"
        class="form__input"
      >
      <button
        type="submit"
        class="form__button"
      >
        Отправить вопрос
      </button>
    </form>
    <p class="form__note">
      Нажмите на кнопку согласия с нашей политикой конфиденциальности.
    </p>
  </div>
</template>

<style scoped lang="scss">
  .form{
    @apply rounded-lg px-12 py-8 w-3/5 text-center shadow-md mb-20;
    margin: 0 auto 80px;
    background: linear-gradient(to bottom, rgba(253, 46, 0, 0.38), rgba(240, 188, 135, 0.48));
    &__title {
      @apply text-xl font-semibold text-gray-800;
    }
    &__subtitle {
      @apply text-sm text-gray-700 mt-2;
    }
    &__fields {
      @apply flex flex-col md:flex-row items-center justify-center gap-4 mt-4;
    }
    &__input {
      @apply bg-white border border-gray-300 rounded-lg p-2 text-sm shadow-sm focus:ring-2 focus:ring-orange-300 focus:outline-none w-full md:w-1/4;
    }
    &__button {
      @apply bg-orange-400 text-white font-medium py-2 px-4 rounded-lg hover:bg-orange-500 focus:ring-2 focus:ring-orange-400 focus:outline-none transition-all;
    }
    &__note {
      @apply text-xs text-gray-900 mt-4;
    }
  }

</style>