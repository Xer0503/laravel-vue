<script setup>
    import { useForm, usePage } from '@inertiajs/vue3';
    import { ref } from 'vue';
    const auth = usePage().props.auth.user;
    const form = useForm({});
    const deleteDrop = ref(false);
    const showdelete = () => {deleteDrop.value = !deleteDrop.value};
    const props = defineProps({
        comment: {
            type: Object,
            required: true
        }
    });

    const deleteComment = (id) => {
        form.delete(`/home/comment/${id}`, {
            preserveScroll: true,
            onSuccess: () => {
            Inertia.reload({ only: ['posts'] });
            },
        });
    };

</script>

<template>
  <div class="px-2 py-3 space-y-2 border-b border-gray-200">
    <span class="flex items-center space-x-2">
      <img
        v-if="comment.user.image"
        :src="`/storage/${comment.user.image}`"
        :alt="comment.user.name"
        class="w-7 h-7 rounded-full"
      />
      <img
        v-else
        src="/storage/app/public/users/default.svg"
        :alt="comment.user.name"
        class="w-7 h-7 rounded-full"
      />
      <p class="font-medium">{{ comment.user.name }} <span v-if="comment.user.name === auth.name" class="text-gray-600 text-sm">( you )</span> </p>
    </span>
    <div class="flex justify-between items-center">
        <p class="text-sm">{{ comment.body }}</p>
        <span v-if="auth && auth.id === comment.user_id" class="cursor-pointer flex flex-col justify-end items-end">
            <span @click="deleteComment(comment.id)" v-if="deleteDrop">
                delete comment
            </span>
            <span @click="showdelete" class="font-bold">
                . . .
            </span>
        </span>
    </div>
  </div>
</template>
