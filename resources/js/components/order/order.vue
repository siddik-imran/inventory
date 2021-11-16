<template>
    <div>
        <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Latest Orders</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Customer Name</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                        <th>Pay Amount</th>
                        <th>Due Amount</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="order in orders" :key="order.id">
                        <td>{{order.customer.name}}</td>
                        <td>{{order.quantity}}</td>
                        <td>{{order.total}}</td>
                        <td>{{order.pay}}</td>
                        <td>{{order.due}}</td>
                        <td>
                            <router-link :to="{name: 'ViewOrder', params: {id:order.id}}" class="btn btn-sm btn-primary">View</router-link>
                        </td>

                      </tr>

                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
export default {
     data(){
        return {
            orders:[],
        }
    },
     // this method will be call when the page is loading
    created(){
        if(!User.loggedIn()){
            this.$router.push({ name: '/' });
        }
        this.allOrder();
    },
    computed:{

    },
    methods:{
        allOrder(){
            axios.get('/api/orders/')
            .then(({data}) => (this.orders = data))
            .catch((err) => {

            });
        },

    },



}
</script>

<style type="text/css">

</style>
