<template>
  <section
    id="about"
    class="about"
  >
    <div class="about__block">
      <h3 class="about__title">Отель для животных</h3>
      <img
        class="about__logo"
        src="@/assets/icons/logo.svg"
        alt="kuksik"
      >
      <div class="about__info">
        <home-about-items/>
      </div>
    </div>
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1101.86993623164!2d84.95902104154581!3d56.47224229350683!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x432693bbc4df60c9%3A0xff642b6e8472339a!2z0KLQvtC80YHQutC40Lkg0YLQtdGF0L3QuNC60YPQvCDQuNC90YTQvtGA0LzQsNGG0LjQvtC90L3Ri9GFINGC0LXRhdC90L7Qu9C-0LPQuNC5!5e0!3m2!1sru!2sru!4v1732717133844!5m2!1sru!2sru"
      width="100%"
      height="700"
      style="border:0;"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade"
    ></iframe>
  </section>
</template>

<script setup>

import HomeAboutItems from "@/components/home-page/about/HomeAboutItems.vue";
</script>

<style scoped lang="scss">
.about{
  position: relative;
  @apply relative mb-20;
  &__block{
    height: 470px;
    width: 300px;
    background: $white;
    padding: 10px 15px;
    @apply absolute top-40 left-5 flex flex-col rounded;
  }
  &__title{
    @apply text-xl;
  }
  &__logo{
    width: 100px;
    margin-bottom: 35px;
  }
  &__info{
    @apply flex flex-col gap-5;
  }

}
</style>