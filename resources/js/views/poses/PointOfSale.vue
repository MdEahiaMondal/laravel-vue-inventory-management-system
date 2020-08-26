<template>
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>

        <div class="row mb-3">
            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Monthly Recap Report</h6>
                        <a href="#" class="btn btn-primary">Add Customer</a>
                    </div>
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Unit</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><a href="#">RA0449</a></td>
                                    <td>Udin Wayang</td>
                                    <td>Nasi Padang</td>
                                    <td><a  href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                <tr>
                                    <td><a href="#">RA0449</a></td>
                                    <td>Udin Wayang</td>
                                    <td>Nasi Padang</td>
                                    <td><a  href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">

                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total Quantity
                                    <strong>50</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                   Sub Total
                                    <strong>50 $</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                   Vat
                                    <strong>35 %</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                   Total
                                    <strong>65465 $</strong>
                                </li>
                            </ul>

                            <br>
                            <br>

                            <form>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Customer Name</label>
                                    <select class="form-control" id="exampleFormControlSelect1">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Pay Amount</label>
                                    <input type="number" class="form-control" id="exampleFormControlInput1">
                                </div>
                                <div class="form-group">
                                    <label for="dexampleFormControlInput1">Due Amount</label>
                                    <input type="number" class="form-control" id="dexampleFormControlInput1">
                                </div>
                                <div class="form-group">
                                    <label for="paytype">Payment Type</label>
                                    <select class="form-control" id="paytype">
                                        <option value="hand_cash">Hand Cash</option>
                                        <option value="cash">Cash</option>
                                        <option value="gift_card">Gift Card</option>
                                    </select>
                                </div>

                                <button class="btn btn-success">Submit</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-7 col-lg-7">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
                        </li>
                        <li class="nav-item" role="presentation" v-for="category in categories" :key="category.id">
                            <a class="nav-link" id="profile-tab" @click="getCategoryWiseProducts(category.id)" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{ category.category_name }}</a>
                        </li>
                    </ul>
                    <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <input type="text" class="form-control" v-model="searchText">
                                <div class="row mt-3">
                                    <div class="col-xl-3 col-md-3 col-sm-6 col-6 mb-2"
                                         v-for="(product, index) in showAllProducts"
                                         :key="product.id">
                                        <div class="card" style="width: 8.5rem;">
                                            <img :src="'/'+ product.photo" class="card-img-top" alt="">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ product.product_name }}</h5>
                                                <span v-if="product.product_quantity > 0" class="badge badge-success">Available ( {{ product.product_quantity }} )</span>
                                                <span v-else class="badge badge-danger">Stock Out</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <input type="text" class="form-control" v-model="searchText">
                                <div class="row mt-3">
                                    <div class="col-xl-3 col-md-3 col-sm-6 col-6 mb-2"
                                         v-for="categoryProduct in showAllCategoryProducts"
                                         :key="categoryProduct.id">
                                        <div class="card" style="width: 8.5rem;">
                                            <img :src="'/'+ categoryProduct.photo" class="card-img-top" alt="">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ categoryProduct.product_name }}</h5>
                                                <span v-if="categoryProduct.product_quantity > 0" class="badge badge-success">Available ( {{ categoryProduct.product_quantity }} )</span>
                                                <span v-else class="badge badge-danger">Stock Out</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Row-->

    </div>
</template>

<script>
export default {
    created() {
        this.allProducts()
        this.getAllCategories()
    },
    name: "PointOfSale",
    data(){
        return {
            products: [],
            searchText: '',
            categories: [],
            categoryWiseProducts: [],
        }
    },
    computed: {
        showAllProducts(){
            return this.products.filter(item => {
                return item.product_name.toLowerCase().match(this.searchText.toLowerCase())
            })
        },
        showAllCategoryProducts(){
            return this.categoryWiseProducts.filter(item => {
                return item.product_name.toLowerCase().match(this.searchText.toLowerCase())
            })
        },
    },
    methods: {
        getAllCategories(){
            axios.get('/api/categories')
                .then(res => {
                    this.categories = res.data
                })
                .catch(e => {
                    console.log(e.response)
                })
        },
        allProducts(){
            axios.get('/api/products')
                .then(res => {
                    this.products = res.data
                })
                .catch(e => {
                    console.log(e.response)
                })
        },
        getCategoryWiseProducts(id){
            axios.get('/api/poses/products/category/' + id)
                .then(res => {
                    this.categoryWiseProducts = res.data
                })
                .catch(e => {
                    console.log(e.response)
                })
        },
    }
}
</script>

<style scoped>

</style>
