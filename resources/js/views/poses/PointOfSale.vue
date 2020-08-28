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
                            <table class="table align-items-center table-flush" style="font-size: 12px">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="cart_product in carts_products" :key="cart_product.id">
                                    <td><a href="#">{{ cart_product.product_name }}</a></td>
                                    <td class="d-flex">
                                        <input  type="text" style="width: 26px"  readonly :value="cart_product.selling_quantity">
                                        <button  @click.prevent="cartIncrement(cart_product.id)" class="btn btn-success btn-sm">+</button>
                                        <button v-if="cart_product.selling_quantity >=  2"  @click.prevent="cartDecrement(cart_product.id)"  class="btn btn-danger btn-sm">-</button>
                                        <button v-else disabled class="btn btn-danger btn-sm">-</button>

                                    </td>
                                    <td>{{ cart_product.selling_price }}</td>
                                    <td>{{ cart_product.sub_total }}</td>
                                    <td><a @click.prevent="removeCartItem(cart_product.id)" href="#" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">

                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Total Quantity
                                    <strong>{{ total_quantity }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                   Sub Total
                                    <strong>{{ subtotal }} $</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                   Vat
                                    <strong>{{ vat }} %</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                   Total
                                    <strong> {{ subtotal*vat/100 + subtotal }} $</strong>
                                </li>
                            </ul>

                            <br>
                            <br>

                            <form @submit.prevent="orderDone">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Customer Name</label>
                                    <select class="form-control" v-model="customer_id" id="exampleFormControlSelect1">
                                        <option :value="customer.id" v-for="customer in customers" :key="customer.id">{{ customer.name }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Pay Amount</label>
                                    <input v-model="pay_amount" type="number" class="form-control" id="exampleFormControlInput1">
                                </div>
                                <div class="form-group">
                                    <label for="dexampleFormControlInput1">Due Amount</label>
                                    <input v-model="due_amount" type="number" class="form-control" id="dexampleFormControlInput1">
                                </div>
                                <div class="form-group">
                                    <label for="paytype">Payment Type</label>
                                    <select v-model="pay_type" class="form-control" id="paytype">
                                        <option value="hand_cash">Hand Cash</option>
                                        <option value="cash">Cash</option>
                                        <option value="gift_card">Gift Card</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-success">Submit</button>
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
                                        <a class="btn" @click.prevent="addToPose(product.id)">
                                            <div class="card" style="width: 8.5rem;">
                                                <img :src="'/'+ product.photo" class="card-img-top" alt="">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ product.product_name }}</h5>
                                                    <span v-if="product.product_quantity > 0" class="badge badge-success">Available ( {{ product.product_quantity }} )</span>
                                                    <span v-else class="badge badge-danger">Stock Out</span>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <input type="text" class="form-control" v-model="searchText">
                                <div class="row mt-3">
                                    <div class="col-xl-3 col-md-3 col-sm-6 col-6 mb-2"
                                         v-for="categoryProduct in showAllCategoryProducts"
                                         :key="categoryProduct.id">
                                        <a class="btn" @click.prevent="addToPose(categoryProduct.id)">
                                            <div class="card" style="width: 8.5rem;">
                                                <img :src="'/'+ categoryProduct.photo" class="card-img-top" alt="">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ categoryProduct.product_name }}</h5>
                                                    <span v-if="categoryProduct.product_quantity > 0" class="badge badge-success">Available ( {{ categoryProduct.product_quantity }} )</span>
                                                    <span v-else class="badge badge-danger">Stock Out</span>
                                                </div>
                                            </div>
                                        </a>
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
        this.getAllCustomers()
        this.getAllCartProducts()
        ReloadSpecificComponent.$on('ReloadCartComponent', () => {
            this.getAllCartProducts()
        })
    },
    name: "PointOfSale",
    data(){
        return {
            products: [],
            searchText: '',
            categories: [],
            categoryWiseProducts: [],
            customers: [],
            carts_products: [],
            vat : 10,
            customer_id: '',
            due_amount: '',
            pay_amount: '',
            pay_type: '',
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

        total_quantity(){
            let sum = 0;
            for (let i = 0; i < this.carts_products.length; i++){
                sum += parseFloat(this.carts_products[i].selling_quantity)
            }
            return sum;
        },
        subtotal(){
            let sum = 0;
            for (let i = 0; i < this.carts_products.length; i++){
                sum += (parseFloat(this.carts_products[i].selling_quantity) * parseFloat(this.carts_products[i].selling_price))
            }
            return sum;
        },
        getOrderInfo(){
            return  {
                vat: this.vat,
                total_qty: this.total_quantity,
                sub_total: this.subtotal,
                total: this.subtotal*this.vat/100 + this.subtotal,
                customer_id: this.customer_id,
                due_amount: this.due_amount,
                pay_amount: this.pay_amount,
                pay_type: this.pay_type,
            }
        }

    },
    methods: {
        orderDone(){
            axios.post('/api/orders', this.getOrderInfo)
                .then(res => {
                    Message.Success('Order Successfully done')
                    this.$router.push({name: 'dashboard'})
                })
                .catch(e => {
                    console.log(e.response)
                })
        },
        cartIncrement(cart_id){
            axios.get('/api/poses/carts/increment/'+cart_id)
                .then(res => {
                    ReloadSpecificComponent.$emit('ReloadCartComponent')
                })
                .catch(e => {
                    console.log(e.response)
                })
        },
        cartDecrement(cart_id){
            axios.get('/api/poses/carts/decrement/'+cart_id)
                .then(res => {
                    ReloadSpecificComponent.$emit('ReloadCartComponent')
                })
                .catch(e => {
                    console.log(e.response)
                })
        },
        removeCartItem(id){
            axios.get('/api/poses/carts/'+id)
                .then(res => {
                    ReloadSpecificComponent.$emit('ReloadCartComponent')
                })
                .catch(e => {
                    console.log(e.response)
                })
        },
        getAllCartProducts(id){
            axios.get('/api/poses/carts/products')
                .then(res => {
                   this.carts_products = res.data.products
                })
                .catch(e => {
                    console.log(e.response)
                })
        },
        addToPose(id){
            axios.get('/api/poses/products/'+id)
                .then(res => {
                    ReloadSpecificComponent.$emit('ReloadCartComponent')
                    Message.Success('Product Add to Cart')
                })
                .catch(e => {
                    console.log(e.response)
                })
        },
        getAllCustomers(){
            axios.get('/api/customers')
                .then(res => {
                    this.customers = res.data
                })
                .catch(e => {
                    console.log(e.response)
                })
        },
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
