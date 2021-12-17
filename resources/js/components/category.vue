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
    };
  },
  created() {
    this.fetchTasks(); // define method name for without load page
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
  },
};
</script>