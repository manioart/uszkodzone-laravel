<template>
  <form @submit.prevent="create">
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-5">
        <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Tytuł</label>
        <input v-model="form.title" type="text" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
        <div v-if="form.errors.title">
          {{ form.errors.title }}
        </div>
      </div>
      <div class="col-span-1">
        <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Rok pierwszej rejestracji</label>
        <input v-model.number="form.year_of_prod" type="number" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
        <div v-if="form.errors.year_of_prod">
          {{ form.errors.year_of_prod }}
        </div>
      </div>
      <div class="col-span-3">
        <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Ubezpieczalnia</label>
        <input v-model="form.insurance" type="text" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
        <div v-if="form.errors.insurance">
          {{ form.errors.insurance }}
        </div>
      </div>
      <div class="col-span-3">
        <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Koniec aukcji</label>
        <flat-pickr v-model="form.end_date" :config="config" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
        <div v-if="form.errors.end_date">
          {{ form.errors.end_date }}
        </div>
      </div>
      
      <div class="col-span-6">
        <label class="block mb-1 text-gray-500 dark:text-gray-300 font-medium">Szczegóły aukcji</label>
        <div id="app">
          <ckeditor v-model="form.content" :editor="ClassicEditor" class="block w-full p-2 rounded-md shadow-sm border border-gray-300 dark:border-gray-600 text-gray-500" />
        </div>
        <div v-if="form.errors.content">
          {{ form.errors.content }}
        </div>
      </div>
      <div>
        <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white font-medium p-2 rounded-md">Utwórz</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import {useForm} from '@inertiajs/vue3' 
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import {ref} from 'vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

const form = useForm({
  title: '',
  insurance: '',
  end_date: null,
  year_of_prod: null,
  content: '',
})

const create = () => form.post(route('auction.store'))

const config = ref({
  enableTime: true,
  dateFormat: 'Y-m-d H:i',          
})
</script>

<style scoped>
  label {
    margin-right: 2px;
  }

  div {
    padding: 2px;
  }
</style>