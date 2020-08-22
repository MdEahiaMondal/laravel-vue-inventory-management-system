<template>
    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Category Edit</h6>
                </div>
                <div class="card-body">
                    <form @submit.prevent="categoryrUpdate" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="category_name">Name</label>
                            <input type="text" v-model="category.category_name" class="form-control" id="category_name">
                            <small class="text-danger" v-if="errors.category_name">{{ errors.category_name[0] }}</small>
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
        axios.get('/api/categories/'+ this.$route.params.id)
        .then(res => {
            this.category = res.data
        })
    },
    name: "Create",
    data(){
        return {
            category: {
                category_name: '',
            },
            errors: [],
            edit: true
        }
    },
    methods: {
        categoryrUpdate()
        {
            axios.patch('/api/categories/' + this.$route.params.id, this.category)
            .then(res => {
                Message.Success(res.data)
                this.$router.push({name: 'categories'})
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
