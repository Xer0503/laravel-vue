<script setup>
    import { usePage, Link, router } from '@inertiajs/vue3'; 
    const user = usePage().props.auth.user;

    const logout = () => {
        router.post('/logout')
    } 

</script>
<template>
    <div>
        <h1>Welcome, {{ user.name }}!</h1>
        <h1 v-if="user.status">Active</h1>
        <h1 v-else>Inactive</h1>
        <button @click="logout()" class="bg-blue-600 rounded-2xl py-2 px-2 cursor-pointer">logout</button>
    </div>
</template>