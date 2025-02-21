<template>
  <nav class="footer__list">
    <router-link
      :to="{ name: 'home', hash: '#about' }"
      class="footer__list-item"
    >
      О нас
    </router-link>
    <router-link
      :to="{ name: 'home', hash: '#rooms' }"
      class="footer__list-item"
    >
      Номера и цены
    </router-link>
    <router-link
      :to="{ name: 'home', hash: '#book' }"
      class="footer__list-item"
    >
      Забронировать
    </router-link>

    <a
      href="#"
      class="flex flex-col items-center"
    >
      <img
        src="@/assets/images/home-page/footer-logo.svg"
        alt="Kuksik Logo"
        class="h-32"
      />
    </a>

    <router-link
      :to="{ name: 'home', hash: '#gallery' }"
      class="footer__list-item"
    >
      Фотогалерея
    </router-link>
    <router-link
      :to="{ name: 'home', hash: '#reviews' }"
      class="footer__list-item"
    >
      Отзывы
    </router-link>
    <router-link
      :to="{ name: 'home', hash: '#contact-form' }"
      class="footer__list-item"
    >
      Контакты
    </router-link>
  </nav>
</template>

<style scoped lang="scss">
.footer__list {
  @apply flex justify-between w-full items-center text-gray-700;
  &-item {
    @apply hover:text-gray-900;
  }
}
</style>
