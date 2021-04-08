<template>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="row">
                <div class="col-4 col-md-12" v-if="tables.length === 0">
                    Tutti gli ordini sono stati pagati
                </div>
                <div class="col-4 col-md-12" v-for="table in tables">
                    <div class="btn btn-sm btn-block btn-outline-elegant mt-1 " v-on:click="showOrder(table)">
                        Tavolo {{ table.number }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-8" v-if="current_table && current_table.order.allproducts.length > 0">
            <ul class="list-group">
                {{current_table.order.allproducts}}
                <li class="list-group-item" v-for="product in current_table.order.allproducts">
                    {{ product.name }}
                    {{ product.price }}
                    {{ product.pivot.quantity }}
                    <button class="btn btn-sm btn-success" v-on:click="showPayment([product])">Pagamento</button>

                </li>
            </ul>
            <button class="btn btn-sm btn-success" v-on:click="showPayment(current_table.order.allproducts)">Pagamento
            </button>

        </div>

        <!-- Create Product Modal -->
        <div class="modal fade right" id="modal-pay-product" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-full-height modal-right" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Pagamento
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <tr>
                                <td>
                                    Prodotto
                                </td>
                                <td>
                                    Quantità
                                </td>
                            </tr>
                            <tr v-for="product in current_products_to_pay">
                                <td>{{ product.name }}</td>
                                <td>
                                    <input type="number" min="0" v-model="product.pivot.quantity">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button class="btn btn-primary" v-on:click="store()">
                            Conferma Pagamento
                        </button>
                    </div>
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
            tables: [],
            current_table: null,
            current_products_to_pay: [],
        }
    },

    mounted() {
        this.loading = true;
        this.loadingTable();
    },
    methods: {

        loadingTable: function () {
            let uri = "/api/checkout/tables"
            axios.get(uri)
                .then(response => {
                    this.tables = response.data.data;
                })
                .catch(error => {
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        showOrder: function (table) {
            this.current_table = table;
            console.log(table);
        },
        showPayment: function (products) {
            this.current_products_to_pay = products;
            $('#modal-pay-product').modal('show');
        }
    },

}
</script>
