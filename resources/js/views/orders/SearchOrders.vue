<template>
    <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-center mb-0 text-gray-800">Search  Orders</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Dashboard</router-link></li>
            <li class="breadcrumb-item">Orders</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="row">
                <div class="col-12">
                    <input @change="searchWithDate" v-model="date" type="date" class="form-control">
                </div>
            </div>
            <br>
            <div class="card" v-if="orders.length > 0">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Results</h6>
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
                        <tr v-for="(order, index) in orders" :key="order.id">
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
    name: "Index",
    data(){
        return {
            orders: [],
            date: ''
        }
    },
    methods: {
        searchWithDate(){
            axios.get('/api/order/search/'+this.date)
                .then(res => {
                    if (res.data.length > 0){
                        this.orders = res.data
                    }else{
                        this.orders = []
                        Message.Warning('Not Found')
                    }
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
