<template>
    <div>
        <div class="row">
            <router-link to="/store-employee" class="btn btn-primary"> Add New</router-link>
        </div>
        <br>
        <input type="text" class="form-control" style="width:300px;" v-model="search_term" placeholder="Search ....">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Employee List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Salary</th>
                        <th>Joining Date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="employee in filterEmployee" :key="employee.id">
                        <td><img :src="employee.photo" alt="" id="em_photo"></td>
                        <td>{{employee.name}}</td>
                        <td>{{employee.phone}}</td>
                        <td>{{employee.salary}}</td>
                        <td>{{employee.joining_date}}</td>
                        <td>
                            <router-link :to="{name: 'EditEmployee', params: {id:employee.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                            <a @click="deleteEmployee(employee.id)" class="btn btn-sm btn-danger text-white">Delete</a>
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
            employees:[],
            search_term: ''
        }
    },
    computed:{
        filterEmployee(){
            return this.employees.filter(employee => {
                return employee.phone.match(this.search_term)
            })
        }
    },

    // this method will be call when the page is loading
    created(){
        if(!User.loggedIn()){
            this.$router.push({ name: '/' });
        }
        this.allEmployee();
    },

    methods:{
        allEmployee(){
            axios.get('/api/employee/')
            .then(({data}) => (this.employees = data))
            .catch((err) => {

            });
        },
        deleteEmployee(id){
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

                    axios.delete('/api/employee/'+id)
                    .then(() => {
                        this.employees = this.employees.filter(employee => {
                            return employee.id != id
                        })
                    })
                    .catch(() => {
                        this.$router.push({name: 'EmployeeList'});
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
