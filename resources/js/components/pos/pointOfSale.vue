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
                    <tr v-for="cart in carts" :key="cart.id">
                        <td>{{cart.product.product_name}}</td>
                        <td class="custom-td"><input type="text" readonly :value="cart.product_quantity" style="width:35px; text-align:center">
                            <button @click.prevent="increment(cart.id)" class="btn btn-sm btn-success btn-custom ">+</button>
                            <button @click.prevent="decrement(cart.id)" v-if="cart.product_quantity >= 2" class="btn btn-sm btn-danger btn-custom">-</button>
                            <button @click.prevent="decrement(cart.id)" v-else class="btn btn-sm btn-danger btn-custom" disabled>-</button>
                        </td>
                        <td>{{cart.product.selling_price}} </td>
                        <td>{{cart.sub_total}}</td>
                        <td><button @click.prevent="removeItem(cart.id)"  class="btn btn-sm btn-primary">X</button></td>
                    </tr>


                    </tbody>
                </table>
                </div>
                <div class="card-footer">
                    <ul class="list-group" v-for="vat in vats" :key="vat.id">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Quantity:
                            <strong>{{totalQuantity}}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Sub Total:
                            <strong>{{subTotal}} $</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center" >
                            VAT:
                            <strong>{{vat.vat}} %</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total:
                            <strong>{{subTotal*vat.vat/100 + subTotal}} $</strong>
                        </li>
                    </ul>
                    <br>
                    <form action="" @submit.prevent="order()">
                        <label for="">Customer Name</label>
                        <select class="form-control" v-model="customer_id">
                            <option :value="customer.id" v-for="customer in customers" :key="customer.id">{{customer.name}}</option>

                        </select>
                        <label for="">Pay Amount</label>
                        <input type="text" class="form-control" v-model="pay" required>

                        <label for="">Due Amount</label>
                        <input type="text" class="form-control" v-model="due" required>

                        <label for="">Payment Method</label>
                        <select class="form-control" v-model="payment_method">
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
                                        <button class="custom-btn" title="Add to Cart" @click.prevent="addToCart(product.id)">
                                            <div class="card mb-4" style="width: 8.5rem; height:14rem">
                                                <img :src="product.product_image" alt="" id="photo">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{product.product_name}}</h5>
                                                    <span class="badge badge-success" v-if="product.product_quantity >=1 ">Available {{product.product_quantity}}</span>
                                                    <span class="badge badge-danger" v-else>Stock out</span>
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in categoriesProducts" :key="product.id">
                                        <button class="custom-btn" title="Add to Cart" @click.prevent="addToCart(product.id)">
                                            <div class="card mb-4" style="width: 8.5rem; height:14rem">
                                                <img :src="product.product_image" alt="" id="photo">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{product.product_name}}</h5>
                                                    <span class="badge badge-success" v-if="product.product_quantity >=1 ">Available {{product.product_quantity}}</span>
                                                    <span class="badge badge-danger" v-else>Stock out</span>
                                                </div>
                                            </div>
                                        </button>
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
            search_term: '',

            customers: [],
            carts: [],
            vats: [],

            customer_id: '',
            pay: '',
            due: '',
            payment_method: ''
        }
    },
    computed:{
        filterProduct(){
            return this.products.filter(product => {
                return product.product_name.match(this.search_term)
            })
        },
        totalQuantity(){
            let sum = 0;
            for(let i = 0; i < this.carts.length; i++){
                sum += (parseFloat(this.carts[i].product_quantity));
            }
            return sum;
        },
        subTotal(){
            let sum = 0;
            for(let i = 0; i < this.carts.length; i++){
                sum += (parseFloat(this.carts[i].sub_total));
            }
            return sum;
        }
    },

    // this method will be call when the page is loading
    created(){
        if(!User.loggedIn()){
            this.$router.push({ name: '/' });
        }

        this.allProduct();
        this.allCategory();
        this.allCustomer();
        this.getCartProduct();
        // Reload.$on('afterAddtoCart', () => {
        //     this.getCartProduct()
        // });
        this.getVat();
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
          allCustomer(){
            axios.get('/api/customer/')
            .then(({data}) => (this.customers = data))
            .catch((err) => {

            });
        },
        addToCart(id){
            axios.get('/api/add-to-cart/'+id)
            .then(() => {
                //Reload.$emit('afterAddToCart');
                window.location.reload();
                Notification.cart_success();
            })
            .catch((err) => {

            });
        },
        getCartProduct(){
            axios.get('/api/cart/product/')
            .then(({data}) => (this.carts = data))
            .catch((err) => {

            });
        },
        removeItem(id){
            axios.get('/api/remove-cart/'+id)
            .then(() => {
                //Reload.$emit('afterAddToCart');
                window.location.reload();
                Notification.cart_remove();
            })
            .catch((err) => {

            });
        },
        increment(id){
            axios.get('/api/increment/'+id)
            .then(() => {
                //Reload.$emit('afterAddToCart');
                window.location.reload();
                Notification.success();
            })
            .catch((err) => {

            });

        },
        decrement(id){
            axios.get('/api/decrement/'+id)
            .then(() => {
                //Reload.$emit('afterAddToCart');
                window.location.reload();
                Notification.success();
            })
            .catch((err) => {

            });
        },
        getVat(){
            axios.get('/api/vat/')
            .then(({data}) => (this.vats = data))
            .catch((err) => {

            });
        },

        order(){
            let total = this.subTotal*0.05 + this.subTotal;
            let data = {
                quantity:this.totalQuantity, sub_total:this.subTotal, customer_id:this.customer_id, pay:this.pay,
                due:this.due, vat:5, payment_method:this.payment_method, total:total
            }
            axios.post('/api/order/', data)
            .then(() => {
                Notification.success();
                window.location.reload();
            })
        }



    },



}
</script>

<style type="text/css">
    #photo{
        width: 100%;
        height: 112px;
        margin: auto;
    }
    .custom-btn{
        border: none;
        background: none !important;
    }
    .btn-custom{
        height: 1.7rem;
        font-weight: bolder;
    }


</style>
