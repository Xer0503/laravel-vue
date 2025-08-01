<script setup>
import Signup from '../Auth/Signup.vue'
import Home from './Home.vue'
import { ref } from 'vue'

const selected = ref(0)

</script>

<template>
  <div>
    <Signup />
    <div class="mt-2 mb-2">
      <button @click="selected = 1" class="px-3 bg-blue-400">1</button>
      <button @click="selected = 0" class="px-3 bg-green-600">0</button>
    </div>

    <div v-if="selected == 1">
      <Home />
    </div>
  </div>
</template>
