
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

];
