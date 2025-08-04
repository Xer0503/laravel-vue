<script setup>
    import { usePage, Link, router } from '@inertiajs/vue3'; 
    const user = usePage().props.auth.user;

    import { useForm } from '@inertiajs/vue3';
    import UserLayout from '../Layouts/UserLayout.vue';

    const form = useForm({
        name: '',
        email: '',
        password: '',
        image: null, // for image file
    });
    
    defineOptions({
        layout : UserLayout
    })

</script>
<template>
    
</template>