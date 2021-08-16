
// require('./bootstrap');

// window.Vue = require('vue');
// window.Event = new Vue();
import Vue from 'vue';
import axios from "axios";

Vue.prototype.axios=axios;

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Calling The Components
import InvoiceComponent from "./components/InvoiceComponent";
import ExampleComponent from "./components/ExampleComponent";



new Vue({
    el: '#app',
    components:{
        InvoiceComponent,
        ExampleComponent,
    },
});
