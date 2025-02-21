import { defineStore } from 'pinia';
import { reactive, ref } from 'vue';
import { useRoomsStore } from '@/stores/RoomsStore.js';
import { api } from '@/shared/index.js';

export const useCatalogStore = defineStore('catalog', () => {
    const roomsStore = useRoomsStore();
    const filters = ref();
    const params = reactive({
        min_price: null,
        max_price: null,
        area: [],
        equipment: [],
        sort_order: 'asc',
    });



    const updateSortOrder = async (order) => {
        params.sort_order = order;
        await roomsStore.getRooms();
    };

    const getFilters = async () => {
        const response = (await api.get('filters')).data;
        filters.value = response;
    };

    const applyFilters = async () => {
        await roomsStore.getRooms();
    };

    const resetFilters = async () => {
        params.min_price = null;
        params.max_price = null;
        params.area = [];
        params.equipment = [];
        await roomsStore.getRooms();
    };

    return {
        filters,
        params,
        getFilters,
        applyFilters,
        resetFilters,
        updateSortOrder,
    };
});
