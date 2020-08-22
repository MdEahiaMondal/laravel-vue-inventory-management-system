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
import EmployEdit from "../views/employees/Edit";

//suppliers
import SupplierIndex from "../views/suppliers/Index";
import SupplierCreate from "../views/suppliers/Create";
import SupplierEdit from "../views/suppliers/Edit";


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
            {
                path: 'employees/edit/:id',
                name: 'employees-edit',
                component: EmployEdit,
            },

            {
                path: 'suppliers',
                name: 'suppliers',
                component: SupplierIndex,
            },
            {
                path: 'suppliers/create',
                name: 'suppliers-create',
                component: SupplierCreate,
            },
            {
                path: 'suppliers/edit/:id',
                name: 'suppliers-edit',
                component: SupplierEdit,
            },
        ]
    },



]

const router = new VueRouter({
    routes,
    mode: 'history'
})

export default router
