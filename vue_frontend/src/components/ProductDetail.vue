<script setup>
// TODO use store to show product details
// avoid rendering one component for each product
defineProps({
  product: {
    type: Object,
    required: true
  }
})
</script>

<template>
  <VCard>
    <VCardTitle>{{ product.name }}</VCardTitle>
    <VCardText>
      <VImg aspect-ratio="1" :max-height="500" cover :src="product.image" />
      Price: {{ product.price }}</VCardText
    >
    <VCardActions>
      <VBtn color="primary" variant="flat" block @click="$emit('add-to-cart', product)"
        >Add to cart</VBtn
      >
    </VCardActions>
  </VCard>
</template>
