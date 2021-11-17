<template>
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
        </div>

        <div class="row mb-3" v-for="statement in statements" :key="statement.id">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4" >
            <div class="card h-100">
            <div class="card-body">
                <div class="row align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings History</div>
                    <div class="h6 mb-0 font-weight-bold text-gray-800">Total: ${{statement.total_earning}}</div>
                    <div class="mt-2 mb-0 text-muted text-xs">
                    <span class="text-success mr-2">Pay Amount: ${{statement.pay_amount}}</span><br>
                    <span class="text-danger mr-2">Due Amount: ${{statement.due_amount}}</span>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-primary"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Product Sales</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{statement.total_sells}}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-shopping-cart fa-2x text-success"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- New User Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Expense</div>
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800" v-for="expense in expenses" :key="">${{expense.total_expenses}}</div>
                    <div class="mt-2 mb-0 text-muted text-xs">

                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-info"></i>
                </div>
                </div>
            </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    <div class="mt-2 mb-0 text-muted text-xs">
                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                    <span>Since yesterday</span>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-comments fa-2x text-warning"></i>
                </div>
                </div>
            </div>
            </div>
        </div>

        <!-- Invoice Example -->
        <div class="col-xl-7 col-lg-7 mb-4">
            <div class="card">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Invoice</h6>
                <a class="m-0 float-right btn btn-danger btn-sm" href="#">View More <i
                    class="fas fa-chevron-right"></i></a>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Item</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td><a href="#">RA0449</a></td>
                    <td>Udin Wayang</td>
                    <td>Nasi Padang</td>
                    <td><span class="badge badge-success">Delivered</span></td>
                    <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                    </tr>
                    <tr>
                    <td><a href="#">RA5324</a></td>
                    <td>Jaenab Bajigur</td>
                    <td>Gundam 90' Edition</td>
                    <td><span class="badge badge-warning">Shipping</span></td>
                    <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                    </tr>
                    <tr>
                    <td><a href="#">RA8568</a></td>
                    <td>Rivat Mahesa</td>
                    <td>Oblong T-Shirt</td>
                    <td><span class="badge badge-danger">Pending</span></td>
                    <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                    </tr>
                    <tr>
                    <td><a href="#">RA1453</a></td>
                    <td>Indri Junanda</td>
                    <td>Hat Rounded</td>
                    <td><span class="badge badge-info">Processing</span></td>
                    <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                    </tr>
                    <tr>
                    <td><a href="#">RA1998</a></td>
                    <td>Udin Cilok</td>
                    <td>Baby Powder</td>
                    <td><span class="badge badge-success">Delivered</span></td>
                    <td><a href="#" class="btn btn-sm btn-primary">Detail</a></td>
                    </tr>
                </tbody>
                </table>
            </div>
            <div class="card-footer"></div>
            </div>
        </div>
        <!-- Pie Chart -->
        <div class="col-xl-5 col-lg-5">
            <div class="card mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Stock Out Products</h6>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" :key="product.id">
                    <td>{{product.product_name}}</td>
                    <td>{{product.product_code}}</td>
                    <td><span class="badge badge-danger">Stock out</span></td>
                    <td><router-link :to="{name: 'EditStock', params: {id:product.id}}" class="btn btn-sm btn-primary">Edit</router-link></td>
                    </tr>

                </tbody>
                </table>
            </div>
        </div>
        </div>

        </div>
        <!--Row-->

    </div>
</template>

<script type="text/javascript">
export default {
    data(){
        return {
            statements: [],
            expenses: '',
            products: []
        }
    },
    created(){
        if(!User.loggedIn()){
            this.$router.push({ name: '/' })
        }
        this.earningStatement();
        this.expenseStatement();
        this.stockOutProduct();
    },
    methods: {
        earningStatement(){
            axios.get('/api/earning-statement/')
            .then(({data}) => (this.statements = data))
            .catch(console.log('error'))
        },
        expenseStatement(){
            axios.get('/api/expense-statement/')
            .then(({data}) => (this.expenses = data))
            .catch(console.log('error'))
        },
        stockOutProduct()
        {
            axios.get('/api/stock-out-product/')
            .then(({data}) => (this.products = data))
            .catch(console.log('error'))
        }
    },

}
</script>

<style type="text/css">

</style>
