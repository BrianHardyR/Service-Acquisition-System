
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('search-service', require('./components/SearchService.vue'));
Vue.component('my-map', require('./components/Map.vue'));
Vue.component('my-place', require('./components/Places.vue'));
Vue.component('search-all', require('./components/SearchAll.vue'));
const app = new Vue({
    el: '#app',

});

