<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-dark table-striped table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Category Title</th>
              <th scope="col">Slug</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(category,index) in categories" :key="index">
              <th scope="row">{{ index + 1 }}</th>
              <td>{{ category.title }}</td>
              <td>{{ category.slug }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            categories: null
        }
    },
    mounted(){
        
        axios.get('/api/category').then(response=>{            
            this.categories = response.data
        })
        .catch(error =>{
          alert(error)
        });
    },
    
}
</script>