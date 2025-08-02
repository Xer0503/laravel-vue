<script setup>
import { Link, router } from '@inertiajs/vue3'
import { route } from 'ziggy-js'

const logout = () => {
    router.post(route('logout'))
} 

</script>

<template>
    <div class="h-full flex-col justify-between text-white">
        <div class="h-1/4">
            <h1 class="text-4xl font-bold text-center">Admin</h1>
        </div>
        <div class="h-2/4">
            <ul class="space-y-2">
              <li>
                <Link :href="route('dashboard')" class="text-white font-bold">Dashboard</Link>
              </li>
              <li>
                <Link :href="route('admin.user')" class="text-white font-bold">User</Link>
              </li>
              <li>
                <Link :href="route('admin.post')" class="text-white font-bold">Post</Link>
              </li>
            </ul>
        </div>
        <div class="flex flex-col justify-end h-1/4">
            <button @click="logout()" class="cursor-pointer">Logout</button>
        </div>
    </div>
</template>
