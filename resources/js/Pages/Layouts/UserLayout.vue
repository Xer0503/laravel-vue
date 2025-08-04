<script setup>
    import FeedCard from '../components/ui/user/FeedCard.vue';
    import Navbar from '../components/ui/user/Navbar.vue';

</script>
<template>
    <div class="md:w-1/2 flex flex-col mx-auto px-2 shadow-md h-full">
        <!--Header-->
        <div>
            <Navbar />
        </div>
        <div class="py-[0.5px] bg-gray-200"></div>
        <!--Feeds-->
        <div class="h-full py-4">
            <FeedCard />
        </div>
    </div>
</template>