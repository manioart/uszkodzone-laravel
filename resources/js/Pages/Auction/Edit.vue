<template>
  <form @submit.prevent="update">
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
        <button type="submit" class="btn-primary">Zapisz</button>
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

const props = defineProps({
  auction: Object,
})

const form = useForm({
  title: props.auction.title,
  insurance: props.auction.insurance,
  end_date: props.auction.end_date.slice(0, -3),
  year_of_prod: props.auction.year_of_prod,
  content: props.auction.content,
})

const update = () => form.put(route('auction.update', {auction: props.auction.id}))

const config = ref({
  enableTime: true,
  dateFormat: 'Y-m-d H:i',
  defaultDate: props.auction.end_date.slice(0, -3),        
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