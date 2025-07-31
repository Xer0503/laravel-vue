<script setup>
import Signup from '../Auth/Signup.vue'
import Home from './Home.vue'
import { ref } from 'vue'
import { usePage } from '@inertiajs/vue3'

const selected = ref(0)

// usePage() is a ref, so we access .value first
const page = usePage()

const success = page.props.success
const data = page.props.data
</script>

<template>
  <div>
    <Signup />

    <div class="mt-2 mb-2">
      <button @click="selected = 1" class="px-3 bg-blue-400">1</button>
      <button @click="selected = 0" class="px-3 bg-green-600">0</button>

      <p v-if="success">{{ success }}</p>
      <h1 v-if="data">Name: {{ data.name }}</h1>
    </div>

    <div v-if="selected == 1">
      <Home />
    </div>
  </div>
</template>
