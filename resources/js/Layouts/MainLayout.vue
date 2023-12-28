<template>
  <div>MAIN LAYOUT</div>
  <div v-if="flashSuccess" class="success">
    {{ flashSuccess }}
  </div>
  <slot>Brak treści</slot>
</template>

<script setup>
import {usePage} from '@inertiajs/vue3'
import {computed} from 'vue' 

const page = usePage()
const flashSuccess = computed(
  () => page.props.flash.success,
)
</script>

<style scoped>
  .success {
    background-color: green;
    color: white;
  }
</style>