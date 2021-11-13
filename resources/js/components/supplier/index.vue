<template>
    <div>
        <div class="row">
            <router-link to="/store-supplier" class="btn btn-primary"> Add New</router-link>
        </div>
        <br>
        <input type="text" class="form-control" style="width:300px;" v-model="search_term" placeholder="Search ....">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Supplier List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Shop Name</th>
                        <th>address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="supplier in filterSupplier" :key="supplier.id">
                        <td><img :src="supplier.photo" alt="" id="em_photo"></td>
                        <td>{{supplier.name}}</td>
                        <td>{{supplier.phone}}</td>
                        <td>{{supplier.shop_name}}</td>
                        <td>{{supplier.address}}</td>
                        <td>
                            <router-link :to="{name: 'EditSupplier', params: {id:supplier.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                            <button @click="deleteSupplier(supplier.id)" class="btn btn-sm btn-danger text-white">Delete</button>
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
            suppliers:[],
            search_term: ''
        }
    },
     // this method will be call when the page is loading
    created(){
        if(!User.loggedIn()){
            this.$router.push({ name: '/' });
        }
        this.allSupplier();
    },
    computed:{
        filterSupplier(){
            return this.suppliers.filter(supplier => {
                return supplier.phone.match(this.search_term)
            })
        }
    },
    methods:{
        allSupplier(){
            axios.get('/api/supplier/')
            .then(({data}) => (this.suppliers = data))
            .catch((err) => {

            });
        },
        deleteSupplier(id){
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

                    axios.delete('/api/supplier/'+id)
                    .then(() => {
                        this.suppliers = this.suppliers.filter(supplier => {
                            return supplier.id != id
                        })
                    })
                    .catch(() => {
                        this.$router.push({name: 'SupplierList'});
                    })

                    Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
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
