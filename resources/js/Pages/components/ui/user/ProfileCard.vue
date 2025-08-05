<script setup>
import { usePage, useForm, Link, router } from '@inertiajs/vue3';
import OwnPost from './OwnPost.vue';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { route } from 'ziggy-js';

const posts = usePage().props.posts.post;
const auth = usePage().props.auth.user;

const modal = ref(false);

const viewModal = () => {
    modal.value = true;
};
const closeModal = () => {
    modal.value = false;
};

const form = useForm({
    image: null,
});

function handleFileUpload(e) {
    form.image = e.target.files[0];
}

function submit() {
    form.post('/profile/changeProfile', {
        forceFormData: true,
        onSuccess: () => {
            closeModal();
            Inertia.reload({
                preserveScroll: true,
                only: ['auth'],
            });
        },
    });
}

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div class="relative min-h-screen bg-gray-50">
        <!-- Profile Section -->
        <section class="flex flex-col items-center py-10 bg-white shadow-md rounded-b-3xl">
            <img
                :src="`/storage/${auth.image}`"
                :alt="auth.image"
                loading="lazy"
                class="w-32 h-32 rounded-full shadow-md"
            />
            <h2 class="mt-4 text-2xl font-semibold text-gray-800">{{ auth.name }}</h2>

            <div class="mt-3 flex flex-col justify-center items-center">
                <button
                    @click="viewModal"
                    class="px-4 rounded cursor-pointer"
                >
                    Change Profile
                </button>
                <button
                    @click="logout"
                    class="px-4 rounded cursor-pointer"
                >
                    Logout
                </button>
            </div>
        </section>

        <!-- Divider -->
        <div class="border-t border-gray-200 my-5"></div>

        <!-- Posts Section -->
        <section class="px-6 md:px-10 space-y-6">
            <OwnPost v-for="post in posts" :key="post.id" :post="post" />
        </section>

        <!-- Modal Overlay -->
        <div v-if="modal" class="fixed inset-0 bg-black bg-opacity-50 z-40 flex items-center justify-center">
            <!-- Modal Box -->
            <div class="bg-white rounded-lg shadow-lg p-6 w-11/12 max-w-md relative z-50">
                <h3 class="text-lg font-semibold mb-4 text-gray-700">Change Profile Image</h3>
                <form @submit.prevent="submit" class="flex flex-col gap-4">
                    <input
                        type="file"
                        @change="handleFileUpload"
                        class="bg-gray-100 px-4 py-2 rounded border border-gray-300"
                    />
                    <div class="flex justify-end space-x-3">
                        <button
                            @click="closeModal"
                            type="button"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded transition"
                        >
                            Cancel
                        </button>
                        <button
                            type="submit"
                            :disabled="form.processing"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition"
                        >
                            Change
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>