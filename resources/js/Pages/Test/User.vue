<script setup>
import { usePage } from '@inertiajs/vue3'
const { users } = usePage().props   
</script>

<template>
  <div>
    <h1>Users</h1>
    <ul>
      <li v-for="user in users" :key="user.id">
        {{ user.name }} - {{ user.email }}</li>
    </ul>
  </div>
</template>
