<template>
    <div>
        <div class="row">
            <router-link to="/store-category" class="btn btn-primary"> Add New</router-link>
        </div>
        <br>
        <input type="text" class="form-control" style="width:300px;" v-model="search_term" placeholder="Search ....">
        <br>
        <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Category List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Category Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="category in filterCategory" :key="category.id">
                        <td>{{category.category_name}}</td>
                        <td>
                            <router-link :to="{name: 'EditCategory', params: {id:category.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                            <button @click="deleteCategory(category.id)" class="btn btn-sm btn-danger text-white">Delete</button>
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
            categories:[],
            search_term: ''
        }
    },
     // this method will be call when the page is loading
    created(){
        if(!User.loggedIn()){
            this.$router.push({ name: '/' });
        }
        this.allCategory();
    },
    computed:{
        filterCategory(){
            return this.categories.filter(category => {
                return category.category_name.match(this.search_term)
            })
        }
    },
    methods:{
        allCategory(){
            axios.get('/api/category/')
            .then(({data}) => (this.categories = data))
            .catch((err) => {

            });
        },
        deleteCategory(id){
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

                    axios.delete('/api/category/'+id)
                    .then(() => {
                        this.categories = this.categories.filter(category => {
                            return category.id != id
                        })
                    })
                    .catch(() => {
                        this.$router.push({name: 'CategoryList'});
                    })

                    Swal.fire(
                    'Deleted!',
                    'Category has been deleted.',
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
