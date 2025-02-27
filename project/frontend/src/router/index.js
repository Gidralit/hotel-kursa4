import { createRouter, createWebHistory } from 'vue-router'
import { HomeView, NotFoundView, RegisterView, CatalogView, ProfileView, RoomView } from '@/views'

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
})

export default router