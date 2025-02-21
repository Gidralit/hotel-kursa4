import { defineStore } from "pinia";
import {ref} from "vue";
import {api} from "@/shared/index.js";

export const useMainStore = defineStore("mainStore", () => {
    const slogan = ref(localStorage.getItem('slogan') || null);
    const city = ref(localStorage.getItem('city') || null);
    const data = ref();
    const getMainInfo = async () => {
        const response = (await api.get(`header`)).data
        slogan.value = response.slogan;
        city.value = response.city;
        data.value = response;
        localStorage.setItem('slogan', slogan.value);
        localStorage.setItem('city', city.value);
    };

    return { getMainInfo, city, slogan, data };
});
