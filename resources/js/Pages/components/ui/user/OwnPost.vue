<script setup>
    import { usePage } from '@inertiajs/vue3';
    const auth = usePage().props.auth.user
</script>

<template>
    <section class="flex flex-col shadow">
        <!--Header Card-->
        <div class="flex flex-col px-3 py-4">
            <div class="flex items-center space-x-3">
                <span>
                    img
                </span>
                <span class="flex flex-col">
                    <span>Rexie Villanueva</span>
                    <span class="text-sm text-gray-600">1d</span>
                </span>
            </div>
            <span>
                title
            </span>
            <span>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel ducimus veniam possimus porro voluptas quis corrupti? Soluta optio explicabo nostrum possimus id esse provident modi! Praesentium obcaecati fugit cum corporis?
            </span>
        </div>

        <!--Body Card-->
        <div class="py-2">
            <img :src="`storage/${auth.image}`" :alt=auth.image class="object-cover"/>
        </div>

        <!--Footer-->
        <div class="py-3 px-3">
            <span>Like</span>
        </div>
        <div class="py-[0.5px] bg-gray-200"></div>
    </section>
</template>