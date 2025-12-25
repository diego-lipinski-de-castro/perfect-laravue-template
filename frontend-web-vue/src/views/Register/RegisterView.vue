<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import RegisterLayout from './RegisterLayout.vue'
import { register } from '@/services/auth'
import { useUserStore } from '@/stores/user'
import type { RegisterParams } from './RegisterLayout.vue'

const router = useRouter()
const userStore = useUserStore()

const isLoading = ref(false)
const errorMessage = ref<string | null>(null)

const handleRegister = async (params: RegisterParams) => {
  isLoading.value = true
  errorMessage.value = null

  try {
    const response = await register(params)

    userStore.setToken(response.token)
    userStore.setUser(response.user)

    router.push('/profile')
  } catch (error: unknown) {
    if (error && typeof error === 'object' && 'response' in error) {
      const axiosError = error as { response?: { data?: { message?: string } } }
      errorMessage.value = axiosError.response?.data?.message || 'Registration failed. Please try again.'
    } else {
      errorMessage.value = 'Registration failed. Please try again.'
    }
  } finally {
    isLoading.value = false
  }
}
</script>

<template>
  <RegisterLayout
    loginLink="/login"
    @register="handleRegister"
  />
</template>
