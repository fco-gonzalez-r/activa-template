require('./bootstrap');

window.Vue = require('vue').default;

import moment from 'moment'
import VueRouter from 'vue-router'
import Vuex from 'vuex'
import axios from 'axios'
import VueAxios from 'vue-axios'

import Swal from 'sweetalert2'
window.swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 2000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.toast = Toast;

import VueProgressBar from 'vue-progressbar'

const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
      speed: '0.2s',
      opacity: '0.6s',
      termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
  }

  Vue.use(VueProgressBar, options)

//Routes
import { routes } from './routes';

Vue.prototype.$user = window.user

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.use(VueRouter)
Vue.use(Vuex)
Vue.use(VueAxios, axios)

import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs'
Vue.use(LaravelPermissionToVueJS)

//Register Routes
export const router = new VueRouter({
  base: '/',
  mode: 'history',
  routes,
  linkActiveClass: "active", // active class for non-exact links.
  // linkExactActiveClass: "active", // active class for *exact* links.
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 */


Vue.filter('upText', function(text){
    return text.charAt(0).toUpperCase() + text.slice(1)
});

Vue.filter('myDate',function(created){
    return moment(created).format('DD-MM-YYYY');
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router
}).$mount('#app')