import { defineStore } from 'pinia'
import { ref } from 'vue'
import { api } from '@/shared'

export const useReviewsStore = defineStore('reviewsStore', () => {
  const randomReviews = ref([])

  const getRandomReviews = async () => {
    randomReviews.value = (await api.get('randReviews')).data
  }
  return {
    randomReviews,
    getRandomReviews
  }
})