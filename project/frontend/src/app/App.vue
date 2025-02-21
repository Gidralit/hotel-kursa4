<script setup>
import TheHeader from '@/components/header/TheHeader.vue'
import TheFooter from "@/components/footer/TheFooter.vue";
</script>

<template>
  <main>
    <div class="wrapper">
      <div class="cont">
        <the-header />
        <main class="main">
          <router-view
            v-slot="{ Component }"
          >
            <transition
              name="fade"
              mode="out-in"
            >
              <component
                :is="Component"
                v-if="Component"
              />
            </transition>
          </router-view>
        </main>
        <the-footer />
      </div>
    </div>
  </main>
</template>


<style scoped lang="scss">
.fade-enter-to,
.fade-leave-from {
  opacity: 1;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease-out;
}

</style>
