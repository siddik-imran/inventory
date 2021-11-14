<template>
    <div>
        <div class="row">
            <router-link to="/store-expense" class="btn btn-primary"> Add New</router-link>
        </div>
        <br>
        <input type="text" class="form-control" style="width:300px;" v-model="search_term" placeholder="Search ....">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Details</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="expense in filterExpense" :key="expense.id">
                        <td>{{expense.expense_date}}</td>
                        <td>{{expense.amount}}</td>
                        <td>{{expense.detils}}</td>
                        <td>
                            <router-link :to="{name: 'EditExpense', params: {id:expense.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                            <button @click="deleteExpense(expense.id)" class="btn btn-sm btn-danger text-white">Delete</button>
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
            expenses:[],
            search_term: ''
        }
    },
     // this method will be call when the page is loading
    created(){
        if(!User.loggedIn()){
            this.$router.push({ name: '/' });
        }
        this.allExpense();
    },
    computed:{
        filterExpense(){
            return this.expenses.filter(expense => {
                return expense.expense_date.match(this.search_term)
            })
        }
    },
    methods:{
        allExpense(){
            axios.get('/api/expense/')
            .then(({data}) => (this.expenses = data))
            .catch((err) => {

            });
        },
        deleteExpense(id){
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

                    axios.delete('/api/expense/'+id)
                    .then(() => {
                        this.expenses = this.expenses.filter(expense => {
                            return expense.id != id
                        })
                    })
                    .catch(() => {
                        this.$router.push({name: 'ExpenseList'});
                    })

                    Swal.fire(
                    'Deleted!',
                    'Expense has been deleted.',
                    'success'
                    )
                }
            })
        }
    },



}
</script>

<style type="text/css">

</style>
