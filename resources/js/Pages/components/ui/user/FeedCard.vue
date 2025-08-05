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
  <section v-if="post.visibility != 'private'" class="shadow p-4 rounded bg-white mb-4">
    <!-- Header -->
    <div class="flex items-center gap-3">
      <img
        :src="`/storage/${post.user.image}`"
        :alt="post.user.name"
        class="w-8 h-8 rounded-full object-cover"
      />
      <div>
        <h2 class="font-semibold">{{ post.user.name }}</h2>
        <p class="text-sm text-gray-500">{{ post.created_at }}</p>
      </div>
    </div>

    <!-- Body -->
    <p class="mt-3">{{ post.body }}</p>

    <!-- Image -->
    <div v-if="post.image" class="mt-3">
      <img :src="`/storage/${post.image}`" :alt="post.image" class="w-full rounded" />
    </div>
  </section>
</template>
