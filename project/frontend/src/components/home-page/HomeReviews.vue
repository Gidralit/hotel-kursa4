<script setup>

import HomeReviewItem from "@/components/home-page/HomeReviewItem.vue";
import {useReviewsStore} from "@/stores/ReviewsStore.js";
import {storeToRefs} from "pinia";
import {onMounted} from "vue";

const { getRandomReviews } = useReviewsStore()
const { randomReviews } = storeToRefs(useReviewsStore())

onMounted(async () =>{
  await getRandomReviews()
})
</script>

<template>
  <section
    id="reviews"
    class="reviews"
  >
    <h2>Отзывы наших клиентов</h2>
    <div
      v-if="randomReviews"
      class="review__container"
    >
      <home-review-item
        v-for="review in randomReviews"
        :key=review.id
        :review="review"
      />
    </div>
    <div v-else>Отзывов пока нету</div>
  </section>
</template>

<style scoped lang="scss">
.reviews {
  background-color: #5a977a;
  border-radius: 8px;
  padding: 20px;
  color: #fff;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  margin: 80px 0 80px 0;
}
.reviews h2 {
  text-align: center;
  color: #fff;
}

.review__container {
  display: grid;
  grid-template-columns: 1fr;
  gap: 15px;
  margin-top: 20px;
}
</style>