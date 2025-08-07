<script setup>
import { usePage, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const auth = usePage().props.auth.user;
const followings = usePage().props.followings;

const props = defineProps({
  post: {
    type: Object,
    required: true
  }
})

const form = useForm({ id: null })

const isFollowing = ref(
  followings.some(f => f.id === props.post.user.id)
)

const toggleFollow = () => {
  if (isFollowing.value) {
    form.delete(`/unfollow/${props.post.user.id}`, {
      preserveScroll: true,
      onSuccess: () => {
        isFollowing.value = false;
        Inertia.reload({ only: ['posts'] });
      }
    });
  } else {
    form.post(`/follow/${props.post.user.id}`, {
      preserveScroll: true,
      onSuccess: () => {
        isFollowing.value = true;
        Inertia.reload({ only: ['posts'] });
      }
    });
  }
}
</script>


<template>
  <section v-if="post.visibility === 'public' || isFollowing || auth.id === post.user.id" class="shadow p-4 rounded bg-white mb-4">
    <!-- Header -->
    <div class="flex items-center gap-3">
      <img
        :src="`/storage/${post.user.image}`"
        :alt="post.user.name"
        class="w-8 h-8 rounded-full"
      />
      <div>
        <h2 class="font-semibold">{{ post.user.name }}</h2>

        <!-- Show Follow/Unfollow if not the same user -->
        <p
          v-if="auth.id !== post.user.id"
          @click="toggleFollow"
          class="text-sm text-blue-600 hover:underline cursor-pointer"
        >
          {{ isFollowing ? 'Unfollow' : 'Follow' }}
        </p>
        <p v-else class="text-sm text-gray-600 hover:underline cursor-pointer">
          You
        </p>
      </div>
    </div>

    <!-- Body -->
    <p class="mt-3">{{ post.body }}</p>

    <!-- Image -->
    <div v-if="post.image" class="mt-3">
      <img :src="`/storage/${post.image}`" :alt="post.image" class="w-full rounded object-cover" />
    </div>

    <!-- Reaction -->
    <div class="px-5 py-2">
      <span>Like</span>
    </div>
  </section>
</template>
