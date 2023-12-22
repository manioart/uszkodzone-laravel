<template>
  <span>
    {{ auction.title }}
    {{ auction.insurance }}
    {{ auction.year_of_prod }}
    {{ auction.end_date }}
  </span>
</template>

<script setup>
defineProps({
  auction: Object,
})
</script>