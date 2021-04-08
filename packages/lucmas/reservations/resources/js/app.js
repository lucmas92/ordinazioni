require('./bootstrap');

window.Vue = require('vue');

import VueQrcodeReader from "vue-qrcode-reader";
import { BProgress } from 'bootstrap-vue'
Vue.component('b-progress', BProgress)

Vue.use(VueQrcodeReader);
Vue.component('reservation-products-list', require('./components/ReservationProductsList.vue').default)
Vue.component('products-list', require('./components/ProductsList.vue').default)
Vue.component('categories-list', require('./components/CategoriesList.vue').default)
Vue.component('tables-list', require('./components/TablesList.vue').default)
Vue.component('orders-list', require('./components/OrdersList.vue').default)
Vue.component('checkout-list', require('./components/CheckoutList.vue').default)
Vue.component('dashboard', require('./components/Dashboard.vue').default)
Vue.component('reservation_qrcode', require('./components/ReservationQrcode.vue').default)

const app = new Vue({
    el: '#app',
});
