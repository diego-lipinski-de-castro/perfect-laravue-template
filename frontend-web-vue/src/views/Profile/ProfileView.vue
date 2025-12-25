<script setup lang="ts">
import { onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useUserStore } from '@/stores/user'

const router = useRouter()
const userStore = useUserStore()

onMounted(async () => {
  if (!userStore.currentUser) {
    await userStore.fetchUser()
  }
})

const handleLogout = () => {
  userStore.logout()
  router.push('/login')
}
</script>

<template>
  <div class="min-h-full bg-gray-50">
    <nav class="bg-white shadow">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
          <div class="flex items-center">
            <img class="h-8 w-auto" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=blue&shade=600" alt="Your Company" />
          </div>
          <div class="flex items-center">
            <button
              @click="handleLogout"
              class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
            >
              Sign out
            </button>
          </div>
        </div>
      </div>
    </nav>

    <div class="py-10">
      <header class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">Profile</h1>
      </header>

      <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div v-if="userStore.currentUser" class="mt-8 bg-white shadow sm:rounded-lg">
          <div class="px-4 py-5 sm:p-6">
            <div class="sm:flex sm:items-center sm:justify-between">
              <div class="flex items-center gap-4">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-blue-600 text-xl font-semibold text-white">
                  {{ userStore.currentUser.name.charAt(0).toUpperCase() }}
                </div>
                <div>
                  <h3 class="text-lg font-medium text-gray-900">{{ userStore.currentUser.name }}</h3>
                  <p class="text-sm text-gray-500">{{ userStore.currentUser.email }}</p>
                </div>
              </div>
            </div>

            <dl class="mt-8 grid grid-cols-1 gap-6 sm:grid-cols-2">
              <div>
                <dt class="text-sm font-medium text-gray-500">User ID</dt>
                <dd class="mt-1 text-sm text-gray-900">{{ userStore.currentUser.id }}</dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500">Email verified</dt>
                <dd class="mt-1 text-sm text-gray-900">
                  {{ userStore.currentUser.email_verified_at ? 'Yes' : 'No' }}
                </dd>
              </div>
              <div>
                <dt class="text-sm font-medium text-gray-500">Member since</dt>
                <dd class="mt-1 text-sm text-gray-900">
                  {{ new Date(userStore.currentUser.created_at).toLocaleDateString() }}
                </dd>
              </div>
            </dl>
          </div>
        </div>

        <div v-else class="mt-8 text-center text-gray-500">
          Loading profile...
        </div>
      </main>
    </div>
  </div>
</template>
