<script setup>
    const management = [
        {id : 1, title : 'USER', icon : 'icon'},
        {id : 2, title : 'POST', icon : 'icon'}
        ]
    
</script>

<template>
    <div class="flex flex-col justify-between h-full">
        <div class="flex flex-col gap-y-5">
            <div class="    ">
                <h1 class="text-5xl font-bold text-center text-white">Admin</h1>
            </div>
            <div class="h-full">
                <ul>
                    <li v-for="manage in management" :key="manage.id" class="w-full cursor-pointer">
                        <div class="flex space-x-2">
                            <span>{{ manage.icon }}</span>
                            <span><p class="font-bold">{{ manage.title }}</p></span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <div>
                Footer
            </div>
        </div>
    </div>
</template>