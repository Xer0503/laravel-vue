<script setup>
    import { usePage, Link, router } from '@inertiajs/vue3'; 
    import { toggle } from '../../../utils/nav';
    const user = usePage().props.auth.user;
    
    function navToggle(){
        toggle.value = !toggle.value
    }

</script>
<template>
    <div class="max-h-20 flex justify-between items-center">
        <span class="hidden md:block"></span>
        <span @click="navToggle()" class="md:hidden">toggle</span>
        <div class="flex space-x-2">
            <span>msg</span>
            <span>img</span>
            <span>{{user.name}}</span>
        </div>
    </div>
</template>