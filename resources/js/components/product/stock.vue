<template>
    <div>
        <div class="row">
            <router-link to="/store-product" class="btn btn-primary"> Add Product</router-link>
        </div>
        <br>
        <input type="text" class="form-control" style="width:300px;" v-model="search_term" placeholder="Search ....">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Stock</h6>
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
                        <th>Status</th>
                        <th>Quantity</th>
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
                        <td v-if="product.product_quantity >=1 ">
                            <span class="badge badge-success">Available</span>
                        </td>
                        <td v-else>
                            <span class="badge badge-danger">Stock out</span>
                        </td>
                        <td>{{product.product_quantity}}</td>
                        <td>
                            <router-link :to="{name: 'EditStock', params: {id:product.id}}" class="btn btn-sm btn-primary">Edit</router-link>
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
