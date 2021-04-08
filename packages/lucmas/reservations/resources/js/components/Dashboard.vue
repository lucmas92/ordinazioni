<template>
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card my-2 rounded-0">
                <div class="card-header">
                    Ordini in corso:
                    <i class="fas fa-2x position-absolute fa-sync"
                       v-on:click="getTotalOrder()"
                       style="right: 1rem"></i>
                </div>
                <a class="card-body" href="admin/orders">
                    <div v-if="totalOrder === null" class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <span class="h3 font-weight-bold" v-if="totalOrder !== null">{{totalOrder}}</span>
                </a>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card my-2 rounded-0">
                <div class="card-header">
                    Carrelli in corso:
                    <i class="fas fa-2x position-absolute fa-sync" v-on:click="getTotalCart()" style="right: 1rem"></i>
                </div>
                <div class="card-body">
                    <div v-if="totalCart === null" class="spinner-border spinner-border-sm" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <span class="h3 font-weight-bold" v-if="totalCart !== null">{{totalCart}}</span>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data: function () {
            return {
                totalOrder: null,
                totalCart: null,
            }
        },

        mounted() {
            this.getTotalCart();
            this.getTotalOrder();
        },

        methods: {
            getTotalOrder: function () {
                this.showOrders = false;
                this.totalOrder = null;
                axios.get('/api/order/count')
                    .then((response) => {
                        this.totalOrder = response.data;
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            },
            getTotalCart: function () {
                this.totalCart = null;
                axios.get('/api/cart/count')
                    .then((response) => {
                        this.totalCart = response.data;
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            }
        }

    }
</script>
