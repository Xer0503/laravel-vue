<script setup>
    import { usePage, Link, router } from '@inertiajs/vue3'; 
    import { useForm } from '@inertiajs/vue3';
    import UserLayout from '../Layouts/UserLayout.vue';
    import FeedCard from '../components/ui/user/FeedCard.vue';
    
    const user = usePage().props.auth.user;
    const { posts } = usePage().props

    
    defineOptions({
        layout : UserLayout
    })


</script>
<template>
    <div>
        <FeedCard v-for="post in posts" :key="post.id" :post="post" />
    </div>
</template>