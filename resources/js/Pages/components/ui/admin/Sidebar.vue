<script setup>
    import { ref } from 'vue';
    import { viewsSelected } from '../../../utils/views';
    import { toggle } from '../../../utils/nav';
    const management = [
        {id : 1, title : 'DASHBOARD', icon : 'icon'},
        {id : 2, title : 'USER', icon : 'icon'},
        {id : 3, title : 'POST', icon : 'icon'}
        ]
        
    const drop = management.reduce((map, manage) => {
        map[manage.id] = ref(false)
        return map;
    }, {})



</script>

<template>
    <div class="flex flex-col justify-between h-screen md:h-full text-white">

        <div class="flex flex-col md:gap-y-5 h-full">
            <div class="">
                <h1 class="text-5xl font-bold text-center text-white">Admin</h1>
            </div>
            <div class="h-full flex items-center">
                <ul class="space-y-2">
                    <li v-for="manage in management" :key="manage.id" class="w-full cursor-pointer">
                        <div @click="viewsSelected = manage.id; drop[manage.id].value = !drop[manage.id]; toggle = false" class="flex justify-between items-center">
                            <div class="flex space-x-2 text-sm font-bold">
                                <span>{{ manage.icon }}</span>
                                <span>{{ manage.title }}</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="bg-red-600 h-[20%]">
            <div>
                Footer
            </div>
        </div>
    </div>
</template>