<template>
    <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Today Orders</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Dashboard</router-link></li>
            <li class="breadcrumb-item">Orders</li>
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
                    <h6 class="m-0 font-weight-bold text-primary">Today Orders</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th>SI</th>
                            <th>Name</th>
                            <th>Total Qty</th>
                            <th>Total</th>
                            <th>Pay Amount</th>
                            <th>Due Amount</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(order, index) in filterOrders" :key="order.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ order.customer.name }}</td>
                            <td>{{ order.total_qty }}</td>
                            <td>{{ order.total_amount }}</td>
                            <td>{{ order.pay_amount }}</td>
                            <td>{{ order.due_amount }}</td>
                            <td>
                                <router-link :to="{name: 'orders-details', params: {id: order.id}}" class="btn btn-sm btn-primary">View</router-link>
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
        this.getTodayOrders()
    },
    name: "Index",
    data(){
        return {
            orders: [],
            searchText: ''
        }
    },
    computed: {
        filterOrders(){
          return this.orders.filter(item => {
              return item.customer.name.toLowerCase().match(this.searchText.toLowerCase())
          })
      }
    },
    methods: {
        getTodayOrders(){
            axios.get('/api/order/today')
            .then(res => {
                this.orders = res.data
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
