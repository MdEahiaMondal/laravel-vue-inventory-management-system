<template>
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form class="user" @submit.prevent="login">
                                        <div class="form-group">
                                            <input type="email" class="form-control" v-model="form.email" id="exampleInputEmail" aria-describedby="emailHelp"
                                                   placeholder="Enter Email Address">
                                            <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" v-model="form.password" class="form-control" id="exampleInputPassword" placeholder="Password">
                                            <small class="text-danger" v-if="errors.password">{{ errors.password[0]}}</small>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <router-link to="/register" class="font-weight-bold small">Create an Account!</router-link>
                                    </div>
                                    <div class="text-center">
                                        <router-link to="/forgot-password" class="font-weight-bold small">Forgot Password</router-link>
                                    </div>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    created() {
        if (User.loggedIn()){
            this.$router.push({name: 'dashboard'})
        }
    },
    name: "Login",
    data()
    {
        return {
            form: {
                email: 'mdeahiyakhan@gmail.com',
                password: 'password'
            },
            errors: []
        }
    },
    methods: {
        login()
        {
           axios.post('http://localhost:8000/api/auth/login', this.form)
            .then(res => {
                User.responseAfterLogin(res)
                this.$router.push({name: 'dashboard'})
                Message.Toaster('Signed in successfully', 'success')
            })
            .catch(e => {
                switch (e.response.status){
                    case 401:
                        Message.Toaster(e.response.data.error, 'error')
                        break;
                    case 422:
                        this.errors = e.response.data.errors
                        break
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
