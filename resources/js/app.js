
require('./bootstrap');
import Vue from 'vue'
import App from "./App.vue";


import router from "./route";


import axios from 'axios'
window.axios = axios


import User from "./helpers/User";
window.User = User


import Message from "./helpers/Message";
window.Message = Message

new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
