<template>
  <form @submit.prevent="login">
    <div class="w-1/2 mx-auto">
      <div>
        <label for="email" class="label">E-mail (Użytkownik)</label>
        <input id="email" v-model="form.email" type="text" class="input" />
        <div v-if="form.errors.email" class="input-error">{{ form.errors.email }}</div>
      </div>
      <div class="mt-4">
        <label for="password" class="label">Hasło</label>
        <input id="password" v-model="form.password" type="password" class="input" />
        <div v-if="form.errors.password" class="input-error">{{ form.errors.password }}</div>
      </div>
      <div class="mt-4">
        <button class="btn-primary w-full" type="submit">Zaloguj</button>
        <div class="mt-2 text-center">
          <Link :href="route('user-account.create')" class="text-sm text-gray-500">
            Nie masz jeszcze konta? Kliknij tutaj
          </Link>
        </div>
      </div>
    </div>
  </form>
</template>
  
<script setup>
import {useForm, Link} from '@inertiajs/vue3'
import { useTheme } from 'vuetify'

const form = useForm({
  email: null,
  password: null,
})

const login = () => form.post(route('login.store'))
</script>

<style lang="scss">
@use "@core-scss/pages/page-auth.scss";
</style>