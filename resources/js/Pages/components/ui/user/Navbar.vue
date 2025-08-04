<script setup>
    import { usePage } from '@inertiajs/vue3';
    const auth = usePage().props.auth.user;

</script>
<template>
    <div class="flex flex-col w-full px-3 py-2">
        <div class="flex justify-between items-center">
            <span class="text-blue-600 font-bold text-2xl">ficebook</span>
            <span>+</span>
        </div>
        <div class="flex justify-between px-5 py-3">
            <span>Home</span>
            <span>Profile</span>
        </div>

        <div class="flex justify-between py-4">
            <span>
                <img 
                v-if="auth.image"
                :src="`storage/${auth.image}`" alt="profile" class="w-10 h-10 rounded-full object-cover" />
            </span>
            <span class="text-sm w-[70%] outline-1 rounded-r-2xl rounded-l-2xl outline-gray-500 px-5 flex items-center">What's on your mind?</span>
            <span>add pic</span>
        </div>
    </div>
</template>