<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">All Salaries</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Dashboard</router-link></li>
                <li class="breadcrumb-item">Salaries</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Salaries</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>SI</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Amount</th>
                                <th>Payment date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(monthSalary, index) in monthWiseSalaries" :key="monthSalary.employ.id">
                                <td>{{ index + 1 }}</td>
                                <td><img :src="'/'+ monthSalary.employ.photo" width="100" alt=""></td>
                                <td>{{ monthSalary.employ.name }}</td>
                                <td>{{ monthSalary.employ.phone }}</td>
                                <td>{{ monthSalary.amount }}</td>
                                <td>{{ monthSalary.date }}</td>
                                <td>
                                    <router-link :to="{name: 'salaries-pay', params: {id: monthSalary.employ.id}}" class="btn btn-sm btn-primary">Pay Salary</router-link>
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
        this.getMonthWiseSalaries()
    },
    name: "MonthWiseSalaries",
    data(){
        return {
            monthWiseSalaries: [],
            searchText: ''
        }
    },
    computed: {
        allEmployes(){
            return this.employees.filter(item => {
                return item.name.toLowerCase().match(this.searchText.toLowerCase())
            })
        }
    },
    methods: {
        getMonthWiseSalaries(){
            axios.get('/api/salaries/month/'+this.$route.params.month)
                .then(res => {
                    this.monthWiseSalaries = res.data
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
