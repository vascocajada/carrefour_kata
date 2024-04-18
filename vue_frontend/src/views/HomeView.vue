<script setup>
import axios from 'axios'
import ProductList from '../components/ProductList.vue'
import { onMounted, ref } from 'vue'

const products = ref([])

onMounted(() => {
  // get products from API
  axios
    .get('/products')
    .then((response) => {
      products.value = response.data
    })
    .catch((error) => {
      // TODO show pretty error message
      console.log(error)
    })
})
</script>

<template>
  <main>
    <ProductList :products="products" />
  </main>
</template>
