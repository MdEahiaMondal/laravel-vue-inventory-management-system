<template>
    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Supplier Edit</h6>
                </div>
                <div class="card-body">
                    <form @submit.prevent="supplierUpdate" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" v-model="supplier.name" class="form-control" id="name">
                                    <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="Email">Email</label>
                                    <input type="email" v-model="supplier.email" class="form-control" id="Email">
                                    <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="Phone">Phone</label>
                                    <input type="text" v-model="supplier.phone" class="form-control" id="Phone">
                                    <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="Salary">Shop Name</label>
                                    <input type="text" v-model="supplier.shop_name" class="form-control" id="Salary">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="address">Address</label>
                                    <textarea  class="form-control" v-model="supplier.address" id="address"></textarea>
                                    <small class="text-danger" v-if="errors.address">{{ errors.address[0] }}</small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="custom-file">
                                        <input @change="fileUpload"  type="file" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img ref="editPhotoSrc" v-if="edit" :src="'/' +supplier.photo" style="width: 80px; height: 80px" alt="image">
                                    <img ref="editPhotoSrc" v-else :src="supplier.photo" style="width: 80px; height: 80px" alt="image">
                                </div>
                            </div>
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
        axios.get('/api/suppliers/'+ this.$route.params.id)
        .then(res => {
            this.supplier = res.data
        })
    },
    name: "Create",
    data(){
        return {
            supplier: {
                name: '',
                email: '',
                phone: '',
                shop_name: '',
                address: '',
                photo: '',
            },
            errors: [],
            edit: true
        }
    },
    methods: {
        fileUpload(event)
        {
            const real_file = event.target.files[0]
            if (real_file.size > 1040770){
                Message.Error('Please select image file size less then 1 MB')
            }else{
                let reader = new FileReader()
                reader.onload = (event) => {
                    this.edit = false
                    this.supplier.photo = event.target.result
                }
                reader.readAsDataURL(real_file)
            }
        },
        supplierUpdate()
        {
            axios.patch('/api/suppliers/' + this.$route.params.id, this.supplier)
            .then(res => {
                Message.Success(res.data)
                this.$router.push({name: 'suppliers'})
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
