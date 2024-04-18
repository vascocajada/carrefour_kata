<script setup>
import axios from 'axios'
import CartItemList from '../components/CartItemList.vue'
import { onMounted, ref } from 'vue'

const cartItems = ref([])

onMounted(() => {
  // get products from API
  axios
    .get('/cart')
    .then((response) => {
      console.log(response.data)
      cartItems.value = response.data.cart_items.map((item) => {
        return {
          id: item.id,
          name: item.product.name,
          quantity: 'TODO'
        }
      })
    })
    .catch((error) => {
      // TODO show pretty error message
      console.log(error)
    })
})
</script>

<template>
  <main>
    <CartItemList :cartItems="cartItems" />
  </main>
</template>
