<script setup>
    import { usePage } from '@inertiajs/vue3';
    const auth = usePage().props.auth.user

    defineProps({
        post: {
            type: Object,
            required: true
        }
    })
</script>

<template>
    <section v-if="post.user_id == auth.id" class="flex flex-col">
        <!--Header Card-->
        <div class="flex flex-col px-3 py-4">
            <div class="flex items-center space-x-3">
                <span>
                    <img :src="`/storage/${post.user.image}`" :alt="post.user.image" class="w-10 h-10 rounded-full object-cover" />
                </span>
                <span class="flex flex-col">
                    <span>{{ post.user.name }}</span>
                    <span class="text-sm text-gray-600">1d</span>
                </span>
            </div>
            <span>
                {{ post.body }}
            </span>
        </div>

        <!--Body Card-->
        <div class="py-2 flex justify-center">
            <img :src="`storage/${post.image}`" :alt=auth.image class="object-cover"/>
        </div>

        <!--Footer-->
        <div class="py-3 px-3">
            <span>Like</span>
        </div>
        <div class="py-[0.5px] bg-gray-200"></div>
    </section>
</template>