import { mount } from '@vue/test-utils'
import { expect, test } from 'vitest'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import ProductItem from '../../src/components/ProductItem.vue'

const vuetify = createVuetify({
  components,
  directives,
})

global.ResizeObserver = require('resize-observer-polyfill')

test('renders product with button', () => {
  // Spy on the addToCart function
  // TODO get jest working to spy on the function
  // and mock axios for more thorough testing
  //const addToCartSpy = jest.fn()

  const wrapper = mount(ProductItem, {
    propsData: {
      product: {id: 1, name: 'Product Test 1', price: 100}
    },
    global: {
      plugins: [vuetify],
      mocks: {
        addToCart: () => {} // Provide the spy as a mock for addToCart
      }
    }
  })

  // Assert the rendered text of the component
  expect(wrapper.text()).toContain('Product Test 1')

  // Assert it calls the add to cart function when the button is clicked
  const button = wrapper.find('button')
  button.trigger('click')

  // Check if addToCart has been called
  //expect(addToCartSpy).toHaveBeenCalled()
})
