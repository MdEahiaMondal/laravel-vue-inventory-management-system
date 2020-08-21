import Vue from 'vue'
import VueRouter from "vue-router";
import Dashboard from "../views/Dashboard";
import Login from "../views/auth/Login";
import Register from "../views/auth/Register";
import ForgotPassword from "../views/auth/ForgotPassword";
Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: Login,
    },
    {
        path: '/register',
        component: Register,
    },

    {
        path: '/forgot-password',
        component: ForgotPassword,
    },

    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
    },



]

const router = new VueRouter({
    routes,
    mode: 'history'
})

export default router
