import { mount } from '@vue/test-utils'
import { expect, test } from 'vitest'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import ProductList from '../../src/components/ProductList.vue'

const vuetify = createVuetify({
  components,
  directives,
})

global.ResizeObserver = require('resize-observer-polyfill')

test('renders product list', () => {
  const wrapper = mount(ProductList, {
    propsData: {
      products: [
        {id: 1, name: 'Product 1', price: 100},
        {id: 2, name: 'Product 2', price: 200},
        {id: 3, name: 'Product 3', price: 300},
        {id: 4, name: 'Product 4', price: 400},
        {id: 5, name: 'Product 5', price: 500},
      ]
    },
    global: {
      plugins: [vuetify],
    }
  })

  // Assert the rendered text of the component
  expect(wrapper.text()).toContain('Product List Page')

  // Assert it renders a grid of products
  const products = wrapper.findAll('.product')
  expect(products.length).toBe(5)
})

