
require('./bootstrap');
import Vue from 'vue'
import App from "./App.vue";


import router from "./route";


import axios from 'axios'
window.axios = axios


new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
