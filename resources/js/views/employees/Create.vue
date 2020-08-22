<template>
    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Eploye Create</h6>
                </div>
                <div class="card-body">
                    <form @submit.prevent="employInsert" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="name">Name</label>
                                    <input type="text" v-model="employ.name" class="form-control" id="name">
                                </div>
                                <div class="col-md-6">
                                    <label for="Email">Email</label>
                                    <input type="email" v-model="employ.email" class="form-control" id="Email">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="Phone">Phone</label>
                                    <input type="text" v-model="employ.phone" class="form-control" id="Phone">
                                </div>
                                <div class="col-md-6">
                                    <label for="Salary">Salary</label>
                                    <input type="number" v-model="employ.salary" class="form-control" id="Salary">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="date">Joining Date</label>
                                    <input type="date" v-model="employ.joining_date" class="form-control" id="date">
                                </div>
                                <div class="col-md-6">
                                    <label for="NID">NID</label>
                                    <input type="text" v-model="employ.nid" class="form-control" id="NID">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label for="address">Address</label>
                                    <textarea  class="form-control" v-model="employ.address" id="address"></textarea>
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
                                    <img :src="employ.photo" style="width: 80px; height: 80px" alt="image">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "Create",
    data(){
        return {
            employ: {
                name: '',
                email: '',
                phone: '',
                salary: '',
                address: '',
                photo: '',
                nid: '',
                joining_date: ''
            },
            errors: []
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
                    this.employ.photo = event.target.result
                }
                reader.readAsDataURL(real_file)
            }
        },
        employInsert()
        {
            alert('ok')
        }
    }
}
</script>

<style scoped>

</style>
