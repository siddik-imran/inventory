<template>
    <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">POS Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">POS</li>
            </ol>
          </div>

          <div class="row mb-3">
                <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>
                    <button class="btn btn-sm btn-info">Add Customer</button>
                </div>
               <!-- Invoice Example -->

                <div class="table-responsive" style="font-size:12px;">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                    <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Name</td>
                        <td>Udin </td>
                        <td>Nasi </td>
                        <td>total</td>
                        <td><a href="#" class="btn btn-sm btn-primary">X</a></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>Udin </td>
                        <td>Nasi </td>
                        <td>total</td>
                        <td><a href="#" class="btn btn-sm btn-primary">X</a></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td>Udin </td>
                        <td>Nasi </td>
                        <td>total</td>
                        <td><a href="#" class="btn btn-sm btn-primary">X</a></td>
                    </tr>

                    </tbody>
                </table>
                </div>
                <div class="card-footer">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Quantity:
                            <strong>56</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Sub Total:
                            <strong> $ 56</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            VAT:
                            <strong>5 %</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total:
                            <strong>500 $</strong>
                        </li>
                    </ul>
                    <br>
                    <form action="">
                        <label for="">Customer Name</label>
                        <select class="form-control" v-model="customer_id">
                            <option value="">Customer 1</option>
                            <option value="">Customer 2</option>
                        </select>
                        <label for="">Pay</label>
                        <input type="text" class="form-control" v-model="pay" required>

                        <label for="">Due</label>
                        <input type="text" class="form-control" v-model="due" required>

                        <label for="">Payment Method</label>
                        <select class="form-control" v-model="customer_id">
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>

                        </select>
                        <br>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>

                </div>
              </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-7 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                </div>

                <div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Product</a>
                        </li>
                        <li class="nav-item" v-for="category in categories" :key="category.id">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="categoriesProduct(category.id)">
                            {{ category.category_name }}</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="card-body">
                                <input type="text" class="form-control"  v-model="search_term" placeholder="Search ....">
                                <br>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filterProduct" :key="product.id">
                                        <a href="#">
                                            <div class="card mb-4" style="width: 8.5rem; height:14rem">
                                                <img :src="product.product_image" alt="" id="photo">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{product.product_name}}</h5>
                                                    <span class="badge badge-success" v-if="product.product_quantity >=1 ">Available {{product.product_quantity}}</span>
                                                    <span class="badge badge-danger" v-else>Stock out</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in categoriesProducts" :key="product.id">
                                        <a href="#">
                                            <div class="card mb-4" style="width: 8.5rem; height:14rem">
                                                <img :src="product.product_image" alt="" id="photo">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{product.product_name}}</h5>
                                                    <span class="badge badge-success" v-if="product.product_quantity >=1 ">Available {{product.product_quantity}}</span>
                                                    <span class="badge badge-danger" v-else>Stock out</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
</template>

<script type="text/javascript">
export default {
     data(){
        return {
            products:[],
            categoriesProducts:[],
            categories:[],
            search_term: ''
        }
    },
    computed:{
        filterProduct(){
            return this.products.filter(product => {
                return product.product_name.match(this.search_term)
            })
        },
    },

    // this method will be call when the page is loading
    created(){
        if(!User.loggedIn()){
            this.$router.push({ name: '/' });
        }
        this.allProduct();
        this.allCategory();
    },

    methods:{
        allProduct(){
            axios.get('/api/product/')
            .then(({data}) => (this.products = data))
            .catch((err) => {

            });
        },
        allCategory(){
            axios.get('/api/category/')
            .then(({data}) => (this.categories = data))
            .catch((err) => {

            });
        },
        categoriesProduct(id){
            axios.get('/api/getting/product/'+id)
            .then(({data}) => (this.categoriesProducts = data))
            .catch((err) => {

            });
        },

    },



}
</script>

<style type="text/css">
    #photo{
        width: 70px;
        height: 120px;
        margin: 0 auto;

    }
</style>
