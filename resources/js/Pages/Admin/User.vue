<script setup>
import AdminLayout from '../Layouts/AdminLayout.vue';
import { usePage } from '@inertiajs/vue3'
const { users } = usePage().props   
defineOptions({
  layout: AdminLayout
})
</script>

<template>
  <table class="w-full text-center rounded shadow">
    <thead class="bg-gray-600 text-white font-bold">
        <td>id</td>
        <td>name</td>
        <td>email</td>
        <td>role</td>
        <td>status</td>
        <td>action</td>
    </thead>
    <tbody>
        <tr v-for="user in users" :key="user.id">
            <td class="">{{ user.id }}</td>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.role }}</td>
            <td v-if="user.status">Active</td>
            <td v-else>Inactive</td>
            <td>
                <button>Edit</button>
                <button>Delete</button>
            </td>
        </tr>
    </tbody>
  </table>
</template>
