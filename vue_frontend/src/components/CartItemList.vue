<script setup>
defineProps({
  cartItems: {
    type: Array,
    required: true
  }
})
const removeFromCart = (item) => {
  // TODO
  // axios.delete(`/cart-item/${item.id}`)
  //     .then(response => {
  //         // TODO display feedback to user
  //         // we could use axios interceptors to display toast messages for example
  //         console.log(response)
  //     })
  //     .catch(error => {
  //         console.error(error)
  //     })
}
const headers = [
  { title: 'ID', align: 'start', key: 'id' },
  { title: 'Name', align: 'start', key: 'name' },
  { title: 'Quantity', align: 'start', key: 'quantity' },
  { title: 'Actions', align: 'start', key: 'actions' }
]
</script>

<template>
  <VContainer>
    <VRow>
      <VCol>
        <VCard>
          <VCardTitle>Cart</VCardTitle>
          <VDataTable
            :headers="headers"
            :items="cartItems"
            :items-per-page="5"
            :hide-default-footer="true"
          >
            <template #item.actions="{ item }">
              <VBtn color="error" @click="removeFromCart(item)">Remove</VBtn>
            </template>
          </VDataTable>
        </VCard>
      </VCol>
    </VRow>
  </VContainer>
</template>
