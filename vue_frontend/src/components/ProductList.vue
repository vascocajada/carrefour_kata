<script setup>
import ProductItem from './ProductItem.vue'

defineProps({
  products: {
    type: Array,
    required: true
  }
})
</script>

<template>
  <VContainer>
    <h1>Product List Page</h1>
    <VRow>
      <VCol v-for="product in products" :key="product.id" class="product">
        <ProductItem :product="product" />
      </VCol>
    </VRow>
  </VContainer>
</template>
