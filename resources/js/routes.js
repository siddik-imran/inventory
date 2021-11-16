
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;
// end Authentication

//dashboard component
let home = require('./components/home.vue').default;

//employee component
import StoreEmployee from './components/employee/create.vue'
import EmployeeList from './components/employee/index.vue'
import EditEmployee from './components/employee/edit.vue'

//supplier component
import StoreSupplier from './components/supplier/create.vue'
import SupplierList from './components/supplier/index.vue'
import EditSupplier from './components/supplier/edit.vue'

//category component
import StoreCategory from './components/category/create.vue'
import CategoryList from './components/category/index.vue'
import EditCategory from './components/category/edit.vue'

//product component
import StoreProduct from './components/product/create.vue'
import ProductList from './components/product/index.vue'
import EditProduct from './components/product/edit.vue'

//customer component
import StoreCustomer from './components/customer/create.vue'
import CustomerList from './components/customer/index.vue'
import EditCustomer from './components/customer/edit.vue'

//expense component
import StoreExpense from './components/expense/create.vue'
import ExpenseList from './components/expense/expense.vue'
import EditExpense from './components/expense/edit.vue'

//salary component
import GivenSalary from './components/salary/all_employee.vue'
import PaySalary from './components/salary/create.vue'
import SalaryList from './components/salary/index.vue'
import ViewSalary from './components/salary/view.vue'
import EditSalary from './components/salary/edit.vue'

//stock component
import Stock from './components/product/stock.vue'
import EditStock from './components/product/edit_stock.vue'

//pos component
import Pos from './components/pos/pointOfSale.vue'

//order
import Order from './components/order/order.vue'
import ViewOrder from './components/order/view_order.vue'
import SearchOrder from './components/order/search_order.vue'


export const routes = [
    { path: '/', component: login, name:'/' },
    { path: '/register', component: register, name:'register' },
    { path: '/forget', component: forget, name:'forget' },
    { path: '/logout', component: logout, name:'logout' },

    { path: '/home', component: home, name:'home' },

    // Employee route
    { path: '/store-employee', component: StoreEmployee, name:'StoreEmployee' },
    { path: '/employee', component: EmployeeList, name:'EmployeeList' },
    { path: '/edit-employee/:id', component: EditEmployee, name:'EditEmployee' },

    // Supplier route
    { path: '/store-supplier', component: StoreSupplier, name:'StoreSupplier' },
    { path: '/supplier', component: SupplierList, name:'SupplierList' },
    { path: '/edit-supplier/:id', component: EditSupplier, name:'EditSupplier' },

    // category route
    { path: '/store-category', component: StoreCategory, name:'StoreCategory' },
    { path: '/category', component: CategoryList, name:'CategoryList' },
    { path: '/edit-category/:id', component: EditCategory, name:'EditCategory' },

    // product route
    { path: '/store-product', component: StoreProduct, name:'StoreProduct' },
    { path: '/product', component: ProductList, name:'ProductList' },
    { path: '/edit-product/:id', component: EditProduct, name:'EditProduct' },

    // customer route
    { path: '/store-customer', component: StoreCustomer, name:'StoreCustomer' },
    { path: '/customer', component: CustomerList, name:'CustomerList' },
    { path: '/edit-customer/:id', component: EditCustomer, name:'EditCustomer' },

    // expense route
    { path: '/store-expense', component: StoreExpense, name:'StoreExpense' },
    { path: '/expense', component: ExpenseList, name:'ExpenseList' },
    { path: '/edit-expense/:id', component: EditExpense, name:'EditExpense' },

    // salary route
    { path: '/given-salary', component: GivenSalary, name:'GivenSalary' },
    { path: '/pay-salary/:id', component: PaySalary, name:'PaySalary' },
    { path: '/salary', component: SalaryList, name:'SalaryList' },
    { path: '/view-salary/:id', component: ViewSalary, name:'ViewSalary' },
    { path: '/edit-salary/:id', component: EditSalary, name:'EditSalary' },

    // stock route
    { path: '/stock', component: Stock, name:'Stock' },
    { path: '/edit-stock/:id', component: EditStock, name:'EditStock' },

    // stock route
    { path: '/pos', component: Pos, name:'Pos' },

    // order route
    { path: '/latest-order', component: Order, name:'Order' },
    { path: '/view-order/:id', component: ViewOrder, name:'ViewOrder' },
    { path: '/search-order', component: SearchOrder, name:'SearchOrder' },



];
