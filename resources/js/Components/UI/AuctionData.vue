<template>
  <div>
    <div class="font-bold"><span class="text-gray-600 text-2xl">{{ auction.title }}</span></div>
    <div class="font-bold">Ubezpieczalnia: <span class="text-gray-600">{{ auction.insurance }}</span></div>
    <div class="font-bold">Rok pierwszej rejestracji: <span class="text-gray-600">{{ auction.year_of_prod }}</span></div>
    <div class="font-bold">Koniec: <span class="text-gray-600">{{ auction.end_date }}</span></div>
  </div>
</template>

<script setup>
defineProps({
  auction: Object,
})
</script>