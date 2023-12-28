<template>
  <div v-for="auction in auctions" :key="auction.id">
    <div>
      <Link :href="route('auction.show', {auction: auction.id})">
        <AuctionData :auction="auction" />
      </Link>
    </div>
    <div>
      <Link :href="route('auction.edit', {auction: auction.id})">Edytuj</Link>
    </div>
    <div>
      <Link :href="route('auction.destroy', {auction: auction.id})" method="DELETE" as="button">Usuń</Link>
    </div>
  </div>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
import AuctionData from '@/Components/AuctionData.vue'

defineProps({
  auctions: Array,
})
</script>