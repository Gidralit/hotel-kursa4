import { createRouter, createWebHistory } from 'vue-router'
import { HomeView, NotFoundView, RegisterView, CatalogView, ProfileView, RoomView } from '@/views/index.js'

const routes = [
  { name: 'home', path: '/', component: HomeView },
  { name: 'not-found', path: '/:pathMatch(.*)*', component: NotFoundView },
  { name: 'register', path: '/register', component: RegisterView },
  { name: 'catalog', path: '/catalog', component: CatalogView },
  { name: 'profile', path: '/profile', component: ProfileView },
  { name: 'room', path: '/room/:id', component: RoomView },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (to.hash) {
      return new Promise((resolve) => {
        setTimeout(() => {
          const element = document.querySelector(to.hash);
          if (element) {
            element.scrollIntoView({ behavior: 'smooth' });
          }
          resolve({ el: to.hash });
        }, 300);
      });
    }
    return { top: 0 };
  },
})

export default router