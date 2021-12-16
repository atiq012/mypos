<template>
<div class="container">

  <div class="row">
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto mt-5">
      <div class="card border-0 shadow rounded-3 my-5">
        <div class="card-body p-4 p-sm-5">
          <h5 class="card-title text-center mb-5 fs-2">Sign In</h5>
          <form @submit="formSubmit">
            
            <div class="form-floating mb-3">
              <input type="email" class="form-control" name="email" v-model="email" id="floatingInput" placeholder="name@example.com"/>
              <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" v-model="password" class="form-control" id="floatingPassword" placeholder="Password" />
              <label for="floatingPassword">Password</label>
            </div>

            
            <div class="d-grid">
              <button  class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">
                Sign in <span v-if="isLoading" class="spinner-border spinner-sm" style="margin: -9px 7px"></span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</template>
<script>
import Vue from 'vue';
import 'sweetalert2/dist/sweetalert2.min.css';
export default {
    data() {
        return {
            email: '',
            password: '',
            isLoading: false,
        }
    },
    
    methods:{
        formSubmit(e) {
            this.isLoading = true;
            e.preventDefault();  
            let currentObj = this;
            axios.post('/login', {  
                email: this.email,  
                password: this.password  
            }).then(response=>{                
                window.location.href = 'admin/dashboard';
            }).catch(error =>{
              this.isLoading = false;
                this.$swal('Credential is not valid.');
                
            })
        }
    }
};
</script>