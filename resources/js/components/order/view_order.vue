<template>
    <div>
        <div class="row">
            <router-link to="/order" class="btn btn-primary"> Back</router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Customer Details</h6>
                                    </div>
                                    <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Order ID</th>
                                            <th>Customer</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <tr>
                                            <td>#00{{orders.id}}</td>
                                            <td>{{orders.customer.name}}</td>
                                            <td>{{orders.customer.phone}}</td>
                                            <td>{{orders.customer.address}}</td>

                                        </tr>

                                        </tbody>
                                    </table>
                                    </div>
                                    <div class="card-footer"></div>
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="card">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Cost Details</h6>
                                    </div>
                                    <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Sub Total</th>
                                            <th>VAT</th>
                                            <th>Total</th>
                                            <th>Pay Amount</th>
                                            <th>Due Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{orders.sub_total}} $</td>
                                            <td>{{orders.vat}} %</td>
                                            <td>{{orders.total}} $</td>
                                            <td>{{orders.pay}} $</td>
                                            <td>{{orders.due}} $</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                    <div class="card-footer"></div>
                                </div>

                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                                <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                                    </div>
                                    <div class="table-responsive">
                                    <table class="table align-items-center table-flush">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Product Image</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Product Code</th>
                                            <th>Purchase Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="detail in orders_details" :key="detail.id">
                                            <td>{{detail.product.product_name}}</td>
                                            <td><img :src="'/'+detail.product.product_image" alt="" id="em_photo"></td>
                                            <td>{{detail.product_quantity}}</td>
                                            <td>{{detail.product.selling_price}} $</td>
                                            <td>{{detail.product.product_code}}</td>
                                            <td>{{detail.created_at}}</td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    </div>
                                    <div class="card-footer"></div>
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
            orders: {},
            orders_details:{}
        }
    },
    methods:{



    },
    // this method will be call when the page is loading
    created(){
        if(!User.loggedIn()){
            this.$router.push({ name: '/' });
        }
        let id = this.$route.params.id
        axios.get('/api/order/orders/'+id)
        .then(({data}) => (this.orders = data))
        .catch(console.log('error'))

        axios.get('/api/order/order-details/'+id)
        .then(({data}) => (this.orders_details = data))
        .catch(console.log('error'))

    },

}
</script>

<style type="text/css">
 #em_photo{
        width: 40px;
        height: 40px;
        border-radius: 5px;
    }
</style>
