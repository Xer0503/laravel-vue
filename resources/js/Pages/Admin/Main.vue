<script setup>
    import { ref } from 'vue';
    import Dashboard from './Dashboard.vue';
    import User from './User.vue';
    import Post from './Post.vue';
    import Sidebar from '../components/ui/admin/Sidebar.vue';
    import SideMobile from '../components/ui/admin/SideMobile.vue';
    import { toggle } from '../utils/nav';

    import { viewsSelected } from '../utils/views';
    import Navbar from '../components/ui/admin/Navbar.vue';
    const views = {
        1 : Dashboard,
        2 : User,
        3 : Post
    }

    function navToggle(){
        toggle.value = !toggle.value
    }

</script>
<template>
    <div class="grid grid-cols-12 row-span-12 overflow-hidden relative">
        <!--Sidebar-->
        <transition name="sidebar">
            <div v-if="toggle" class="h-screen bg-gray-700 col-span-2 px-7 py-10 hidden md:block">
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
        v-if="toggle == true"
        @click="navToggle"
        class="fixed inset-0 z-15 bg-black/30 backdrop-blur-sm md:hidden"
        ></div>

        <!--Main Content-->
        <div class="md:col-span-10 z-10"
        :class="{'col-span-12' : !toggle}"
        >
            <!--Nav-->
            <div class="px-5 py-3 shadow">
                <Navbar />
            </div>

            <div class="px-5 py-5 shadow-md bg-amber-200">
                <component :is="views[viewsSelected]" />
            </div>
        </div>
    </div>
</template>

<style scoped>

.sidebar-enter-from {
  transform: translateX(-100%);
}
.sidebar-enter-to {
  transform: translateX(0%);
}
.sidebar-enter-active,
.sidebar-leave-active {
  transition: all 0.3s ease;
}

.sidebar-leave-from {
  transform: translateX(0%);
}
.sidebar-leave-to {
  transform: translateX(-100%);
}

.sidebar2-leave-from {
  transform: translateX(0%);
}
.sidebar2-leave-to {
  transform: translateX(-100%);
} 

</style>