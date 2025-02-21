import { defineStore, storeToRefs } from 'pinia';
import { api } from '@/shared/index.js';
import { ref } from 'vue';
import { useCatalogStore } from '@/stores/CatalogStore.js';
import { toastNotification } from '@/shared/functions.js';
import { useAuthStore } from '@/stores/AuthStore.js';

export const useRoomsStore = defineStore('roomsStore', () => {
    const rooms = ref([]);
    const mainRooms = ref([]);
    const randomRooms = ref([]);
    const reservations = ref([]);
    const isLoading = ref(false);
    const { params } = storeToRefs(useCatalogStore());
    const { token } = storeToRefs(useAuthStore());
    const authStore  = storeToRefs(useAuthStore())

    const getRooms = async (id = null) => {
        isLoading.value = true;
        try {
            // Если передан `id`, запрашиваем конкретную комнату
            if (id) {
                const response = (await api.get(`rooms/${id}`)).data;
                return response;
            }

            // Если `id` не передан, запрашиваем все комнаты с фильтрами
            const response = (await api.get('rooms', { params: params.value })).data;
            rooms.value = response;
        } catch (error) {
            console.error('Ошибка загрузки комнат:', error);
            throw error;
        } finally {
            isLoading.value = false;
        }
    };


    const bookingRoom = async (updatedData) => {
        try {
            const response = await api.post('bookings', updatedData, {
                headers: {
                    Authorization: `Bearer ${token.value}`,
                },
            });
            toastNotification('Заявка успешно отправлена!', 'success');
        } catch (error) {
            if (error.response && error.response.status === 422) {
                toastNotification('Номер уже забронирован на указанные даты', 'error');
            }else {
                toastNotification('Ошибка бронирования', 'error');
                console.error('Ошибка бронирования:', error);
            }

        }
    };
    const deleteBookingRoom = async (id) => {
        try {
            const response = await api.delete(`bookings/${id}`, {
                headers: {
                    Authorization: `Bearer ${token.value}`,
                },
            });
            toastNotification('Бронь успешно отменена!', 'success');
        } catch (error) {
                toastNotification('Ошибка отмены брони', 'error');
                console.error('Ошибка бронирования:', error);
        }
    };

    const getReservations = async () => {
        authStore.isLoading.value = true
        try {
            const response = await api.get('bookings', {
                headers: {
                    Authorization: `Bearer ${token.value}`,
                },
            });
            reservations.value = response.data
        } catch (error) {
            console.error('Ошибка получение:', error);
        }
        finally {
            authStore.isLoading.value = false;
        }
    };

    const getRandomRooms = async () => {
        const response = (await api.get(`randRooms`)).data
        randomRooms.value = response;
    };
    const getMainRooms = async () => {
        try {
            const response = (await api.get('rooms')).data;
            mainRooms.value = response.filter(room => room.on_main === true);
        } catch (error) {
            console.error('Ошибка загрузки главных комнат:', error);
        }
    };
    return {
        rooms,
        randomRooms,
        mainRooms,
        reservations,
        isLoading,
        getRooms,
        bookingRoom,
        deleteBookingRoom,
        getReservations,
        getRandomRooms,
        getMainRooms,
    };
});
