<script setup>
import { usePage, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const following = ref(false);

const auth = usePage().props.auth.user
defineProps({
  post: {
    type: Object,
    required: true
  }
})

const form = useForm({
  id : null,
})

const follow = (id) => {
  form.get(`/home/follow/${id}`)
}

const unfollow = (id) => {
  form.get(`/home/unfollow/${id}`)
}

</script>

<template>
  <section v-if="post.visibility != 'private'" class="shadow p-4 rounded bg-white mb-4">
    <!-- Header -->
    <div class="flex items-center gap-3">
      <img
        :src="`/storage/${post.user.image}`"
        :alt="post.user.name"
        class="w-8 h-8 rounded-full"
      />
      <div>
        <h2 class="font-semibold">{{ post.user.name }}</h2>
        <p  v-if="auth.id != post.user.id" @click="follow(post.user.id)" class="text-sm text-gray-500 cursor-pointer">follow</p>
      </div>
    </div>

    <!-- Body -->
    <p class="mt-3">{{ post.body }}</p>

    <!-- Image -->
    <div v-if="post.image" class="mt-3">
      <img :src="`/storage/${post.image}`" :alt="post.image" class="w-full rounded object-cover" />
    </div>

    <!--Reaction-->
    <div class="px-5 py-2">
        <span>Like</span>
    </div>
  </section>
</template>
