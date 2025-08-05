<script setup>
    import { usePage, Link, router } from '@inertiajs/vue3'; 
    import { route } from 'ziggy-js';
    import { useForm } from '@inertiajs/vue3';
    import UserLayout from '../Layouts/UserLayout.vue';
    import FeedCard from '../components/ui/user/FeedCard.vue';
    
    const auth = usePage().props.auth.user;
    const { posts } = usePage().props

    
    defineOptions({
        layout : UserLayout
    })


</script>
<template>
    <div class="flex justify-between items-center pb-5 px-5 my-auto">
        <span>
            <Link :href="route('profile')">
                <img 
                v-if="auth.image"
                :src="`storage/${auth.image}`" alt="profile" class="w-10 h-10 rounded-full" />
                <img 
                v-else
                src="/storage/app/public/users/default.svg" alt="profile" class="w-10 h-10 rounded-full" />
            </Link>
        </span>
        <div  class="w-[70%]">
            <Link :href="route('createPost')">
                <span class="text-sm w-full outline-1 rounded-r-2xl rounded-l-2xl outline-gray-500 px-5 py-2 flex items-center">What's on your mind?</span>
            </Link>
        </div>
        <div>
            <Link :href="route('createPost')">
                <span>
                    <img src="/storage/app/public/icons/photo.svg" alt="add post" class="w-7 h-7">
                </span>
            </Link>
        </div>
    </div>
    <div class="py-[0.5px] bg-gray-200"></div>
    <div>
        <FeedCard v-for="post in posts" :key="post.id" :post="post" />
    </div>
</template>

<style scoped>
</style>