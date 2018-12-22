<template lang="html">
  <div class="row">
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

      <form @submit.prevent='sendData' enctype="multipart/form-data">


               <div class="form-group">
                 <label for="a_room_name"><h4>Adresa</h4></label>
                 <input type="text" class='form-control' id="a_room_name" v-model="contact.adress">
               </div>

               <div class="form-group">
                 <label for="a_room_name_en"><h4>Telefon 1</h4></label>
                 <input type="text" class='form-control' id="a_room_name_en" v-model="contact.phone1">
               </div>

               <div class="form-group">
                 <label for="a_room_name_ru"><h4>Telefon 2</h4></label>
                 <input type="text" class='form-control' id="a_room_name_ru" v-model="contact.phone2">
               </div>

               <div class="form-group">
                 <label for="a_room_name_ru"><h4>Email</h4></label>
                 <input type="email" class='form-control' id="a_room_name_ru" v-model="contact.email">
               </div>

               <div class="form-group">
                 <label for="a_room_name_ru"><h4>skype</h4></label>
                 <input type="text" class='form-control' id="a_room_name_ru" v-model="contact.skype">
               </div>

               <div class="form-group">
                 <label for="a_room_name_ru"><h4>Facebook</h4></label>
                 <input type="text" class='form-control' id="a_room_name_ru" v-model="contact.facebook">
               </div>

               <div class="form-group">
                 <label for="a_room_name_ru"><h4>Instagram</h4></label>
                 <input type="text" class='form-control' id="a_room_name_ru" v-model="contact.instagram">
               </div>


         <div class="submit_n_succes">
           <input type="submit" class="btn btn-primary" value="Sačuvaj">
           <div class="create_room_success alert alert-success" v-if='success'>
              Sačuvano!
           </div>
         </div>

      </form>


    </div>
  </div>
</template>

<script>
export default {

  data(){
    return {
      success : null,
      errors : null
    }
  },

  methods : {
    sendData(){

      var router = this.$router;
      axios.post('/api/contact/update', this.contact)
      .then(
        (response) => {
          this.success = response.data.message;

          setTimeout(function(){
            router.push({name: "adminContact"});
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



  created(){
    this.$store.dispatch('getContact');

  },


  computed : {
    contact(){
      return this.$store.getters.getContact;
    }
  }
}
</script>

<style lang="css">
</style>
