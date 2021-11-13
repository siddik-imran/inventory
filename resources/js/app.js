
require('./bootstrap');


import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// Router Imported
import {routes} from './routes';

const router = new VueRouter({
    routes,
    mode:'history'
  })

// Import helpers User Class globally
import User from './helpers/User';
window.User = User

// Import helpers Notification Class globally
import Notification from './helpers/Notification';
window.Notification = Notification

// Sweet alert start

import Swal from 'sweetalert2'
window.Swal = Swal

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});

window.Toast = Toast

// Sweet alert end

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app',
    router
});
