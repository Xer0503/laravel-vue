<script setup>
import { usePage, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
const form = useForm({ id: null, body : '' });
const auth = usePage().props.auth.user;
const followings = usePage().props.followings;
const comment = ref(false);
const closeComment = () => {comment.value = false};
const showComment = () => {comment.value = true};

const props = defineProps({
  post: {
    type: Object,
    required: true
  }
})

const isFollowing = ref(
  followings.some(f => f.id === props.post.user.id)
);

const canViewPost = computed(() => {
  if (auth.id === props.post.user.id) return true;
  if (props.post.visibility === 'public') return true;
  if (props.post.visibility === 'followers' && isFollowing.value) return true;
  return false;
});

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
};

const submit = () => {
  form.post(`home/comment/${props.post.id}`)
}

</script>

<template>
  <div class="relative">
    <section v-if="canViewPost" class="shadow p-4 rounded bg-white mb-4 overflow-hidden">
      <!-- Header -->
      <div class="flex items-center gap-3">
        <img
          v-if="post.user.image"
          :src="`/storage/${post.user.image}`"
          :alt="post.user.name"
          class="w-8 h-8 rounded-full"
        />
        <img
          v-else
          src="/storage/app/public/users/default.svg"
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
          <p v-else class="text-sm text-gray-600">You</p>
        </div>
      </div>
  
      <!-- Body -->
      <p class="mt-3">{{ post.body }}</p>
  
      <!-- Image -->
      <div v-if="post.image" class="mt-3">
        <img :src="`/storage/${post.image}`" :alt="post.image" class="w-full rounded object-cover" />
      </div>
  
      <!-- Comments -->
      <div class="px-5 pt-5 flex justify-center items-center">
        <span @click="showComment" class="cursor-pointer">Comments</span>
      </div>
    </section>

    <div v-if="comment" class="fixed inset-0 bg-black/30 backdrop-blur-md z-5"></div>
    <!--Comment Section-->
    <section v-if="comment" class="absolute inset-0 z-10">
      <div @click="closeComment" class="cursor-pointer">
        back
      </div>

      <div>
        <div>
          <span class="flex space-x-3">
            <img
              v-if="post.user.image"
              :src="`/storage/${post.user.image}`"
              :alt="post.user.name"
              class="w-8 h-8 rounded-full"
            />
            <img
              v-else
              src="/storage/app/public/users/default.svg"
              :alt="post.user.name"
              class="w-8 h-8 rounded-full"
            />
            <span>{{ post.user.name }}</span>
          </span>
        </div>
      </div>

      <div class="mt-3">
        <span>{{ post.body }}</span>
        <img v-if="post.image" :src="`/storage/${post.image}`" :alt="post.image" class="w-full rounded object-cover" />
      </div>

      <div>
        <form @submit.prevent="submit">
          <div class="flex justify-between">
            <input type="text" v-model="form.comment" class="w-[90%] bg-gray-white rounded-2xl px-5" />
            <button type="submit" class="py-2 px-3">comment</button>
          </div>
        </form>
      </div>
    </section>

  </div>



</template>
