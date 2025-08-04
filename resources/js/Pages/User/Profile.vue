<script setup>
    import { usePage, Link, router } from '@inertiajs/vue3'; 
    import ProfileCard from '../components/ui/user/ProfileCard.vue';
    const user = usePage().props.auth.user;

    import { useForm } from '@inertiajs/vue3';
    import UserLayout from '../Layouts/UserLayout.vue';

    const form = useForm({
        name: '',
        email: '',
        password: '',
        image: null,
    });
    
    defineOptions({
        layout : UserLayout
    })

</script>
<template>
    <ProfileCard />
</template>