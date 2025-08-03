<script setup>
    import { usePage, Link, router } from '@inertiajs/vue3'; 
    const user = usePage().props.auth.user;

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

    function submit(id) {
        form.post(`/user/update/${user.id}`, {
        forceFormData: true, // IMPORTANT for file uploads
        onSuccess: () => {
        console.log('Updated');
            }
        });
    }

    const logout = () => {
        router.post('/logout')
    } 

</script>
<template>
    <div>
        <button @click="logout()" class="bg-blue-600 rounded-2xl py-2 px-2 cursor-pointer">logout</button>
    </div>
    <div>
    <form @submit.prevent="submit">
      <input type="text" v-model="form.name" class="outline"/>
      <input type="email" v-model="form.email" class="outline" />
      
      <input type="file" @change="handleFileUpload" />

      <button type="submit">Update</button>
    </form>
  </div>
  <img
    v-if="user.image"
    :src="`/storage/${user.image}`"
    alt="Profile picture"
    class="h-16 w-16 rounded-full object-cover"
    />
</template>