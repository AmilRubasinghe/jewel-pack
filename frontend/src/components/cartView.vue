<template>
    <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="">
            Cart ({{ $store.state.cartCount }})
        </a>

        <div v-if="$store.state.cart.length > 0" class="navbar-dropdown is-boxed is-right">
            <a v-for="item in $store.state.cart"
                :key="item.PID"
                class="navbar-item"
                href=""
            >
                {{ item.Image }} x{{ item.Quantity }} - ${{ item.Price }}
            </a>

            <a class="navbar-item" href="">
                Total: ${{ totalPrice }}
            </a>

            <hr class="navbar-divider">

            <button @click="Checkout()"> Checkout </button>
        </div>

        <div v-else class="navbar-dropdown is-boxed is-right">
            <a class="navbar-item" href="">
                Cart is empty
            </a>
        </div>
    </div>
</template>

<script>
export default {
    methods:{
        Checkout(){
            
        }
    }
}
</script>
