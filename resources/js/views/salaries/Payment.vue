<template>
    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Employ Salary Pay</h6>
                </div>
                <div class="card-body">
                    <form @submit.prevent="salaryPay" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" v-model="salary.name" class="form-control" id="name">
                                    <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="Email">Email</label>
                                    <input type="email" v-model="salary.email" class="form-control" id="Email">
                                    <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="month">Month</label>
                                    <select  id="month" class="form-control" v-model="salary.month">
                                        <option disabled value="">Select Month</option>
                                        <option value="january">January</option>
                                        <option value="february">February</option>
                                        <option value="march">March</option>
                                        <option value="april">April</option>
                                        <option value="may">May</option>
                                        <option value="june">June</option>
                                        <option value="july">July</option>
                                        <option value="august">August</option>
                                        <option value="september">September</option>
                                        <option value="october">October</option>
                                        <option value="november">November</option>
                                        <option value="december">December</option>
                                    </select>
                                    <small class="text-danger" v-if="errors.month">{{ errors.month[0] }}</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="Salary">Salary</label>
                                    <input type="number" v-model="salary.salary" class="form-control" id="Salary">
                                    <small class="text-danger" v-if="errors.salary">{{ errors.salary[0] }}</small>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        axios.get('/api/employs/'+ this.$route.params.id)
        .then(res => {
            this.salary = res.data
        })
    },
    name: "Create",
    data(){
        return {
            salary: {
                name: '',
                email: '',
                salary: '',
                month: ''
            },
            errors: [],
            edit: true
        }
    },
    methods: {
        salaryPay()
        {
            axios.post('/api/salaries', this.salary)
            .then(res => {
                Message.Success(res.data)
                this.$router.push({name: 'salaries'})
            })
            .catch(e => {
                if (e.response.status === 422){
                    this.errors = e.response.data.errors
                }else{
                    Message.Warning(e.response.data)
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
