<script setup lang="ts">
import LoginLayout from './LoginLayout.vue';
import { useRequest } from '@/composables/useRequest';
import type { SignInWithEmailAndPasswordParams } from './LoginLayout.vue';

const handleSignInWithEmailAndPassword = async (params: SignInWithEmailAndPasswordParams) => {
  const { email, password } = params

  const { value, error, isLoading, submit } = useRequest({
    url: '/api/login',
    config: {
      method: 'POST',
      data: {
        email,
        password,
      },
    },
  })

  await submit()

  console.log(value)
  console.log(error)
  console.log(isLoading)
}

const handleSignInWithGoogle = async () => {
  console.log('sign in with google')
}

const handleSignInWithMicrosoft = async () => {
  console.log('sign in with microsoft')
}

</script>

<template>
  <LoginLayout forgotPasswordLink="/forgot-password" registerLink="/register"
    @signInWithEmailAndPassword="handleSignInWithEmailAndPassword" @signInWithGoogle="handleSignInWithGoogle"
    @signInWithMicrosoft="handleSignInWithMicrosoft" />
</template>
