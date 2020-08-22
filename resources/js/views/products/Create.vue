<template>
    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Product Create</h6>
                </div>
                <div class="card-body">
                    <form @submit.prevent="productInsert" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" v-model="product.product_name" class="form-control" id="name">
                                    <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="code">Code</label>
                                    <input type="text" v-model="product.product_code" class="form-control" id="code">
                                    <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="Category">Category</label>
                                    <select  id="Category" v-model="product.category_id" class="form-control">
                                        <option value="" disable>Select Category</option>
                                        <option :value="category.id" v-for="(category, index) in categories" :key="category.id">{{ category.category_name }}</option>
                                    </select>
                                    <small class="text-danger" v-if="errors.category_id">{{ errors.category_id[0] }}</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="supplier">Supplier</label>
                                    <select  id="supplier" v-model="product.supplier_id" class="form-control">
                                        <option value="" disable>Select Supplier</option>
                                        <option :value="supplier.id" v-for="(supplier, index) in suppliers" :key="supplier.id">{{ supplier.name }}</option>
                                    </select>
                                    <small class="text-danger" v-if="errors.supplier_id">{{ errors.supplier_id[0] }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="Phone">Root</label>
                                    <input type="text" v-model="product.root" class="form-control" id="Phone">
                                    <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="Salary">Buying Price</label>
                                    <input type="number" v-model="product.buying_price" class="form-control" id="Salary">
                                    <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="date">Selling Price</label>
                                    <input type="number" v-model="product.selling_price" class="form-control" id="date">
                                    <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="NID">Buying Date</label>
                                    <input type="number" v-model="product.buying_date" class="form-control" id="NID">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="product_quantity">Product Quantity</label>
                                    <input type="number" v-model="product.product_quantity" class="form-control" id="product_quantity">
                                    <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="custom-file">
                                        <input @change="fileUpload"  type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img :src="product.photo" style="width: 80px; height: 80px" alt="image">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        this.getAllCategories()
        this.getAllSuppliers()

    },
    name: "Create",
    data(){
        return {
            product: {
                product_name: '',
                product_code: '',
                root: '',
                category_id: '',
                supplier_id: '',
                product_quantity: '',
                photo: '',
                buying_date: '',
                selling_price: ''
            },
            categories: [],
            suppliers: [],
            errors: []
        }
    },
    methods: {
        fileUpload(event)
        {
            const real_file = event.target.files[0]
            if (real_file.size > 1040770){
                Message.Error('Please select image file size less then 1 MB')
            }else{
                let reader = new FileReader()
                reader.onload = (event) => {
                    this.product.photo = event.target.result
                }
                reader.readAsDataURL(real_file)
            }
        },
        productInsert()
        {
            axios.post('/api/products', this.product)
            .then(res => {
                Message.Success(res.data)
                this.$router.push({name: 'products'})
            })
            .catch(e => {
                if (e.response.status === 422){
                    this.errors = e.response.data.errors
                }else{
                    console.log(e.response)
                }
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
        getAllSuppliers(){
            axios.get('/api/suppliers')
                .then(res => {
                    this.suppliers = res.data
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
