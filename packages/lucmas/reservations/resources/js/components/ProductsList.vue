<template>
    <div class="row">

        <button type="button" class="btn btn-success position-fixed"
                v-on:click="showCreateProductModal"
                style="z-index:99;bottom:0.6rem;right:0.6rem" v-if="current_category">
            Nuovo prodotto
        </button>


        <!--        CATEGORIE      -->
        <div class="col-12 mt-2" v-if="categories.length > 1">
            <div class="row">
                <div class="col-12 h4-responsive">
                    <p>
                        Categorie
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-4 my-1 px-0" v-for="category in categories">
                    <div class="card card-body rounded-0 px-2 pt-3 mx-1" style="cursor:pointer"
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
        <div class="col-12 col-lg-6 col-xl-4 mt-1 px-0" v-for="product in products">
            <div class="card card-body rounded-0 d-flex flex-row px-2 pt-3 mx-0 mx-lg-2 mb-lg-2"
                 style="cursor:pointer" v-on:click="edit(product)">
                <div class="d-block text-center">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/300px-No_image_available.svg.png"
                        class="img-fluid"
                        style="max-width: 100px">
                </div>
                <div class="d-block ml-2">
                    <p><strong>Nome:</strong> {{product.name}}</p>
                    <p><strong>Descrizione corta:</strong> {{product.description_short}}</p>
                    <p><strong>Prezzo:</strong> {{product.price}}</p>
                </div>

            </div>
        </div>

        <!-- Create Product Modal -->
        <div class="modal fade right" id="modal-create-product" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-full-height modal-right" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Creazione Prodotto
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <tr>
                                <td>
                                    Codice
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="code"
                                           placeholder="Codice..." required v-model="createForm.code">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nome
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="name"
                                           placeholder="Nome..." required v-model="createForm.name">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Descrizione Breve
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="description_short"
                                           placeholder="Descrizione breve..."
                                           required v-model="createForm.description_short">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Descrizione
                                </td>
                                <td>

                                    <input class="form-control" type="text" name="description"
                                           placeholder="Decsrizione..." v-model="createForm.description">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Foto
                                </td>
                                <td>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="product_image"
                                                   id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Prezzo
                                </td>
                                <td>
                                    <input class="form-control" type="number" name="price" step="0.01" min="0"
                                           placeholder="Prezzo..." v-model="createForm.price">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Stato
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="category_status" class="custom-control-input"
                                               id="customSwitches" v-model="createForm.active">
                                        <label class="custom-control-label"
                                               for="customSwitches">Imposta lo stato del prodotto</label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button class="btn btn-primary" v-on:click="store()">
                            Salva modifiche
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Product Modal -->
        <div class="modal fade right" id="modal-edit-product" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-full-height modal-right" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Modifica Prodotto
                        </h4>

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <table class="table table-striped">
                            <tr>
                                <td>
                                    Codice
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="code"
                                           placeholder="Codice..." required v-model="editForm.code">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nome
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="name"
                                           placeholder="Nome..." required v-model="editForm.name">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Descrizione Breve
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="description_short"
                                           placeholder="Descrizione breve..."
                                           required v-model="editForm.description_short">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Descrizione
                                </td>
                                <td>
                                    <textarea class="form-control" type="text" name="description"
                                              placeholder="Decsrizione..." v-model="editForm.description">
                                    </textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Foto
                                </td>
                                <td>
                                    <div class="text-center w-100">
                                        <img align="center"
                                             src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/300px-No_image_available.svg.png"
                                             class="img-fluid" style="max-height: 100px" v-model="editForm.image">
                                    </div>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="product_image"
                                                   id="inputGroupFile02" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Prezzo
                                </td>
                                <td>

                                    <input class="form-control" type="number" name="price" step="0.01" min="0"
                                           placeholder="Prezzo..." v-model="editForm.price">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Stato
                                </td>
                                <td>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="category_status" class="custom-control-input"
                                               id="editStatus" v-model="editForm.active">
                                        <label class="custom-control-label"
                                               for="editStatus">Imposta lo stato del prodotto</label>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button class="btn btn-primary" v-on:click="update">
                            Salva modifiche
                        </button>
                        <button class="btn btn-danger" v-on:click="del(editForm.id)">
                            <i class="fa fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data: function () {
            return {
                categories: [],
                current_category: null,
                products: [],
                product: null,
                message: null,
                editForm: {
                    name: '',
                },
                createForm: {
                    name: '',
                },
            }
        },

        mounted() {
            this.loadCategories();
        },

        methods: {
            loadCategories: function (parent_id) {
                axios.get('/api/categories/withparent')
                    .then((response) => {
                        this.products = [];
                        this.current_category = null;
                        this.categories = response.data.data;
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            },
            loadProducts: function (category) {
                if (!category)
                    category = this.current_category;
                axios.get('/api/products/category/' + category.id)
                    .then((response) => {
                        this.products = response.data.data;
                        this.current_category = category;
                        this.categories = [];
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            },
            /**
             * Update the client being edited.
             */
            update() {
                this.persistClient(
                    'put', '/api/products/edit/' + this.editForm.id,
                    this.editForm, '#modal-edit-product'
                );
            },
            edit(product) {
                this.editForm = {};
                this.editForm.id = product.id;
                this.editForm.code = product.code;
                this.editForm.name = product.name;
                this.editForm.description = product.description;
                this.editForm.description_short = product.description_short;
                this.editForm.active = product.active;
                this.editForm.price = product.price;
                console.log(this.editForm);

                $('#modal-edit-product').modal('show');
            },

            del: function (product_id) {
                axios.delete(`/api/products/delete/${product_id}`)
                    .then(response => {
                        this.loadProducts();
                    });

                $('#modal-edit-product').modal('hide');
            },

            /**
             * Persist the client to storage using the given form.
             */
            persistClient(method, uri, form, modal) {
                form.errors = [];

                axios[method](uri, form)
                    .then(response => {
                        this.loadProducts(this.current_category);
                        $(modal).on('hidden.bs.modal', function (e) {
                            form.name = '';
                            form.errors = [];
                        }).modal('hide');
                    })
                    .catch(error => {
                        if (typeof error.response.data === 'object') {
                            form.errors = _.flatten(_.toArray(error.response.data.errors));
                        } else {
                            form.errors = ['Something went wrong. Please try again.'];
                        }
                    });
            },
            /**
             * Create a new OAuth client for the user.
             */
            store() {
                this.createForm.category_id = this.current_category.id;
                this.persistClient(
                    'post', '/api/products/create/',
                    this.createForm, '#modal-create-product'
                );

                this.loadProducts();
            },

            goBack: function () {
                this.loadCategories();
            },

            showCreateProductModal() {
                this.createForm = {};
                $('#modal-create-product').modal('show');
            },
        }

    }
</script>
