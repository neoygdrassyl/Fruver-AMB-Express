<template>
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
    <a
      class="dropdown-item"
      href=""
      onclick="event.preventDefault();"
      v-if="cart.quantity == 0"
    >
      El Carrito esta vacio</a
    >
    <p class="dropdown-item" v-if="cart.quantity > 0">
      Productos totales: {{ cart.quantity }}
    </p>
    <p class="dropdown-item" v-if="cart.quantity > 0">Sutotal: {{ cart.subtotal }}</p>
    <div class="dropdown-divider" v-if="cart.quantity >0 "></div>
    <a class="dropdown-item" href="/cart" v-if="cart.quantity > 0">
      Seguir al Carrito<i class="fas fa-cart-arrow-down"></i>
    </a>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cart: {content:{},
        quantity: 0 ,
        subtotal: 0,
        },
    };
  },
  methods: {
    async checkCart() {
      const res = await axios.get("/cart/info");
      this.cart = res.data;
    },
  },
  created() {
    this.checkCart();
    this.$root.$on('checkCart', this.checkCart);
  },
};
</script>