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
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (Today)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">$ {{ todayIncome }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span>Since last month</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Sales</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ todaySell }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                    <span>Since last years</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Due Amount (Today)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ todayIncome }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                    <span>Since yesterday</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Expense Amount (Today)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ todayExpense }}</div>
                                <div class="mt-2 mb-0 text-muted text-xs">
                                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                    <span>Since yesterday</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-warning"></i>
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
        if (!User.loggedIn()){
            this.$router.push({path: '/'})
        }
    },
    name: "Dashboard",
    data(){
        return {
            todaySell: '',
            todayIncome: '',
            todayDue: '',
            todayExpense: '',
        }
    },
    mounted() {
        this.getTodaySell()
        this.getTodayIncome()
        this.getTodayDue()
        this.getTodayExpense()
    },
    methods:{
        getTodaySell()
        {
            axios.get('/api/today/sell')
            .then(res => {
                this.todaySell = res.data
            })
            .catch(e => {
                console.log(e.response)
            })
        },
        getTodayIncome()
        {
            axios.get('/api/today/income')
            .then(res => {
                console.log(res)
                this.todayIncome = res.data
            })
            .catch(e => {
                console.log(e.response)
            })
        },
        getTodayDue()
        {
            axios.get('/api/today/due')
            .then(res => {
                this.todayDue = res.data
            })
            .catch(e => {
                console.log(e.response)
            })
        },
        getTodayExpense()
        {
            axios.get('/api/today/expense')
            .then(res => {
                this.todayExpense = res.data
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
