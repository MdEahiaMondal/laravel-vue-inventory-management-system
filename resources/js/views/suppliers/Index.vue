<template>
    <div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Suppliers</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><router-link :to="{name: 'dashboard'}">Dashboard</router-link></li>
            <li class="breadcrumb-item">Suppliers</li>
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
                    <h6 class="m-0 font-weight-bold text-primary">Suppliers</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th>SI</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Shop Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(supplier, index) in allSuppliers" :key="supplier.id">
                            <td>{{ index + 1 }}</td>
                            <td><img :src="'/'+ supplier.photo" width="100" alt=""></td>
                            <td>{{ supplier.name }}</td>
                            <td>{{ supplier.phone }}</td>
                            <td>{{ supplier.salary }}</td>
                            <td>{{ supplier.joining_date }}</td>
                            <td>
                                <router-link :to="{name: 'suppliers-edit', params: {id: supplier.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                                <a @click.prevent="deleteEmploy(supplier.id)" href="#" class="btn btn-sm btn-danger">Delete</a>
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
        this.getAllSuppliers()
    },
    name: "Index",
    data(){
        return {
            suppliers: [],
            searchText: ''
        }
    },
    computed: {
        allSuppliers(){
          return this.suppliers.filter(item => {
              return item.name.toLowerCase().match(this.searchText.toLowerCase())
          })
      }
    },
    methods: {
        getAllSuppliers(){
            axios.get('/api/suppliers')
            .then(res => {
                this.suppliers = res.data
            })
            .catch(e => {
                console.log(e.response)
            })
        },
        deleteEmploy(id){
            Message.DeleteAction()
            .then(res => {
               if (res.isConfirmed){
                   axios.delete('/api/suppliers/' + id)
                   .then(res => {
                       this.suppliers = this.suppliers.filter(item => {
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
