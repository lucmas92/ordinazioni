<style>
    .fa-cart-plus:active {
        color: lime;
    }

    .fa-trash-alt:active {
        color: red;
    }

    .cart-qta-badge {
        position: absolute;
        right: 0px;
        top: -8px;
        background: red;
        text-align: center;
        color: white;
        padding: 2px 10px;
        font-size: 10px;
    }
</style>
<template>
    <div class="row mb-5 pb-3">
        <div class="col-12 w-50 alert alert-success border position-absolute text-center rounded-0"
             style="z-index:9999; bottom: 2.5rem" v-if="message">
            {{message}}
        </div>

        <div class="spinner-grow position-absolute"
             style="top: 8rem; width: 3rem; height: 3rem; z-index:9999; left:50%; margin-left:-1.5rem"
             role="status" v-if="loading">
            <span class="sr-only">Loading...</span>
        </div>

        <div class="btn-group btn-group-toggle col-12 px-0 mb-3" data-toggle="buttons">
            <label class="btn btn-elegant rounded-0 form-check-label active m-0">
                <input class="form-check-input" type="radio" name="options" id="option1" autocomplete="off"
                       v-on:click="loadCategories(1)">
                Cibo
            </label>
            <label class="btn btn-elegant rounded-0 form-check-label m-0">
                <input class="form-check-input" type="radio" name="options" id="option2" autocomplete="off"
                       v-on:click="loadCategories(2)">
                Bevande
            </label>
            <hr>
        </div>

        <div class="col-12 position-fixed py-3 bg-success text-center text-white font-weight-bold"
             v-on:click="showCart"
             style="bottom: 0; background-color: red; z-index:999; letter-spacing: 1px">
            Carrello
        </div>

        <!--        CATEGORIE      -->
        <div class="col-12 mt-2" v-if="categories.length > 1">
            <div class="row">
                <div class="col-12 h4-responsive text-center">
                    <p>
                        Categorie
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-4 my-1 px-0 animated fadeIn wow" v-for="category in categories">
                    <div class="card card-body rounded-0 d-flex flex-row px-2 pt-3 mx-0 mx-lg-2 mb-lg-2 rounded-0"
                         style="cursor:pointer"
                         v-on:click="loadProducts(category)">
                        {{category.name}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 h4-responsive d-flex flex-row" v-if="current_category">
            <i class="fa fa-2x fa-arrow-circle-left" v-on:click="goBack()"></i>
            <p class="ml-4 pt-1">
                {{current_category.name}}
            </p>
        </div>

        <!--        PRODOTTI      -->
        <div class="p-2" v-if="products.length === 0 && current_category">
            Nessun prodotto presente!
        </div>
        <div class="col-12 col-lg-6 col-xl-4 mt-3 px-0" v-for="product in products">
            <div class="card card-body rounded-0 d-flex flex-row py-0 px-2 mx-0 mx-lg-2 mb-lg-2 justify-content-between"
                 style="cursor:pointer">
                <div v-if="qtaInCart(product) > 0" class="badge badge-info cart-qta-badge">{{qtaInCart(product)}}</div>
                <div class="py-3 flex-grow-1" v-on:click="productDetail(product)">
                    <span class="h4-responsive d-block text-uppercase">{{product.name}}</span>
                    <span class="d-block small text-muted">{{product.description_short}}</span>
                </div>
                <div class="pt-2 text-right">
                    <span>&euro; {{product.price}}</span>
                    <i class="mt-2 align-middle fa fa-3x fa-cart-plus animated bounceIn wow" data-wow-delay="1.6s"
                       v-on:click="addToCart(product, true)"></i>
                </div>
            </div>
        </div>


        <!-- Add Cart Product Modal -->
        <div class="modal fade right" id="modal-addcart-product" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-full-height modal-right" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{modaldata.product.name}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                {{modaldata.product.description}}
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-6">
                                <img
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/300px-No_image_available.svg.png"
                                    class="img-fluid" style="max-width: 100px">
                            </div>
                            <div class="col-6">
                                <input class="form-control disabled rounded-0" type="number" min="1" v-model="qta"
                                       disabled>
                                <button class="btn btn-sm float-left" v-on:click="increment()">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <button class="btn btn-sm float-left" v-on:click="decrement()">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row justify-content-center h6">
                            <div class="col-10 pb-2 col-md-8 border-bottom">
                                Prezzo unitario
                                <span class="float-right">
                                    {{modaldata.product.price}}
                                </span>
                            </div>
                            <div class="col-10 pt-2 col-md-8">
                                Subtotale:
                                <span class="float-right">
                                    {{((modaldata.product.price * qta)).toFixed(2)}}
                                </span>
                            </div>
                        </div>


                    </div>
                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button class="btn btn-sm" v-on:click="addToCart(modaldata.product, false)">Ok</button>
                        <button class="btn btn-sm" data-dismiss="modal">Annulla</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cart Modal -->
        <div class="modal fade right" id="modal-cart" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-full-height modal-right" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Carrello
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div v-if="order">
                                    Ordine inviato!
                                    Il tuo numero ordine è: {{order.number}}
                                </div>
                                <div v-if="!order && cartProducts.length === 0">
                                    Nessun prodotto presente!
                                </div>
                            </div>


                            <div class="col-12 mb-3" v-if="!order" v-for="cartProduct in cartProducts">
                                <div class="row">
                                    <div class="col-10">
                                        <div class="row">
                                            <div class="col-2">
                                                {{cartProduct.quantity}}
                                            </div>
                                            <div class="col-10">
                                                <strong>{{cartProduct.name}}</strong>
                                            </div>
                                        </div>
                                        <div class="row border-top">
                                            <div class="col-6 text-left">
                                                Prezzo: {{cartProduct.price}}
                                            </div>
                                            <div class="col-6 text-left">
                                                Subtotale: {{cartProduct.subtot.toFixed(2)}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-2 text-center">
                                        <i class="fa fa-trash-alt" v-on:click="del(cartProduct)"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right w-100 px-2" v-if="this.cartProducts.length > 0">
                                <hr>
                                <strong>Totale:</strong> &euro; {{getCartTotal()}}
                            </div>


                            <!--                            <table cellpadding="2" class="table w-100 table-borderless" v-if="!order">-->
                            <!--                                <tr class="border-bottom pt-3" v-for="cartProduct in cartProducts">-->
                            <!--                                    <td class="p-0">-->
                            <!--                                        {{cartProduct.quantity}}-->
                            <!--                                        <hr class="m-0">-->
                            <!--                                    </td>-->
                            <!--                                    <td class="p-0">-->
                            <!--                                        {{cartProduct.name}}-->
                            <!--                                        {{cartProduct.price}}-->
                            <!--                                        <hr class="m-0">-->
                            <!--                                        Subtotale: {{cartProduct.subtot}}-->
                            <!--                                    </td>-->
                            <!--                                    <td class="text-right">-->
                            <!--                                        <button class="btn btn-sm" v-on:click="del(cartProduct)">-->
                            <!--                                            <i class="fa fa-trash-alt"></i>-->
                            <!--                                        </button>-->
                            <!--                                    </td>-->
                            <!--                                </tr>-->
                            <!--                            </table>-->
                        </div>
                    </div>
                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button class="btn btn-block"
                                v-if="!order"
                                v-on:click="confirmCart()">
                            Conferma
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['table', 'current_cart'],
        data: function () {
            return {
                loading: false,
                categories: [],
                current_category: null,
                products: [],
                cartProducts: [],
                product: null,
                cart: this.current_cart,
                message: null,
                order: null,
                modaldata: {
                    product: ''
                },
                qta: 1,
            }
        },

        mounted() {
            this.loadCartProducts()
        },

        methods: {
            qtaInCart: function (needle) {
                let haystack = this.cartProducts;
                let length = haystack.length;
                for (var i = 0; i < length; i++) {
                    if (haystack[i].product_id === needle.id) return haystack[i].quantity;
                }
                return 0;
            },
            addToCart: function (product, increment) {
                let data = {
                    product_id: product.id,
                    table_id: this.table.id,
                    quantity: (this.qtaInCart(product) !== 0 && increment) ? this.qtaInCart(product) + 1 : this.qta,
                }
                let url = '/api/cart/' + this.cart.id + '/add/';
                axios.post(url, data)
                    .then((response) => {
                        this.order = null;
                        this.cart = response.data;
                        $('#modal-addcart-product').modal('hide');
                        let mess = "Prodotto aggiunto al carrello!";
                        this.flash(mess);
                        this.loadCartProducts();
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            },
            flash: function (message) {
                this.message = message;
                setTimeout(() => {
                    this.message = null;
                }, 1000);
            },
            loadCategories: function (parent_id) {
                this.loading = true;
                this.categories = [];
                axios.get('/api/categories/withparent/' + parent_id)
                    .then((response) => {
                        this.loading = false;
                        this.products = [];
                        this.current_category = null;
                        this.categories = response.data.data;
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            },
            loadProducts: function (category) {
                this.loading = true;
                this.products = [];
                if (!category)
                    category = this.current_category;
                axios.get('/api/products/category/' + category.id)
                    .then((response) => {
                        this.loading = false;
                        this.products = response.data.data;
                        this.current_category = category;
                        this.categories = [];
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            },

            del: function (product) {
                axios.delete('/api/cart/' + this.cart.id + '/delete/' + product.product_id)
                    .then((response) => {
                        this.cart = response.data;
                    });
                this.loadCartProducts();
            },

            goBack: function () {
                this.loadCategories(this.current_category.parent_id);
            },

            increment: function () {
                this.qta += 1;
            },

            decrement: function () {
                if (this.qta > 1)
                    this.qta -= 1;
            },
            productDetail: function (product) {
                this.qta = 1;
                this.modaldata = {'product': product};
                $('#modal-addcart-product').modal('show');
            },

            showCart: function () {
                this.loadCartProducts();
                $('#modal-cart').modal('show');
            },
            loadCartProducts: function () {
                this.order = null;
                axios.get('/api/cart/' + this.cart.id + '/products')
                    .then((response) => {
                        this.cartProducts = response.data.data;
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            },
            confirmCart: function () {
                console.log('confirming...');
                axios.get('/api/order/create/' + this.cart.id)
                    .then((response) => {
                        this.order = response.data;
                        this.cartProducts = [];
                        this.cart = null
                        this.getNewCart();
                        $('#modal-cart').modal('hide');
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            },
            getNewCart: function () {
                axios.get('/api/cart/' + this.table.id + '/create/')
                    .then((response) => {
                        this.cart = response.data;
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            },
            getCartTotal: function () {
                let total = 0
                this.cartProducts.forEach((item) => {
                    total += item.price * item.quantity;
                });
                return total.toFixed(2);
            }
        }

    }
</script>
