<script setup>

defineProps({
      data : {
        type : Object,
        success : String
      }
    })

</script>
<template>
    <h3 v-if="success">{{ success }}</h3>
    <h2 v-if="data">{{ data.name }}</h2>
    <h2 v-if="data">{{ data.email }}</h2>
    <h2 v-if="data">{{ data.password }}</h2>
</template>