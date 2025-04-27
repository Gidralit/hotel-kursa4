import { defineStore } from 'pinia';
import {computed, ref} from "vue";
import {useRouter} from "vue-router";
import { api,toastNotification } from "@/shared";

export const useAuthStore = defineStore('auth', () => {
    const token = ref(localStorage.getItem('token') || null);
    const router = useRouter()
    const loginError = ref(null);
    const user = ref(null);
    const isLoading = ref(false);
    const isAdmin = ref(localStorage.getItem('admin') === 'true');

    const login = async (credentials) => {
        try {
            const response = await api.post(`login`, credentials);

            token.value = response.data.token;
            localStorage.setItem('token', token.value);

            loginError.value = null;

            if (credentials.email === 'admin@admin.com' && credentials.password === 'superadmin') {
                await toastNotification("Добро пожаловать, Администратор", "success");
                localStorage.setItem('admin', 'true');
                isAdmin.value = true;
            } else {
                await toastNotification(response.data.message, "success");
            }
            setTimeout(()=>{
                router.push('/profile')
            },1000)
        } catch (error) {
            console.log(error)
            if (error.response && error.response.status === 401) {
                loginError.value = 'Неверные введеные данные';
                toastNotification("Неверные введенные данные", "error");
            } else {
                loginError.value = 'Ошибка при входе';
            }
        }
    };

    const register = async (formData) => {
        try {
            const response = await api.post("register", formData, {
                headers: {"Content-Type": "multipart/form-data"},
            });

            token.value = response.data.token;
            localStorage.setItem('token', token.value);

            toastNotification(response.data.message, "success");
            setTimeout(()=>{
                router.push('/profile')
            },1000)
        } catch (error) {
            console.log(error)
            if (error.response.data) {
                Object.values(error.response.data).forEach(messages => {
                    messages.forEach(message => {
                        toastNotification(message, "error");
                    });
                });
            }
            else {
                toastNotification('Ошибка регистрации', "error");
            }
        }
    };



    const isAuthenticated = computed(() => !!token.value);

    const logout = async () =>{
        try {
            toastNotification("Вы вышли из аккаунта","info")
            setTimeout(()=>{
                router.push('/')
            },2000)

            token.value = null;
            isAdmin.value = false

            localStorage.removeItem('token');
            localStorage.setItem('admin','false');
        }
        catch (error) {
            console.error('Ошибка выхода', error);
        }
    }

    const userData = async () =>{
        isLoading.value = true;
        try {
            const response = await api.get('user', {
                headers: {
                    Authorization: `Bearer ${token.value}`
                }
            })
            user.value = response.data
        }
        catch (error) {
            console.error('Ошибка получения данных о пользователе', error);
        }
        finally {
            isLoading.value = false;
        }
    }
    const updateUser = async (updatedData) => {
        try {
            const response = await api.put('user', updatedData, {
                headers: {
                    Authorization: `Bearer ${token.value}`,
                },
            });
            user.value = response.data;
            toastNotification('Данные успешно обновлены', 'success');
        } catch (error) {
            console.error('Ошибка при обновлении данных пользователя', error);
            toastNotification('Ошибка при обновлении данных', 'error');
        }
    };

    const updatePhoto = async (photoFile) => {
        try {
            const formData = new FormData();
            formData.append('photo', photoFile);

            const response = await api.post('updatePhoto', formData, {
                headers: {
                    Authorization: `Bearer ${token.value}`,
                    'Content-Type': 'multipart/form-data',
                },
            });
            user.value.photo = response.data.photo;
            toastNotification('Фотография успешно обновлена', 'success');
        } catch (error) {
            console.error('Ошибка при обновлении фотографии', error);
            toastNotification('Ошибка при обновлении фотографии', 'error');
        }
    };



    return {
        user,
        token,
        router,
        loginError,
        isAuthenticated,
        isLoading,
        isAdmin,
        login,
        register,
        logout,
        userData,
        updateUser,
        updatePhoto,
    };
});
