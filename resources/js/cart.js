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
import tooltip from "./directives/tooltip.js";
import Cart from './components/Cart/Cart.vue'

const app = createApp(Cart);
app.directive('tooltip', tooltip)

app.mount("#app");
