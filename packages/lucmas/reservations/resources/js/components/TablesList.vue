<template>
    <div class="row mb-2 pb-2">

        <div v-if="errors" class="position-absolute">
            <span v-for="error in errors">
                {{error}}
            </span>
        </div>
        <button type="button" class="btn btn-success position-fixed"
                v-on:click="showCreateTableModal"
                style="z-index:99;bottom:0.6rem;right:0.6rem">
            Nuovo Tavolo
        </button>

        <!--        TAVOLI      -->
        <div class="col-12 col-lg-6 col-xl-4 mt-1 px-0" v-for="table in tables">
            <div class="card card-body rounded-0 d-flex flex-row px-2 pt-3 mx-0 mx-lg-2 mb-lg-2">
                <div class="d-block">
                    <p><strong class="mr-1">Numero:</strong> {{table.number}}</p>
                </div>
                <div class="w-100 text-right">
                    <i class="fa fa-2x fa-pencil-alt" v-on:click="edit(table)"></i>
                </div>
            </div>
        </div>

        <!-- Create Table Modal -->
        <div class="modal fade right" id="modal-create-table" tabindex="-1" role="dialog">
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
                                    Numero
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="numero"
                                           placeholder="Numero..." required v-model="createForm.number">
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

        <!-- Edit Table Modal -->
        <div class="modal fade right" id="modal-edit-table" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-full-height modal-right" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Modifica Tavolo
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>

                    <div class="modal-body">
                        <table class="table table-striped">
                            <tr>
                                <td>
                                    Numero
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="number"
                                           placeholder="Numero..." required v-model="editForm.number">
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
                errors: [],
                tables: [],
                message: null,
                editForm: {
                    number: '',
                },
                createForm: {
                    number: '',
                },
            }
        },

        mounted() {
            this.loadTables();
        },

        methods: {
            loadTables: function (parent_id) {

                let url = '/api/tables';

                if (parent_id)
                    url += "/" + parent_id;

                axios.get(url)
                    .then((response) => {
                        this.tables = response.data.data;
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
                    'put', '/api/tables/edit/' + this.editForm.id,
                    this.editForm, '#modal-edit-table'
                );
                this.loadTables();
            },
            edit(table) {
                this.editForm.id = table.id;
                this.editForm.number = table.number;
                this.editForm.detive = table.active;

                $('#modal-edit-table').modal('show');
            },

            del: function (table_id) {
                axios.delete(`/api/tables/delete/${table_id}`)
                    .then(response => {
                        this.loadTables();
                    });

                $('#modal-edit-table').modal('hide');
            },

            /**
             * Persist the client to storage using the given form.
             */
            persistClient(method, uri, form, modal) {
                this.errors = [];

                axios[method](uri, form)
                    .then(response => {
                    })
                    .catch(error => {
                        this.errors = ['Something went wrong. Please try again.'];
                        console.log(this.errors);
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
                    'post', '/api/tables/create/',
                    this.createForm, '#modal-create-table'
                );
                $('#modal-create-table').modal('hide');
                this.createForm = {name: ''};

                this.loadTables();
            },

            goBack: function () {
                this.loadTables();
            },

            showCreateTableModal() {
                $('#modal-create-table').modal('show');
            },

            processImage: function (event) {
                this.createForm.image = event.target.files[0];
            }
        },

    }
</script>
