import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

export const useUserStore = defineStore('user', () => {
  const user = ref<unknown>(null)

  const currentUser = computed(() => user.value)

  function setUser(newUser: unknown) {
    user.value = newUser
  }

  return { currentUser, setUser }
})
