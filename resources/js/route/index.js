import Vue from 'vue'
import VueRouter from "vue-router";
import Dashboard from "../views/Dashboard";
import Login from "../views/auth/Login";
import Register from "../views/auth/Register";
import ForgotPassword from "../views/auth/ForgotPassword";
Vue.use(VueRouter)


//employees
import EmployIndex from "../views/employees/Index";
import EmployCreate from "../views/employees/Create";


const routes = [
    {
        path: '/',
        name: 'login',
        component: Login,
        beforeEnter(to, from, next) {
            if (User.loggedIn()){
                next('/dashboard')
            }else{
                next()
            }
        }
    },
    {
        path: '/login',
        component: Login,
        beforeEnter(to, from, next) {
            if (User.loggedIn()){
                next('/dashboard')
            }else{
                next()
            }
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        beforeEnter(to, from, next) {
            if (User.loggedIn()){
                next('/dashboard')
            }else{
                next()
            }
        }
    },

    {
        path: '/forgot-password',
        name: 'forgotPassword',
        component: ForgotPassword,
        beforeEnter(to, from, next) {
            if (User.loggedIn()){
                next('/dashboard')
            }else{
                next()
            }
        }
    },

    {
        path: '/dashboard',
        name: 'dashboard',
        component: () => import('../views/layouts/Master'),
        children: [
            {
                path: '',
                name: 'dashboard',
                component: Dashboard,
            },
            {
                path: 'employees',
                name: 'employees',
                component: EmployIndex,
            },
            {
                path: 'employees/create',
                name: 'employees-create',
                component: EmployCreate,
            },

        ]
    },



]

const router = new VueRouter({
    routes,
    mode: 'history'
})

export default router
