<template>
    <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Categories</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Dashboard</router-link></li>
            <li class="breadcrumb-item">Categories</li>
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
                    <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th>SI</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(category, index) in allCategories" :key="category.id">
                            <td>{{ index + 1 }}</td>
                            <td>{{ category.category_name }}</td>
                            <td>
                                <router-link :to="{name: 'categories-edit', params: {id: category.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                                <a @click.prevent="deleteCategory(category.id)" href="#" class="btn btn-sm btn-danger">Delete</a>
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
        this.getAllCategories()
    },
    name: "Index",
    data(){
        return {
            categories: [],
            searchText: ''
        }
    },
    computed: {
        allCategories(){
          return this.categories.filter(item => {
              return item.category_name.toLowerCase().match(this.searchText.toLowerCase())
          })
      }
    },
    methods: {
        getAllCategories(){
            axios.get('/api/categories')
            .then(res => {
                this.categories = res.data
            })
            .catch(e => {
                console.log(e.response)
            })
        },
        deleteCategory(id){
            Message.DeleteAction()
            .then(res => {
               if (res.isConfirmed){
                   axios.delete('/api/categories/' + id)
                   .then(res => {
                       this.categories = this.categories.filter(item => {
                           return item.id !== id
                       })
                       Message.Success(res.data)
                   })
                   .catch(e => {
                       if (e.response.status === 404){
                           Message.Error('Not Found')
                       }
                   })
               }
            })
        }
    }
}
</script>

<style scoped>

</style>
