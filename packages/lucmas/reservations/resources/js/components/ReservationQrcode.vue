<template>
    <div class="row justify-content-center">

        <div class="card card-body mt-5 col-12 col-lg-8 mb-2 p-3 pb-1 text-center animated fadeInDown"
             v-on:click="openCamera()">
            <h4 class="h4-responsive">
                <strong>Clicca qui</strong>
            </h4>
            <p class="small text-muted">
                per inquadrare il QrCode del tavolo e per procedere con l'ordine,
                o consultare il menu aggiornato
            </p>
        </div>

        <div class="col-12 col-lg-6" style="max-height: 300px">
            <div class="d-flex justify-content-center pt-5" v-if="loading">
                <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
            <qrcode-stream v-if="camera" @decode="onDecode" @init="onInit"></qrcode-stream>
        </div>
        <div class="col-12 text-danger card card-body" v-if="errors">
            {{errors}}
        </div>
    </div>
</template>

<script>

    export default {
        data: function () {
            return {
                camera: false,
                loading: false,
                qrcode_content: null,
                errors: null,
            }
        },

        mounted() {
        },

        methods: {
            openCamera: function () {
                if (!this.camera) {
                    this.camera = true;
                    this.loading = true;
                }
            },
            onDecode(content) {
                // decode from base64
                let decoded = atob(content)
                this.qrcode_content = decoded;

                // md5 reservation_qr_code
                if (decoded.includes('45714ee1b5c093af0a041167eac64824')) {
                    let table_number = decoded.replace("45714ee1b5c093af0a041167eac64824@", "");
                    window.location.href = 'reservation/' + table_number
                } else {
                    console.log('qr_code non valido!')
                }
            },
            onInit(promise) {
                promise.then(({capabilities}) => {
                    this.loading = false;
                })
                    .catch(error => {
                        this.loading = false;
                        if (error.name === 'NotAllowedError') {
                            this.errors = 'Hey! I need access to your camera'
                        } else if (error.name === 'NotFoundError') {
                            this.errors = 'Do you even have a camera on your device?'
                        } else if (error.name === 'NotSupportedError') {
                            this.errors = 'Seems like this page is served in non-secure context (HTTPS, localhost or file://)'
                        } else if (error.name === 'NotReadableError') {
                            this.errors = 'Couldn\'t access your camera. Is it already in use?'
                        } else if (error.name === 'OverconstrainedError') {
                            this.errors = 'Constraints don\'t match any installed camera. Did you asked for the front camera although there is none?'
                        } else {
                            this.errors = 'UNKNOWN ERROR: ' + error.message
                        }
                    })
            }
        }
    }
</script>
