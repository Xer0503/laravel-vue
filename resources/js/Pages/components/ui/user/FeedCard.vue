<script setup>
import { usePage, useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { Inertia } from '@inertiajs/inertia';
const form = useForm({ id: null, type: '' });

const auth = usePage().props.auth.user;
const followings = usePage().props.followings;
const reactions = ref(false)

const selectedReact = (type, id) => {
  form.type = type;
  form.post(`/home/react/${id}`), {
      preserveScroll: true,
      onSuccess: () => {
          closeReactions();
          Inertia.reload({ only: ['posts'] });
      }
  };
}

const reactionsSelection = [
  {id : 1, value : 'like', icon : 'like'},
  {id : 2, value : 'heart', icon : 'heart'},
  {id : 3, value : 'haha', icon : 'haha'},
  {id : 4, value : 'wow', icon : 'wow'},
  {id : 5, value : 'sad', icon : 'sad'},
  {id : 5, value : 'angry', icon : 'angry'}
]

const props = defineProps({
  post: {
    type: Object,
    required: true
  }
})

const viewReactions = () => {
  reactions.value = true
}

const closeReactions = () => {
  reactions.value = false
}

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
</script>



<template>
  <section v-if="canViewPost" class="shadow p-4 rounded bg-white mb-4">
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

    <!-- Reaction -->
    <div class="px-5 pt-5 flex justify-evenly">

      <div class="relative">
        <div v-if="reactions" class="absolute bottom-7 left-5">
          <form @submit.prevent="selectedReact">
          <div class="flex space-x-2.5 py-3">
              <label v-for="reaction in reactionsSelection" :key="reaction.id" for="react" class="cursor-pointer flex items-center space-x-1">
                <p @click="selectedReact(reaction.value, post.id); ">{{ reaction.icon }}</p>
              </label>
              <input
                id="react"
                type="text"
                class="hidden"
                v-model="form.type"
              />
            </div>
          </form>
        </div>
        <span @click="reactions = !reactions" class="cursor-pointer">Like</span>
      </div>
      <span class="cursor-pointer">Comments</span>
    </div>
  </section>
</template>
