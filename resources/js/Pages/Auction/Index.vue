<template>
  <div v-for="auction in auctions" :key="auction.id">
    <Link :href="`/auction/${auction.id}`">
      <AuctionData :auction="auction" />
    </Link>
  </div>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
import AuctionData from '@/Components/AuctionData.vue'

defineProps({
  auctions: Array,
})
</script>