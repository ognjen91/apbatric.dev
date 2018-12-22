<template lang="html">
<div class="row aboutUsPageEdit">
  <div class="col-12">

      <h2>Stranica o nama</h2>


    <div class="errors" v-if='errors'>
      <ul>
        <li v-for="(fieldError, fieldName) in errors" :key="fieldName" class="alert alert-danger">
          {{fieldError.join('\n')}}
        </li>
      </ul>
    </div>

      <hr>

       <!-- //sama tabela za izmjene -->
       <form @submit.prevent='sendData' enctype="multipart/form-data">
         <div class="form-group">

           <label><h4>Tekst stranice</h4></label>
           <VueTrix v-model="about.sr" />

         </div>

         <div class="form-group">
           <label><h4>Tekst stranice na engleskom</h4></label>
           <VueTrix v-model="about.en" />
         </div>

         <div class="form-group">
           <label><h4>Tekst stranice na ruskom</h4></label>
           <VueTrix v-model="about.ru" />

         </div>

         <div class="submit_n_succes">
           <input type="submit" class="btn btn-primary" value="Sačuvaj">

         </div>
       <div class="create_room_success alert alert-success" v-if='success'>
          Sačuvano!
       </div>
     </form>

  </div>
</div>
</template>

<script>

import VueTrix from 'vue-trix'
export default {
  components : {
VueTrix

  },
  data(){
    return {
      about : null,
      success : null,
      errors : null
    }

  },

  methods : {
    konzoluj(){
      console.log(this.about);
    },

    sendData(){

      var router = this.$router;
      axios.post('/api/about/update', {about: this.about})
      .then(
        (response) => {
          this.success = response.data.message;

          setTimeout(function(){
            router.push({name: "adminAbout"});
          }, 3000)
        }
        ,
        (error) => {
          if(error.response.status == 422){
            this.errors = error.response.data.errors;
          }
          if(error.response.status ==  500){
            this.success = error.response.data.message;
          }
        }
      )
      .catch((error) => {
        console.log(error);
         this.success = error.data.message;
      }
    )
    }
  },

  mounted(){

    axios.get('/api/about')
    .then((response)=>{
        this.about = JSON.parse(response.data.text);
     // console.log(response.data.text);
    })

  },


  computed : {


  }

}
</script>

<style lang="css">
</style>
