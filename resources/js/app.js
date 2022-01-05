require('./bootstrap');
window.Vue = require('vue');

import VueRouter from 'vue-router';
Vue.use(VueRouter);


import App from './App.vue';
import Home from './components/Home.vue';
import ProductList from './components/ProductList.vue';
import AddProduct from './components/AddProduct.vue';


//sweet alert 2
import VueSweetalert2 from 'vue-sweetalert2';
window.Swal = require('sweetalert2');
Vue.use(VueSweetalert2);


import utils from './helpers/utilities';
Vue.prototype.$utils = utils

import VueAxios from 'vue-axios';
import axios from 'axios';
import Vue from 'vue';
Vue.use(VueAxios, axios);



const routes = [{

    name: '/',
    path: '/',
    component: Home
},
{

    name: '/products',
    path: '/products',
    component: ProductList

},
{

    name: '/add_products',
    path: '/add_products',
    component: AddProduct

}

];

const router = new VueRouter({mode: 'history', routes: routes});
const app = new Vue(Vue.util.extend({ router }, App)).$mount('#app');