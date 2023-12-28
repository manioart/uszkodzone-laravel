<template>
  <form @submit.prevent="update">
    <div>
      <div>
        <label>Tytuł</label>
        <input v-model="form.title" type="text" />
        <div v-if="form.errors.title">
          {{ form.errors.title }}
        </div>
      </div>
      <div>
        <label>Ubezpieczalnia</label>
        <input v-model="form.insurance" type="text" />
        <div v-if="form.errors.insurance">
          {{ form.errors.insurance }}
        </div>
      </div>
      <div>
        <label>Koniec aukcji</label>
        <flat-pickr v-model="form.end_date" :config="config" />
        <div v-if="form.errors.end_date">
          {{ form.errors.end_date }}
        </div>
      </div>
      <div>
        <label>Data pierwszej rejestracji</label>
        <input v-model.number="form.year_of_prod" type="number" />
        <div v-if="form.errors.year_of_prod">
          {{ form.errors.year_of_prod }}
        </div>
      </div>
      <div>
        <label>Szczegóły aukcji</label>
        <textarea v-model="form.content" />
        <div v-if="form.errors.content">
          {{ form.errors.content }}
        </div>
      </div>
      <dv>
        <button type="submit">Edytuj</button>
      </dv>
    </div>
  </form>
</template>

<script setup>
import {useForm} from '@inertiajs/vue3' 
import flatPickr from 'vue-flatpickr-component'
import 'flatpickr/dist/flatpickr.css'
import {ref} from 'vue'

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