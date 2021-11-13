<template>
    <div>
        <div class="row">
            <router-link to="/store-customer" class="btn btn-primary"> Add New</router-link>
        </div>
        <br>
        <input type="text" class="form-control" style="width:300px;" v-model="search_term" placeholder="Search ....">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="customer in filterCustomer" :key="customer.id">
                        <td><img :src="customer.photo" alt="" id="em_photo"></td>
                        <td>{{customer.name}}</td>
                        <td>{{customer.phone}}</td>
                        <td>{{customer.email}}</td>
                        <td>{{customer.address}}</td>
                        <td>
                            <router-link :to="{name: 'EditCustomer', params: {id:customer.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                            <a @click="deleteCustomer(customer.id)" class="btn btn-sm btn-danger text-white">Delete</a>
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
            customers:[],
            search_term: ''
        }
    },
    computed:{
        filterCustomer(){
            return this.customers.filter(customer => {
                return customer.phone.match(this.search_term)
            })
        }
    },

    // this method will be call when the page is loading
    created(){
        if(!User.loggedIn()){
            this.$router.push({ name: '/' });
        }
        this.allCustomer();
    },

    methods:{
        allCustomer(){
            axios.get('/api/customer/')
            .then(({data}) => (this.customers = data))
            .catch((err) => {

            });
        },
        deleteCustomer(id){
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    axios.delete('/api/customer/'+id)
                    .then(() => {
                        this.customers = this.customers.filter(customer => {
                            return customer.id != id
                        })
                    })
                    .catch(() => {
                        this.$router.push({name: 'CustomerList'});
                    })

                    Swal.fire(
                    'Deleted!',
                    'Customer has been deleted.',
                    'success'
                    )
                }
            })
        }
    },



}
</script>

<style type="text/css">
    #em_photo{
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }
</style>
