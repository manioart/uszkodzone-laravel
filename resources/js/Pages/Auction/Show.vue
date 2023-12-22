<template>
  <div>
    <AuctionData :auction="auction" />
    <div v-html="auction.content" />
  </div>
</template>

<script setup>
import AuctionData from '@/Components/AuctionData.vue'

defineProps({
  auction: Object,
})
</script>