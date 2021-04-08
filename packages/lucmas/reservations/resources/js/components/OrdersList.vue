<template>
    <div class="col-12">

        <b-progress v-if="!loading" class="position-absolute w-100"
                    height="2px" style="left:0; top:-1rem;"
                    :value="timer"
                    :max="100">
        </b-progress>

        <div class="row mb-2 pb-2">
            <div class="col-12 mb-1" v-for="order in orders">

                <div v-if="loading" class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>

                <div class="card card-body">
                    <div class="row">
                        <div class="col-6 col-lg-4">
                            <strong>Numero Ordine {{order.number}}</strong>
                        </div>
                        <div class="col-6 col-lg-4">
                            Ora {{getTime(order.created_at)}}
                        </div>
                        <div class="col-12 col-lg-4">
                            Tavolo {{order.table.number}}
                        </div>
                    </div>
                    <table class="table w-100">
                        <tr>
                            <td colspan="3">Prodotti da consegnare
                                {{getProductToDeliver(order.products)}}/({{order.products.length}})
                            </td>
                        </tr>
                        <tr v-for="product in order.products">
                            <td>{{product.pivot.quantity}}</td>
                            <td>{{product.name}}</td>
                            <td>
                                {{product.pivot.status}}
                                <button class="btn btn-sm btn-success"
                                        v-on:click="setDelivered(product.pivot.id)"
                                        v-if="product.pivot.status === 'NEW'"
                                >
                                </button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</template>

<script>

    import moment from 'moment';

    export default {
        data: function () {
            return {
                errors: [],
                orders: [],
                orderDetail: [],
                loading: false,
                message: null,
                timer: 100,
            }
        },

        mounted() {
            this.loading = true;
            this.loadOrders2();
            this.setTimer();
        },
        methods: {
            setTimer: function () {
                if (this.timer > 0)
                    this.timer -= 1;
                setTimeout(this.setTimer, 100)
            },
            loadOrder: function (id) {
                let url = '/api/order/' + id;

                axios.get(url)
                    .then((response) => {
                        this.orderDetail[id] = response.data.data;
                        this.loading = false;
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            },
            loadOrders2: function () {
                this.loadOrders();
                this.timer = 100;
                setTimeout(this.loadOrders2, 10000);
            },
            loadOrders: function () {
                let url = '/api/orders';
                console.log('loading orders!');

                axios.get(url)
                    .then((response) => {
                        console.log(response.data);
                        this.orders = response.data.data;
                        this.loading = false;
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            },
            getTime: function (data) {
                let hour = moment(data).get('hours') <= 9 ? '0' + moment(data).get('hours') : moment(data).get('hours');
                let minutes = moment(data).get('minutes') <= 9 ? '0' + moment(data).get('minutes') : moment(data).get('minutes');
                return hour + ':' + minutes
            },
            setDelivered: function (product_id) {
                let url = "/api/order/setDelivered/" + product_id;
                axios.get(url)
                    .then((response) => {
                        this.loadOrders();
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            },
            getProductToDeliver: function (products) {
                let count = 0;
                if (products.length !== 0) {

                    products.forEach((product) => {
                        if (product.pivot.status === 'NEW')
                            count++;
                    });
                }
                return count;
            }
        },

    }
</script>
