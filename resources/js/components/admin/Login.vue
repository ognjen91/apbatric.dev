<template lang="html">
  <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">ADMIN LOG IN</h5>
            <form class="form-signin" @submit.prevent='auth'>
              <div class="form-label-group">
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus v-model="credentials.email">
                <label for="inputEmail">Email adresa</label>
              </div>

              <div class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required v-model="credentials.password">
                <label for="inputPassword">Lozinka</label>
              </div>


              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Pijavi me!</button>
              <div class="alert alert-danger" role="alert" v-if="loginError">
                 {{ loginError }}
              </div>
              <hr class="my-4">
            </form>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import {login} from '../../helpers/auth';
export default {
  data(){
    return {
      credentials : {
        "email" : "",
        "password" : ""
      }
    }
  },
  methods : {
    auth(){
      // console.log(this.credentials);
      // // return;
      this.$store.dispatch('login');

       login(this.credentials)
       .then((res)=>{
         this.$store.commit('loginSuccess', res);
         this.$router.push({ name : "adminDashboard"})
       }).
       catch((error)=>{
         this.$store.commit('loginFailed', {error})
       })
    }
  },

  computed : {
    loginError(){
      return this.$store.getters.authError;

    }
  }
}
</script>

<style lang="css">
</style>
