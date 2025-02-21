import {defineStore} from "pinia";
import {ref} from "vue";
import {api} from "@/shared/index.js";

export const useReviewsStore = defineStore('reviewsStore', () =>{
    const randomReviews = ref([]);

    const getRandomReviews = async () => {
        const response = (await api.get('randReviews')).data
        randomReviews.value = response
    }
    return{
        randomReviews,
        getRandomReviews
    }
})