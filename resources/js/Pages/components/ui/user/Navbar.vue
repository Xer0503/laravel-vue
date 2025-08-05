<script setup>
import { ref } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

const auth = usePage().props.auth.user;

const navIcon = [
    {
        id: 1,
        title: 'home',
        iconbl: '/storage/icons/homebl.svg',
        iconSelected: '/storage/icons/home.svg'
    },
    {
        id: 2,
        title: 'profile',
        iconbl: '/storage/icons/profilebl.svg',
        iconSelected: '/storage/icons/profile.svg'
    }
];

const selectedNav = ref(navIcon[0].id);

const setSelected = (id) => {
    selectedNav.value = id;
};
</script>

<template>
    <div class="flex flex-col w-full px-3 py-2">
        <div class="flex justify-between items-center py-4 px-3">
            <span class="text-blue-600 font-black text-3xl">ficebook</span>
            <Link :href="route('createPost')">
                <span class="rounded-full text-2xl cursor-pointer">
                    <img src="/storage/app/public/icons/add.svg" loading="lazy" alt="add post" class="w-7 h-7" />
                </span>
            </Link>
        </div>
        <div class="flex justify-evenly px-5 cursor-pointer">
            <Link
                v-for="nav in navIcon"
                :key="nav.id"
                :href="route(nav.title)"
                @click="setSelected(nav.id)"
            >
                <img
                    :src="selectedNav === nav.id ? nav.iconSelected : nav.iconbl"
                    :alt="nav.title"
                    class="w-7 h-7"
                />
            </Link>
        </div>
    </div>
    <div class="bg-gray-200 h-[0.5px]"></div>
</template>