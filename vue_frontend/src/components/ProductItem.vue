<script setup>
import axios from 'axios'
import ProductDetail from './ProductDetail.vue'

defineProps({
  product: {
    type: Object,
    required: true
  }
})

const addToCart = (product) => {
  axios
    .post(`/cart-item/${product.id}`)
    .then((response) => {
      // TODO display feedback to user
      // we could use axios interceptors to display toast messages for example
      console.log(response)
    })
    .catch((error) => {
      console.error(error)
    })
}
</script>

<template>
  <VCard>
    <VCardTitle>{{ product.name }}</VCardTitle>
    <VCardText>
      <VImg aspect-ratio="1" :max-height="500" cover :src="product.image" />
      Price: {{ product.price }}</VCardText
    >
    <VBtn color="primary" variant="flat" block @click="addToCart(product)">Add to cart</VBtn>

    <VDialog max-width="500">
      <template v-slot:activator="{ props: activatorProps }">
        <VBtn
          v-bind="activatorProps"
          color="surface-variant"
          text="View"
          variant="flat"
          block
        ></VBtn>
      </template>

      <template v-slot:default="{ isActive }">
        <ProductDetail :product="product" @add-to-cart="addToCart" />
      </template>
    </VDialog>
  </VCard>
</template>
