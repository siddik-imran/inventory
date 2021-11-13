<template>
    <div>
        <div class="row">
            <router-link to="/store-product" class="btn btn-primary"> Add New</router-link>
        </div>
        <br>
        <input type="text" class="form-control" style="width:300px;" v-model="search_term" placeholder="Search ....">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Ctaegory</th>
                        <th>Supplier</th>
                        <th>Buying Price</th>
                        <th>Selling Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="product in filterProduct" :key="product.id">
                        <td><img :src="product.product_image" alt="" id="em_photo"></td>
                        <td>{{product.product_name}}</td>
                        <td>{{product.category.category_name}}</td>
                        <td>{{product.supplier.name}}</td>
                        <td>{{product.buying_price}}</td>
                        <td>{{product.selling_price}}</td>
                        <td>
                            <router-link :to="{name: 'EditProduct', params: {id:product.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                            <a @click="deleteProduct(product.id)" class="btn btn-sm btn-danger text-white">Delete</a>
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
            products:[],
            search_term: ''
        }
    },
    computed:{
        filterProduct(){
            return this.products.filter(product => {
                return product.product_name.match(this.search_term)
            })
        }
    },

    // this method will be call when the page is loading
    created(){
        if(!User.loggedIn()){
            this.$router.push({ name: '/' });
        }
        this.allProduct();
    },

    methods:{
        allProduct(){
            axios.get('/api/product/')
            .then(({data}) => (this.products = data))
            .catch((err) => {

            });
        },
        deleteProduct(id){
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

                    axios.delete('/api/product/'+id)
                    .then(() => {
                        this.products = this.products.filter(product => {
                            return product.id != id
                        })
                    })
                    .catch(() => {
                        this.$router.push({name: 'ProductList'});
                    })

                    Swal.fire(
                    'Deleted!',
                    'Product has been deleted.',
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
