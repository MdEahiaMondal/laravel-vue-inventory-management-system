<template>
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon">
                <img src="">
            </div>
            <div class="sidebar-brand-text mx-3">RuangAdmin</div>
        </a>
        <hr class="sidebar-divider my-0">
        <li class="nav-item active">
            <router-link class="nav-link" :to="{name: 'dashboard'}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></router-link>
        </li>
        <li class="nav-item active">
            <router-link class="nav-link" :to="{name: 'poses'}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Poses</span></router-link>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Features
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ordersBootstrap"
               aria-expanded="true" aria-controls="ordersBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Manage Orders</span>
            </a>
            <div id="ordersBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <router-link class="collapse-item" :to="{name: 'today-orders'}">Today Orders</router-link>
                    <router-link class="collapse-item" :to="{name: 'orders-search'}">Search</router-link>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
               aria-expanded="true" aria-controls="collapseBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Manage Employees</span>
            </a>
            <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <router-link class="collapse-item" :to="{name: 'employees-create'}">Create Employ</router-link>
                    <router-link class="collapse-item" :to="{name: 'employees'}">Employees</router-link>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#SupplierBootstrap"
               aria-expanded="true" aria-controls="SupplierBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Manage Suppliers</span>
            </a>
            <div id="SupplierBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <router-link class="collapse-item" :to="{name: 'suppliers-create'}">Create Supplier</router-link>
                    <router-link class="collapse-item" :to="{name: 'suppliers'}">Suppliers</router-link>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CustomerBootstrap"
               aria-expanded="true" aria-controls="CustomerBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Manage Customers</span>
            </a>
            <div id="CustomerBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <router-link class="collapse-item" :to="{name: 'customers-create'}">Create Customer</router-link>
                    <router-link class="collapse-item" :to="{name: 'customers'}">Customers</router-link>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#CategoryBootstrap"
               aria-expanded="true" aria-controls="CategoryBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Manage Categories</span>
            </a>
            <div id="CategoryBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <router-link class="collapse-item" :to="{name: 'categories-create'}">Create Category</router-link>
                    <router-link class="collapse-item" :to="{name: 'categories'}">Categories</router-link>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ProductsBootstrap"
               aria-expanded="true" aria-controls="ProductsBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Manage Products</span>
            </a>
            <div id="ProductsBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <router-link class="collapse-item" :to="{name: 'products-create'}">Create Product</router-link>
                    <router-link class="collapse-item" :to="{name: 'products'}">Products</router-link>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ExpensesBootstrap"
               aria-expanded="true" aria-controls="ExpensesBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Manage Expenses</span>
            </a>
            <div id="ExpensesBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <router-link class="collapse-item" :to="{name: 'expenses-create'}">Create Expense</router-link>
                    <router-link class="collapse-item" :to="{name: 'expenses'}">Expenses</router-link>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#SalariesBootstrap"
               aria-expanded="true" aria-controls="SalariesBootstrap">
                <i class="far fa-fw fa-window-maximize"></i>
                <span>Manage Salaries</span>
            </a>
            <div id="SalariesBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <router-link class="collapse-item" :to="{name: 'salaries'}">Employees</router-link>
                    <router-link class="collapse-item" :to="{name: 'salaries-all'}">All Salary</router-link>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <router-link class="nav-link" :to="{name: 'products-stock'}">
                <i class="fa fa-sign-out-alt"></i>
                <span>Manage Product Stock</span>
            </router-link>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" @click.prevent="logout">
                <i class="fa fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>
</template>

<script>
import AppStorage from "../helpers/AppStorage";

export default {
name: "Sidebar",
    methods: {
        logout()
        {
            AppStorage.clear()
            Message.Toaster('Sign out Successfully ')
            this.$router.push({path: '/'})
        }
    }
}
</script>

<style scoped>

</style>
