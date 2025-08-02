<script setup>
    import { ref } from 'vue';
    import Dashboard from './Dashboard.vue';
    import User from './User.vue';
    import Post from './Post.vue';
    import Sidebar from '../components/ui/admin/Sidebar.vue';

    const selectedViews = ref(1);
    const toggle = ref(true);

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
    <div class="grid grid-cols-12 row-span-12">
        <!--Sidebar-->
        <div v-if="toggle" class="h-screen bg-gray-400 col-span-3 px-7 py-10">
            <Sidebar />
        </div>
        <div v-if="!toggle" class="h-screen bg-gray-400 col-span-1">
            sidebar
        </div>

        <!--Main Content-->
        <div class="bg-gray-800 col-span-9"
        :class="{'col-span-11' : !toggle}"
        >
            <!--Header-->
            <div class="bg-gray-600 px-5 py-3">
                <div class="max-h-20 flex justify-between items-center">
                    <span @click="navToggle()">toggle</span>
                    <div class="flex space-x-2">
                        <span>msg</span>
                        <span>img</span>
                        <span>name</span>
                    </div>
                </div>
            </div>

            <div>
                <component :is="views[selectedViews]" />
            </div>
        </div>
    </div>
</template>

<style scoped>
    
</style>