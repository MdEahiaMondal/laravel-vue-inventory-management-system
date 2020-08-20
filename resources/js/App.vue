<template>
    <div class="Main">
        <div id="wrapper">
            <!-- Sidebar -->
            <sidebar></sidebar>
            <!-- Sidebar -->
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <!-- TopBar -->
                    <top-bar></top-bar>
                    <!-- Topbar -->
                    <!-- Container Fluid-->
                    <div class="container-fluid" id="container-wrapper">
                        <router-view></router-view>
                    </div>
                    <!---Container Fluid-->
                </div>
                <!-- Footer -->
                    <footer></footer>
                <!-- Footer -->
            </div>
        </div>
    </div>
</template>

<script>

import Sidebar from "./components/Sidebar";
import Footer from "./components/Footer";
import TopBar from "./components/TopBar";
export default {
    name: "App",
    components: {TopBar, Footer, Sidebar}
}
</script>

<style scoped>

</style>
