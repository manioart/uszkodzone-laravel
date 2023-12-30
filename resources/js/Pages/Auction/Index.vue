<template>
  <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
    <Box v-for="auction in auctions" :key="auction.id">
      <img :src="auction.files[0].path" />
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
    </Box>
  </div>
</template>

<script setup>
import {Link} from '@inertiajs/vue3'
import Box from '@/Components/UI/Box.vue'
import AuctionData from '@/Components/UI/AuctionData.vue'

defineProps({
  auctions: Array,
})
</script>