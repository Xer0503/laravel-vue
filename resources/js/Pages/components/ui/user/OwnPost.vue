<script setup>
    import { usePage, useForm } from '@inertiajs/vue3';
    import { ref } from 'vue';
    const auth = usePage().props.auth.user
    const form = useForm({})
    
    const drop = ref(false);

    defineProps({
        post: {
            type: Object,
            required: true
        }
    })

    function deletePost(id){
        form.delete(`/profile/post/${id}`, {
            onSuccess: () => {
                Inertia.visit(route('profile'), {
                preserveScroll: true,
                });
            }
        });
    }

    const dropDown = () => {drop.value = !drop.value}
</script>

<template>
    <section v-if="post.user_id == auth.id" class="flex flex-col">
        <!--Header Card-->
        <div class="flex flex-col py-4 space-y-2.5">
            <div class="flex justify-between items-center space-x-3">
                <div class="flex items-center space-x-3">
                    <span>
                        <img :src="`/storage/${post.user.image}`" :alt="post.user.image" class="w-10 h-10 rounded-full shadow-md" />
                    </span>
                    <span class="flex flex-col">
                        <span>{{ post.user.name }}</span>
                        <span class="text-sm text-gray-600">{{ post.visibility }}</span>
                    </span>
                </div>
                <div class="flex flex-col justify-end items-end">
                    <span @click="dropDown" class="text-lg font-black cursor-pointer">. . .</span>
                    <div v-if="drop">
                        <span @click="deletePost(post.id)" class="cursor-pointer">
                            delete post
                        </span>
                    </div>
                </div>
            </div>
            <span>
                {{ post.body }}
            </span>
        </div>

        <!--Body Card-->
        <div class="py-2 flex justify-center w-full">
            <img :src="`storage/${post.image}`" :alt=auth.image class="object-cover w-"/>
        </div>

        <!--Footer-->
        <div class="py-3 px-3">
            <span>Like</span>
        </div>
        <div class="py-[0.5px] bg-gray-200"></div>
    </section>
</template>