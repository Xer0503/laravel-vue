<script setup>
    import { usePage } from '@inertiajs/vue3';
    const user = usePage().props.auth.user;
</script>
<template>
    <div>
        <h1>Welcome, {{ user.name }}!</h1>
    </div>
</template>