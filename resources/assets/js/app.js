
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.Event = new class {
    constructor() {
        this.vue = new Vue();
    }

    /**
     * Emit An Event
     * @param  {string} event
     * @param  {mixed} [data=null]
     * @return {void}
     */
    fire (event, data = null) {
        this.vue.$emit(event, data);
    }

    /**
    * Listen To Event
    * @param  {string} event
    * @param  {mixed} callback
    * @return {void}
    */
    listen (event, callback) {
        this.vue.$on(event, callback);
    }
}

import VueRouter from 'vue-router';

Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Folders from './components/Folders.vue';
import SingleFolder from './components/SingleFolder.vue';


 const routes = [
     { path: '/', component: Folders },
     {
         name: 'SingleFolder',
         path: '/SingleFolder/:id/:name',
         component: SingleFolder
     },
 ];

 const router = new VueRouter({
     routes // short for `routes: routes`
 });


 const app = new Vue({
     router
 }).$mount('#app');
