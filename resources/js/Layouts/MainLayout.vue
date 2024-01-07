<template>
  <div class="flex">
    <div v-if="user.is_admin">
      <SidebarAdmin />
    </div>
    <div class="container mx-auto mt-12">
      <div class="w-full px-4 py-5 bg-white rounded-lg shadow">
        <div v-if="flashSuccess" class="mb-4 border rounded-md shadow-sm border-green-200 dark:border-green-800 bg-green-50 dark:bg-green-900 p-2">
          {{ flashSuccess }}
        </div>
        <slot>Brak treści</slot>
      </div>
    </div>
  </div>
</template>

<script setup>
import SidebarAdmin from '@/Components/UI/SidebarAdmin.vue'
import {usePage} from '@inertiajs/vue3'
import {computed} from 'vue'

const page = usePage()
const flashSuccess = computed(
  () => page.props.flash.success,
)
const user = computed(
  () => page.props.user,
)
</script>