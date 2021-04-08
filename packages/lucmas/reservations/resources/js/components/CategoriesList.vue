<template>
    <div class="row mb-2 pb-2">

        <button type="button" class="btn btn-success position-fixed"
                v-on:click="showCreateCategoryModal"
                style="z-index:99;bottom:0.6rem;right:0.6rem">
            Nuova Categoria
        </button>

        <!--        CATEGORIE      -->
        <div class="col-12 col-lg-6 col-xl-4 mt-1 px-0" v-for="category in categories">
            <div class="card card-body rounded-0 d-flex flex-row px-2 pt-3 mx-0 mx-lg-2 mb-lg-2">
                <div class="d-block">
                    <p><strong class="mr-1">Nome:</strong> {{category.name}}</p>
                    <p><strong class="mr-1">Descrizione corta:</strong> {{category.description_short}}</p>
                    <p><strong class="mr-1">Descrizione:</strong> {{category.description}}</p>
                </div>
                <div class="w-100 text-right">
                    <i class="fa fa-2x fa-pencil-alt" v-on:click="edit(category)"></i>
                </div>
            </div>
        </div>

        <!-- Create Category Modal -->
        <div class="modal fade right" id="modal-create-category" tabindex="-1" role="dialog">
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
                                            <input type="file" class="custom-file-input" name="category_image"
                                                   id="inputGroupFile01" v-on:change="processImage($event)">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
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
                            <tr>
                                <td>
                                    Tipologia
                                </td>
                                <td>
                                    <select class="form-control" v-model="createForm.parent_id">
                                        <option disabled value="">Please select one</option>
                                        <option value="2">Bevande</option>
                                        <option value="1">Cibo</option>
                                    </select>
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

        <!-- Edit CATEGORY Modal -->
        <div class="modal fade right" id="modal-edit-category" tabindex="-1" role="dialog">
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
                                            <input type="file" class="custom-file-input" name="category_image"
                                                   id="inputGroupFile02" aria-describedby="inputGroupFileAddon01">
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>
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

                let url = '/api/categories/withparent';

                if (parent_id)
                    url += "/" + parent_id;

                axios.get(url)
                    .then((response) => {
                        this.current_category = null;
                        this.categories = response.data.data;
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
                    'put', '/api/categories/edit/' + this.editForm.id,
                    this.editForm, '#modal-edit-category'
                );
                this.loadCategories();
            },
            edit(category) {
                this.editForm.id = category.id;
                this.editForm.name = category.name;
                this.editForm.description = category.description;
                this.editForm.description_short = category.description_short;
                this.editForm.active = category.active;
                console.log(this.editForm);

                $('#modal-edit-category').modal('show');
            },

            del: function (category_id) {
                axios.delete(`/api/categories/delete/${category_id}`)
                    .then(response => {
                        this.loadCategories();
                    });

                $('#modal-edit-category').modal('hide');
            },

            /**
             * Persist the client to storage using the given form.
             */
            persistClient(method, uri, form, modal) {
                form.errors = [];

                axios[method](uri, form)
                    .then(response => {
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

                let keys = Object.keys(this.createForm);

                let formData = new FormData();
                keys.forEach(key => {
                    let item = this.createForm[key];
                    formData.append(key, item);
                })

                this.persistClient(
                    'post', '/api/categories/create/',
                    this.createForm, '#modal-create-category'
                );

                this.createForm = {name: ''};
                this.loadCategories();
            },

            goBack: function () {
                this.loadCategories();
            },

            showCreateCategoryModal() {
                $('#modal-create-category').modal('show');
            },

            processImage: function (event) {
                this.createForm.image = event.target.files[0];
            }
        }

    }
</script>
