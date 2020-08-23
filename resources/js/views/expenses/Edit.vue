<template>
    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Expenses Edit</h6>
                </div>
                <div class="card-body">
                    <form @submit.prevent="expenseUpdate" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Amount</label>
                            <input type="text" v-model="expense.amount" class="form-control" id="name">
                            <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                        </div>
                        <div class="form-group">
                            <label for="expense_date">Date</label>
                            <input type="date" v-model="expense.expense_date" class="form-control" id="expense_date">
                            <small class="text-danger" v-if="errors.expense_date">{{ errors.expense_date[0] }}</small>
                        </div>
                        <div class="form-group">
                            <label for="details">Details</label>
                            <textarea v-model="expense.details" id="details" class="form-control"></textarea>
                            <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        axios.get('/api/expenses/'+ this.$route.params.id)
        .then(res => {
            this.expense = res.data
        })
    },
    name: "Create",
    data(){
        return {
            expense: {
                amount: '',
                expense_date: '',
                details: ''
            },
            errors: [],
            edit: true
        }
    },
    methods: {
        expenseUpdate()
        {
            axios.patch('/api/expenses/' + this.$route.params.id, this.expense)
            .then(res => {
                Message.Success(res.data)
                this.$router.push({name: 'expenses'})
            })
            .catch(e => {
                if (e.response.status === 422){
                    this.errors = e.response.data.errors
                }else{
                    console.log(e.response)
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
