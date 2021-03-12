require('./bootstrap');

window.Vue = require('vue').default;

// VueSweetalert2
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
Vue.use(VueSweetalert2);

// Datatables
import DataTable from 'laravel-vue-datatable';
Vue.use(DataTable);

// Componenents
import ProductosComponent from './components/ProductosComponent.vue';
import AdminComponent from './components/AdminComponent.vue';
import DropDownCart from './components/DropDownCart.vue';
import CartComponent from './components/CartComponent.vue';
import InboxComponent from './components/InboxComponent.vue';
import OrdersComponent from './components/OrdersComponent.vue';
import UsersComponent from './components/UsersComponent.vue';
import AuditComponent from './components/AuditComponent.vue';

Vue.component('productos-component', ProductosComponent);
Vue.component('admin-component', AdminComponent);
Vue.component('dropdowncart-component', DropDownCart);
Vue.component('cart-component', CartComponent);
Vue.component('inbox-component', InboxComponent);
Vue.component('audit-component', AuditComponent);

const app = new Vue({
    el: '#app',
    components: { 
        ProductosComponent, 
        AdminComponent, 
        DropDownCart, 
        CartComponent, 
        InboxComponent, 
        OrdersComponent,
        UsersComponent, 
        AuditComponent,
    }
});


