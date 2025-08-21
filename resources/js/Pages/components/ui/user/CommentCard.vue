<script setup>
const props = defineProps({
  comment: {
    type: Object,
    required: true
  }
})
</script>

<template>
  <div class="border-t pt-2 mt-2">
    <span class="font-semibold">{{ comment.user.name }}</span>
    <span class="ml-2">{{ comment.body }}</span>
  </div>
</template>
