<template>
  <div class="review">
    <p>{{ review.content }}</p>
    <!--на бэке нету получения данных о пользвателе-->
    <span>- Анна, оценка: {{ review.rating }}</span>
  </div>
</template>

<script setup>
defineProps({
  review:{
    type: Object,
    required: true
  }
})
</script>

<style scoped lang="scss">
.review {
  background-color: #fff;
  color: #3A393A;
  padding: 15px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.review span {
  display: block;
  margin-top: 10px;
  text-align: right;
  font-style: italic;
  color: #5a977a;
}
</style>