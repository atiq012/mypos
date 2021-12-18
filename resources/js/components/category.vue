<template>
  <div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Create Category</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">Home</li>
              <li class="breadcrumb-item active">Create Category</li>
            </ol>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-5">
          <div class="card">
            <div class="card-header">
              <h3>Create New Category</h3>
            </div>
            <form @submit="addNewCategory">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="Title">Category Title</label>
                      <input
                        type="text"
                        class="form-control"
                        id="title"
                        v-model="title"
                        placeholder="Enter Category Title"
                      />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="slig">Category Slug</label>
                      <input
                        type="text"
                        class="form-control"
                        id="slug"
                        v-model="slug"
                        placeholder="Enter Category Slug"
                      />
                    </div>
                  </div>
                  <div class="col-md-12"></div>
                </div>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit <span
                      v-if="isLoading"
                      class="spinner-border spinner-sm"
                      style="margin: -9px 7px"
                    ></span></button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-7">
          <div class="card">
            <div class="card-header">All Categories</div>
            <div class="card-body">
              <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-light table-striped table-hover">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Category Title</th>
                          <th scope="col">Slug</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="(category, index) in categories"
                          :key="index"
                        >
                          <th scope="row">{{ index + 1 }}</th>
                          <td>{{ category.title }}</td>
                          <td>{{ category.slug }}</td>
                          <td><button class="btn btn-sm btn-warning" @click="openModal(category.id)">Edit</button></td>
                          <!-- Modal -->
                            <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ update_list.title }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                    <form @submit="editCategory(update_list.id)">
                                    <div class="modal-body">
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="Title">Category Title</label>
                                              <input
                                                type="text"
                                                class="form-control"
                                                id="title"
                                                v-model="update_list.title"
                                               
                                                placeholder="Enter Category Title"
                                              />
                                            </div>
                                          </div>
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label for="slig">Category Slug</label>
                                              <input
                                                type="text"
                                                class="form-control"
                                                id="slug"
                                                
                                                v-model="update_list.slug"
                                                placeholder="Enter Category Slug"
                                              />
                                            </div>
                                          </div>
                                          <div class="col-md-12"></div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="sumit" class="btn btn-primary">Submit <span
                                                v-if="isLoadingEdit"
                                                class="spinner-border spinner-sm"
                                                style="margin: -9px 7px"
                                              ></span></button>
                                        </div>
                                    </div>
                                    </form>
                                  
                                </div>
                              </div>
                            </div>
                          <!--End Modal -->

                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      title: "",
      slug: "",
      categories: "",
      isLoading: false,
      update_list:'',
      isLoadingEdit: false
    };
  },
  
  created() {
    this.fetchTasks(); // define method name for call initial load
    this.editfetchTasks();
  },
  methods: {
    addNewCategory(e) {
      this.isLoading = true;
      e.preventDefault();
      let currentObj = this;
      axios
        .post("/api/create/category", {
          title: this.title,
          slug: this.slug,
          // post data to database
        })
        .then((response) => {
          this.isLoading = false;
          this.fetchTasks(); // fetch data without page load using method
          this.title = '';
          this.slug = '';
        })
        .catch((error) => {
          this.isLoading = false;
          this.$swal("Invalid.");
        });
    },
    fetchTasks() {
       axios.get("/api/category")
        .then((response) => {        
        this.categories = response.data;
        // fetch all categories in page load 1st time
      })
    },
    editfetchTasks() {
      axios.get("/api/category")
        .then((response) => {        
        this.categories = response.data;
        // fetch all categories in page load 1st time
      })
    },
    openModal(id) {
      axios.get("/api/category/" + id)
        .then((response) => (this.update_list = response.data));
      $("#EditModal").modal("show");
      this.myModal = true;
    },
    editCategory(category) {
      this.isLoadingEdit = true;
      let currentObj = this;
      // alert(this.update_list.slug);
      axios.put("/api/update/category/"+ category, {
          title: this.update_list.title,
          slug: this.update_list.slug,
          // post data to database
        })
        .then((response) => {
          this.isLoadingEdit = false;
          this.editfetchTasks(); // fetch data without page load using method
          
        })
        .catch((error) => {
          alert(error);
          this.isLoadingEdit = false;
          this.$swal("Invalid.");
        });
    },
  },
};
</script>