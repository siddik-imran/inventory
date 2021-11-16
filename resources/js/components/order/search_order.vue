<template>
    <div>
        <div class="row">
            <router-link to="/latest-order" class="btn btn-primary"> Latest Order</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Search Order</h1>
                                    </div>
                                    <form class="user" @submit.prevent="searchOrder()">
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="exampleFormControlSelect1">Search By Date</label>
                                                    <input type="date" class="form-control" id="exampleInputFirstName"   v-model="date">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Search</button>
                                        </div>
                                    </form>

                                </div>
                                <div class="container-fluid" id="container-wrapper">
                                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                        <h1 class="h3 mb-0 text-gray-800">Order Details</h1>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                        <!-- Simple Tables -->
                                        <div class="card">
                                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                                            </div>
                                            <div class="table-responsive">
                                            <table class="table align-items-center table-flush">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Order No.</th>
                                                    <th>Customer</th>
                                                    <th>Quantity</th>
                                                    <th>Sub Total</th>
                                                    <th>VAT</th>
                                                    <th>Total</th>
                                                    <th>Pay Amount</th>
                                                    <th>Due Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr v-for="order in orders" :key="order.id">
                                                    <td>#00{{order.id}}</td>
                                                    <td>{{order.customer.name}}</td>
                                                    <td>{{order.quantity}}</td>
                                                    <td>{{order.sub_total}} $</td>
                                                    <td>{{order.vat}} $</td>
                                                    <td>{{order.total}} $</td>
                                                    <td>{{order.pay}} $</td>
                                                    <td>{{order.due}} $</td>
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
                                    <!---Container Fluid-->
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
            date: '',
            orders: {}

        }
    },
    methods:{
        searchOrder(){
            let data = {date:this.date}
            axios.post('/api/search-order/', data)
            .then(({data}) => (this.orders = data) )

            .catch(error =>this.errors = error.response.data.errors)
        },
    },
    // this method will be call when the page is loading
    created(){
        if(!User.loggedIn()){
            this.$router.push({ name: '/' });
        }
    },

}
</script>

<style type="text/css">

</style>
