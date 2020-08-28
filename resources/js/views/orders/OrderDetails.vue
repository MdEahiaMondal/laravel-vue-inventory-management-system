<template>
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="./">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>

        <div class="row mb-3">
            <!-- Area Chart -->
            <div class="col-xl-6 col-lg-7">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Customer Info</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group" v-if="order">
                            <li class="list-group-item">Name : {{ order.customer.name}}</li>
                            <li class="list-group-item">Email : {{ order.customer.email}}</li>
                            <li class="list-group-item">Phone : {{ order.customer.phone}}</li>
                            <li class="list-group-item">Address : {{ order.customer.address}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-6 col-lg-5">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Order Info</h6>
                    </div>
                    <div class="card-body">
                        <ul class="list-group" v-if="order">
                            <li class="list-group-item">Product Qty : {{ order.total_qty }}</li>
                            <li class="list-group-item">Sub Total : {{ order.sub_total }}</li>
                            <li class="list-group-item">Vat : {{ order.vat }}</li>
                            <li class="list-group-item">Total : {{ order.total_amount }}</li>
                            <li class="list-group-item">Pay Amount : {{ order.pay_amount }}</li>
                            <li class="list-group-item">Due Amount : {{ order.due_amount }}</li>
                            <li class="list-group-item">Payment By : {{ order.pay_by }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Invoice Example -->
            <div class="col-xl-12 col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>SI</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(detail,index) in order.order_details">
                                <td>{{ index + 1 }}</td>
                                <td><img width="100" :src="'/' + detail.product.photo" alt=""></td>
                                <td>{{ detail.product.product_name }}</td>
                                <td>{{ detail.product.product_code }}</td>
                                <td>{{ detail.product_qty }}</td>
                                <td>{{ detail.product_price }}</td>
                                <td>{{ detail.sub_total }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">{{ this.$route.params.id }}</div>
                </div>
            </div>
        </div>
        <!--Row-->
    </div>
</template>

<script>
export default {
    created() {
        this.getOrder()
    },
    name: "OrderDetails",
    data()
    {
        return {
            orderInfo: '',
            ordersDetails: []
        }
    },
    computed:{
        order(){
            return this.orderInfo
        },
    },
    mounted() {
        this.getOrder()
    },
    methods:{
        getOrder(){
            console.log(this.$route.params.id)
            axios.get('/api/orders/'+this.$route.params.id)
                .then(res => {
                    this.orderInfo = res.data
                })
                .catch(e => {
                    console.log(e.response)
                })
        }
    }
}
</script>

<style scoped>

</style>
