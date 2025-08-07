<script setup>
import { computed } from 'vue';
import { usePage, Link } from '@inertiajs/vue3';
import { route } from 'ziggy-js';

// Get the current route name
const currentRoute = computed(() => usePage().url);

// Nav items config
const navItems = [
  {
    id: 1,
    name: 'home',
    iconDefault: '/storage/icons/homebl.svg',
    iconActive: '/storage/icons/home.svg',
    route: 'home',
  },
  {
    id: 2,
    name: 'profile',
    iconDefault: '/storage/icons/profilebl.svg',
    iconActive: '/storage/icons/profile.svg',
    route: 'profile',
  },
];
</script>

<template>
  <div class="w-full px-3 py-2 bg-white shadow-sm">
    <!-- Header -->
    <div class="flex justify-between items-center py-4 px-3">
      <span class="text-blue-600 font-black text-3xl">ficebook</span>
      <Link :href="route('createPost')">
        <img
          src="/storage/app/public/icons/add.svg"
          alt="Add Post"
          class="w-7 h-7"
          loading="lazy"
        />
      </Link>
    </div>

    <!-- Nav Icons -->
    <div class="flex justify-evenly px-5">
      <Link
        v-for="nav in navItems"
        :key="nav.id"
        :href="route(nav.route)"
        class="flex items-center"
      >
        <img
          :src="currentRoute.includes(nav.route) ? nav.iconActive : nav.iconDefault"
          :alt="nav.name"
          class="w-7 h-7"
        />
      </Link>
    </div>
  </div>
  <div class="bg-gray-200 h-[0.5px]"></div>
</template>