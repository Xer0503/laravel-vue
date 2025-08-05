<script setup>
    import { usePage, Link } from '@inertiajs/vue3';
    import { route } from 'ziggy-js';
    const auth = usePage().props.auth.user;

</script>
<template>
    <div class="flex flex-col w-full px-3 py-2">
        <div class="flex justify-between items-center">
            <span class="text-blue-600 font-bold text-2xl">ficebook</span>
            <Link :href="route('createPost')">
                <span class="rounded-full text-2xl cursor-pointer">+</span>
            </Link>
        </div>
        <div class="flex justify-evenly px-5 py-3 cursor-pointer">
            <Link :href="route('home')">
                <span>Home</span>
            </Link>
            <Link :href="route('profile')">
                <span>Profile</span>
            </Link>
        </div>

        <div class="flex justify-between items-center py-2">
            <span>
                <Link :href="route('profile')">
                    <img 
                    v-if="auth.image"
                    :src="`storage/${auth.image}`" alt="profile" class="w-10 h-10 rounded-full object-cover" />
                </Link>
            </span>
            <div  class="w-[70%]">
                <Link :href="route('createPost')">
                    <span class="text-sm w-full outline-1 rounded-r-2xl rounded-l-2xl outline-gray-500 px-5 py-2 flex items-center">What's on your mind?</span>
                </Link>
            </div>
            <div>

                <Link :href="route('createPost')">
                    <span>add pic</span>
                </Link>
            </div>
        </div>
    </div>
</template>