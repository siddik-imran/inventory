<template>
    <div>
        <div class="row">
            <router-link to="/employee" class="btn btn-primary"> All Employee</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Pay Salary</h1>
                                    </div>
                                    <form class="user" @submit.prevent="salaryPay()" >
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Name</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Name"   v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Email</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail" placeholder="Enter Email"   v-model="form.email">
                                                    <small class="text-danger" v-if="errors.email"> {{ errors.email[0] }} </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Month</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" v-model="form.salary_month">
                                                        <option  value="January">January</option>
                                                        <option  value="February">February</option>
                                                        <option  value="March">March</option>
                                                        <option  value="April">April</option>
                                                        <option  value="May">May</option>
                                                        <option  value="June">June</option>
                                                        <option  value="July">July</option>
                                                        <option  value="August">August</option>
                                                        <option  value="September">September</option>
                                                        <option  value="October">October</option>
                                                        <option  value="November">November</option>
                                                        <option  value="December">December</option>
                                                    </select>
                                                    <small class="text-danger" v-if="errors.salary_month"> {{ errors.salary_month[0] }} </small>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Salary</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail" placeholder="Enter Salary"   v-model="form.salary">
                                                    <small class="text-danger" v-if="errors.salary"> {{ errors.salary[0] }} </small>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Pay Now</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
export default {
    data(){
        return{
            form:{
                name: '',
                email: '',
                salary: '',
                salary_month: ''

            },
            errors:{}
        }
    },
    methods:{
        salaryPay(){
            let id = this.$route.params.id
            axios.post('/api/salary/paid/'+id, this.form)
            .then(() => {
                this.$router.push({ name: 'GivenSalary' });
                Notification.success();
            })

            .catch(error =>this.errors = error.response.data.errors)
        },
    },
    // this method will be call when the page is loading
    created(){
        if(!User.loggedIn()){
            this.$router.push({ name: '/' });
        }
        let id = this.$route.params.id
        axios.get('/api/employee/'+id)
        .then(({data}) => (this.form = data))
        .catch(console.log('error'))
    },

}
</script>

<style type="text/css">

</style>
