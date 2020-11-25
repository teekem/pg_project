
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 /************** Bootstrap vue************* */
import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

import store from './store'
// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)


import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
/******************************************** */


require('./bootstrap');

window.Vue = require('vue');
import moment from 'moment'
import { Form, HasError, AlertError } from 'vform'
import Gate from './Gate';
Vue.prototype.$gate = new Gate(window.user);
window.Form = Form;


// ES6 Modules or TypeScript
import swal from 'sweetalert2'
window.swal = swal;

const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', swal.stopTimer)
    toast.addEventListener('mouseleave', swal.resumeTimer)
  }
})

window.toast = toast;

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '3px'
})

import vueMultiSelect from 'vue-multi-select';
Vue.use(vueMultiSelect);
import 'vue-multi-select/dist/lib/vue-multi-select.css';

let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default},
    { path: '/developer', component: require('./components/Developer.vue').default},
    { path: '/users', component: require('./components/Users.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/course', component: require('./components/Course.vue').default },
    { path: '/curriculum', component: require('./components/Curriculum.vue').default },
    { path: '/programme', component: require('./components/Programme.vue').default },
    { path: '/department', component: require('./components/Department.vue').default },
    { path: '/faculty', component: require('./components/Faculty.vue').default },
    { path: '/setting', component: require('./components/Setting.vue').default },
    { path: '/adninTools', component: require('./components/AdninTools.vue').default },
    { path: '/component', component: require('./components/TestComponent.vue').default },
    { path: '/TestComponent2', component: require('./components/TestComponent2.vue').default },

    { path: '*', component: require('./components/Dashboard.vue').default },

    // ************************** student route **********************************
    { path: '/sdashboard', component: require('./components/students/Sdashboard.vue').default},
    { path: '/scoursereg', component: require('./components/students/Scoursereg.vue').default},
    { path: '/sprofile', component: require('./components/students/Sprofile.vue').default },
    { path: '/tbv', component: require('./components/students/TestBootstrapVue.vue').default },

  ]


  const router = new VueRouter({
      //mode: 'history',
    routes // short for `routes: routes`
  })

  Vue.filter('upText', function(text){
      return text.charAt(0).toUpperCase() + text.slice(1);
  })

  Vue.filter('dateFormat', function(created){
    //return moment(created).format('MMMM Do YYYY, h:mm:ss a');
    return moment(created).format('MMMM Do YYYY');
  })

  
  window.Fire = new Vue();


  Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
Vue.component(
    'not-found',
    require('./components/404.vue').default
);

Vue.component('pagination', require('laravel-vue-pagination'));
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    store,
    data(){
      return {
        search: ''
      }
    },


    methods:{
      searchit(){
       Fire.$emit('searching')
      }
    }
});
