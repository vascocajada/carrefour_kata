<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <VLayout>
    <VAppBar app>
      <VAppBarTitle>
        <RouterLink to="/">Product List</RouterLink>
      </VAppBarTitle>
      <VAppBarTitle>
        <RouterLink to="/cart">Cart</RouterLink>
      </VAppBarTitle>
    </VAppBar>

    <VMain>
      <RouterView />
    </VMain>
  </VLayout>
</template>
