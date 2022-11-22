/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap.js');

require('bootstrap-select');

 /**
  * Next, we will create a fresh Vue application instance and attach it to
  * the page. Then, you may begin adding components to this application
  * or customize the JavaScript scaffolding to fit your unique needs.
  */

import { createApp } from 'vue';
import Payment from './components/Payment/Payment.vue'

const app = createApp({});
app.component('Payment', Payment)
app.mount("#app");
