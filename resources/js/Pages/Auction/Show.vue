<template>
  <div class="flex flex-col-reverse lg:grid lg:grid-cols-12 gap-4">
    <Box class="lg:col-span-7">
      <div v-for="image in auction.files" :key="auction.files.id">
        <img :src="image.path" />
      </div>
    </Box>
    <div class="lg:col-span-5 flex flex-col gap-4">
      <Box>
        <div>
          <AuctionData :auction="auction" />
          <div v-html="auction.content" />
        </div>
      </Box>
      <Box>
        Miejsce na formularz licytacji
      </Box>
    </div>
  </div>
</template>

<script setup>
import AuctionData from '@/Components/UI/AuctionData.vue'
import Box from '@/Components/UI/Box.vue'

defineProps({
  auction: Object,
})
</script>