<script setup>
import { usePage } from '@inertiajs/vue3'
import Sidebar from '../components/ui/admin/Sidebar.vue'
import SideMobile from '../components/ui/admin/SideMobile.vue'
import Navbar from '../components/ui/admin/Navbar.vue'
import { toggle } from '../utils/nav'
const admin = usePage().props.auth.user

function navToggle() {
  toggle.value = !toggle.value
}
</script>

<template>
  <div class="grid grid-cols-12 row-span-12 overflow-hidden relative">
    <!--Sidebar-->
    <transition name="sidebar">
      <div class="h-screen bg-gray-700 col-span-2 px-7 py-10 hidden md:block">
        <Sidebar />
      </div>
    </transition>

    <!--Sidebar mobile-->
    <transition name="sidebar">
      <div v-if="toggle" class="h-screen md:hidden bg-gray-700 w-[70%] py-10 px-7 z-20 fixed">
        <SideMobile />
      </div>
    </transition>

    <!-- Mobile Overlay Blur -->
    <div
      v-if="toggle"
      @click="navToggle"
      class="fixed inset-0 z-15 bg-black/30 backdrop-blur-sm md:hidden"
    ></div>

    <!-- Main Content -->
    <div class="md:col-span-10 z-10" :class="{ 'col-span-12': !toggle }">
      <div class="px-5 py-3 shadow">
        <Navbar />
      </div>
      <div class="px-5 py-5 shadow-md h-full">
        <slot />
      </div>
    </div>
  </div>
</template>
