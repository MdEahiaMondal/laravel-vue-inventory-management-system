<template>
    <div>
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">All Month</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Dashboard</router-link></li>
                <li class="breadcrumb-item">Month</li>
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
                        <h6 class="m-0 font-weight-bold text-primary">Employees</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Month</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(month, index) in salaryMonths">
                                <td>{{ index }}</td>
                                <td class="text-right">
                                    <router-link :to="{name: 'salaries-month-wise-show', params: {month: index }}" class="btn btn-sm btn-primary">Pay Salary</router-link>
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
        this.allSalaryMonth()
    },
    name: "AllSalary",
    data(){
        return {
            salaryMonths: [],
            searchText: ''
        }
    },
    methods: {
        allSalaryMonth(){
            axios.get('/api/salaries')
                .then(res => {
                    this.salaryMonths = res.data
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
