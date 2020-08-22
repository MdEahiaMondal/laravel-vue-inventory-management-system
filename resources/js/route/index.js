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

//categories
import CategoryIndex from "../views/categories/Index";
import CategoryCreate from "../views/categories/Create";
import CategoryEdit from "../views/categories/Edit";


//products
import ProductIndex from "../views/products/Index";
import ProductCreate from "../views/products/Create";
import ProductEdit from "../views/products/Edit";


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


            {
                path: 'categories',
                name: 'categories',
                component: CategoryIndex,
            },
            {
                path: 'categories/create',
                name: 'categories-create',
                component: CategoryCreate,
            },
            {
                path: 'categories/edit/:id',
                name: 'categories-edit',
                component: CategoryEdit,
            },


            {
                path: 'products',
                name: 'products',
                component: ProductIndex,
            },
            {
                path: 'products/create',
                name: 'products-create',
                component: ProductCreate,
            },
            {
                path: 'products/edit/:id',
                name: 'products-edit',
                component: ProductEdit,
            },
        ]
    },



]

const router = new VueRouter({
    routes,
    mode: 'history'
})

export default router
