
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./custom');

// const express = require('express');

window.Vue = require('vue');

import VueLazyload from 'vue-lazyload';
import BasicVueChat from 'basic-vue-chat';

Vue.use(BasicVueChat);

// or with options
Vue.use(VueLazyload, {
    lazyComponent: true,
    preLoad: 1.3,
//    error: 'dist/error.png',
 //   loading: 'dist/loading.gif', 
    attempt: 1,
    listenEvents: [ 'scroll' ]
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('sidebar', require('./components/sidebar.vue'));

Vue.component('user', require('./components/user.vue'));

Vue.component('posts-list', require('./components/PostsList.vue'));

Vue.component('users-list', require('./components/UsersList.vue'));

Vue.component('post', require('./components/Post.vue'));

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('categories-list', require('./components/Categories-list.vue'));

Vue.component('reviews-list', require('./components/ReviewsList.vue'));



const app = new Vue({
    el: '#app'
});
