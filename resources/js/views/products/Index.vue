<template>
    <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Products</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Dashboard</router-link></li>
            <li class="breadcrumb-item">Products</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->

            <table class="">
                <tr>
                    <td><input type="text" class="form-control" v-model="searchText"></td>
                    <td><button class="btn btn-primary"><i class="fa fa-search"></i></button></td>
                </tr>
            </table>
            <br>
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Products</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th>SI</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Category</th>
                            <th>Supplier</th>
                            <th>Buying Price</th>
                            <th>Selling Price</th>
                            <th>Buying date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(product, index) in showAllProducts" :key="product.id">
                            <td>{{ index + 1 }}</td>
                            <td><img :src="'/'+ product.photo" width="100" alt=""></td>
                            <td>{{ product.product_name }}</td>
                            <td>{{ product.product_code }}</td>
                            <td>{{ product.category.category_name }}</td>
                            <td>{{ product.supplier.name }}</td>
                            <td>{{ product.buying_price }}</td>
                            <td>{{ product.selling_price }}</td>
                            <td>{{ product.buying_date }}</td>
                            <td>
                                <router-link :to="{name: 'products-edit', params: {id: product.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                                <a @click.prevent="deleteProduct(product.id)" href="#" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer"></div>
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
    },
    name: "Index",
    data(){
        return {
            products: [],
            searchText: ''
        }
    },
    computed: {
      showAllProducts(){
          return this.products.filter(item => {
              return item.product_name.toLowerCase().match(this.searchText.toLowerCase())
          })
      }
    },
    methods: {
        allProducts(){
            axios.get('/api/products')
            .then(res => {
                this.products = res.data
            })
            .catch(e => {
                console.log(e.response)
            })
        },
        deleteProduct(id){
            Message.DeleteAction()
            .then(res => {
               if (res.isConfirmed){
                   axios.delete('/api/products/' + id)
                   .then(res => {
                       this.products = this.products.filter(item => {
                           return item.id !== id
                       })
                       Message.Success(res.data)
                   })
                   .catch(e => {
                       if (e.response.status === 404){
                           Message.Error('Not Found')
                       }
                   })
               }
            })
        }
    }
}
</script>

<style scoped>

</style>
