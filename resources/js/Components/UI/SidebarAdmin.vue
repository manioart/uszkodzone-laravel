<template>
  <div
    :class="isOpen ? 'w-30' : 'w-60'"
    class="flex flex-col h-screen p-3 duration-300 bg-gray-800 shadow"
  >
    <div class="space-y-3">
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-bold text-white">Panel</h2>
        <button @click="isOpen = !isOpen">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-6 h-6 text-white"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
            />
          </svg>
        </button>
      </div>
      <div class="flex-1">
        <ul class="pt-2 pb-4 space-y-1 text-sm">
          <li class="rounded-sm">
            <Link
              :href="route('auction.index')"
              class="flex items-center p-2 space-x-3 rounded-md"
            >
              <span class="text-gray-100">Aukcje</span>
            </link>
          </li>
          <li class="rounded-sm">
            <Link
              :href="route('auction.create')"
              class="flex items-center p-2 space-x-3 rounded-md"
            >
              <span class="text-gray-100">Dodaj Aukcję</span>
            </link>
          </li>
          <li class="rounded-sm">
            <Link
              :href="route('logout')" method="delete" as="button"
              class="flex items-center p-2 space-x-3 rounded-md"
            >
              <span class="text-gray-100"> Wyloguj </span>
            </Link>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
import { ref } from 'vue'

const isOpen = ref(false) 
</script>