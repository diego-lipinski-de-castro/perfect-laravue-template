import { createRouter, createWebHistory } from 'vue-router'
import LoginLayout from '@/views/Login/LoginLayout.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: LoginLayout,
    },
  ],
})

export default router
