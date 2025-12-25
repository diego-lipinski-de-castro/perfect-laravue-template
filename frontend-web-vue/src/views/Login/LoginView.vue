<script setup lang="ts">
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import LoginLayout from './LoginLayout.vue'
import { login } from '@/services/auth'
import { useUserStore } from '@/stores/user'
import type { SignInWithEmailAndPasswordParams } from './LoginLayout.vue'

const router = useRouter()
const userStore = useUserStore()

const isLoading = ref(false)
const errorMessage = ref<string | null>(null)

const handleSignInWithEmailAndPassword = async (params: SignInWithEmailAndPasswordParams) => {
  const { email, password } = params

  isLoading.value = true
  errorMessage.value = null

  try {
    const response = await login({ email, password })

    userStore.setToken(response.token)
    userStore.setUser(response.user)

    router.push('/profile')
  } catch (error: unknown) {
    if (error && typeof error === 'object' && 'response' in error) {
      const axiosError = error as { response?: { data?: { message?: string } } }
      errorMessage.value = axiosError.response?.data?.message || 'Login failed. Please try again.'
    } else {
      errorMessage.value = 'Login failed. Please try again.'
    }
  } finally {
    isLoading.value = false
  }
}

const handleSignInWithGoogle = async () => {
  console.log('sign in with google')
}

const handleSignInWithMicrosoft = async () => {
  console.log('sign in with microsoft')
}
</script>

<template>
  <LoginLayout
    forgotPasswordLink="/forgot-password"
    registerLink="/register"
    @signInWithEmailAndPassword="handleSignInWithEmailAndPassword"
    @signInWithGoogle="handleSignInWithGoogle"
    @signInWithMicrosoft="handleSignInWithMicrosoft"
  />
</template>
