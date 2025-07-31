<script setup>
    import { useForm } from '@inertiajs/vue3'

    const form = useForm({
    name: '',
    email: '',
    password: ''
    })

    function submit() {
    form.post('/home')
    }

</script>

<template>

    <div>
        <form @submit.prevent="submit">
          <div>
            <label>Name:</label>
            <input v-model="form.name" type="text" />
            <div v-if="form.errors.name">{{ form.errors.name }}</div>
          </div>
      
          <div>
            <label>Email:</label>
            <input v-model="form.email" type="email" />
            <div v-if="form.errors.email">{{ form.errors.email }}</div>
          </div>
      
          <div>
            <label>Password:</label>
            <input v-model="form.password" type="text" />
            <div v-if="form.errors.password">{{ form.errors.password }}</div>
          </div>
      
          <button type="submit" :disabled="form.processing">Send</button>
      
          <div v-if="form.recentlySuccessful">
            <p style="color: green;">Form submitted successfully!</p>
          </div>
        </form>
    </div>

</template>