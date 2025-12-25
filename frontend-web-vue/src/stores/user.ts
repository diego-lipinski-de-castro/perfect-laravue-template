import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import type { User } from '@/services/auth'
import { me } from '@/services/auth'

export const useUserStore = defineStore('user', () => {
  const user = ref<User | null>(null)
  const token = ref<string | null>(localStorage.getItem('token'))

  const currentUser = computed(() => user.value)
  const isAuthenticated = computed(() => !!token.value)

  function setUser(newUser: User | null) {
    user.value = newUser
  }

  function setToken(newToken: string | null) {
    token.value = newToken
    if (newToken) {
      localStorage.setItem('token', newToken)
    } else {
      localStorage.removeItem('token')
    }
  }

  async function fetchUser() {
    if (!token.value) return

    try {
      const response = await me()
      user.value = response.user
    } catch {
      setToken(null)
      user.value = null
    }
  }

  function logout() {
    setToken(null)
    user.value = null
  }

  return {
    currentUser,
    isAuthenticated,
    setUser,
    setToken,
    fetchUser,
    logout,
  }
})
