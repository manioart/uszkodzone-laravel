<template>
  <form @submit.prevent="create">
    <div class="grid grid-cols-6 gap-4">
      <div class="col-span-5">
        <label class="label">Tytuł</label>
        <input v-model="form.title" type="text" class="input" />
        <div v-if="form.errors.title" class="input-error">
          {{ form.errors.title }}
        </div>
      </div>
      <div class="col-span-1">
        <label class="label">Rok pierwszej rejestracji</label>
        <input v-model.number="form.year_of_prod" type="number" class="input" />
        <div v-if="form.errors.year_of_prod" class="input-error">
          {{ form.errors.year_of_prod }}
        </div>
      </div>
      <div class="col-span-3">
        <label class="label">Ubezpieczalnia</label>
        <input v-model="form.insurance" type="text" class="input" />
        <div v-if="form.errors.insurance" class="input-error">
          {{ form.errors.insurance }}
        </div>
      </div>
      <div class="col-span-3">
        <label class="label">Koniec aukcji</label>
        <flat-pickr v-model="form.end_date" :config="config" class="input" />
        <div v-if="form.errors.end_date" class="input-error">
          {{ form.errors.end_date }}
        </div>
      </div>
      
      <div class="col-span-6">
        <label class="label">Szczegóły aukcji</label>
        <ckeditor v-model="form.content" :editor="ClassicEditor" class="input" />
        <div v-if="form.errors.content" class="input-error">
          {{ form.errors.content }}
        </div>
      </div>
      <div>
        <button type="submit" class="btn-primary">Utwórz</button>
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