<script setup>
import { usePage } from '@inertiajs/vue3'
const { users } = usePage().props   

import { useForm } from '@inertiajs/vue3';

const form = useForm({
  name: '',
  email: '',
  password: '',
  image: null, // for image file
});

function handleFileUpload(e) {
  form.image = e.target.files[0];
}

function submit() {
  form.post('/user/update', {
    forceFormData: true, // IMPORTANT for file uploads
    onSuccess: () => {
      console.log('Updated');
    }
  });
}


</script>

<template>
  <div>
    <h1>Users</h1>
    <ul>
      <li v-for="user in users" :key="user.id">
        {{ user.name }} - {{ user.email }} {{ user.role }}  {{ user.status }}
            <img
        v-if="user.image"
        :src="`/storage/${user.image}`"
        alt="Profile picture"
        class="h-16 w-16 rounded-full object-cover"
      />
      </li>
    </ul>
  </div>

  <div>
    <form @submit.prevent="submit">
      <input type="text" v-model="form.name" />
      <input type="email" v-model="form.email" />
      
      <input type="file" @change="handleFileUpload" />

      <button type="submit">Update</button>
    </form>
  </div>
</template>
