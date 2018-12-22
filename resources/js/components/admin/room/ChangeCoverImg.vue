<template lang="html">

  <div class="row editRoom">
    <div class="col-12 adminNavLink">
      <router-link :to="{ name: 'editRoom', params: {id:$route.params.id} }">
        Nazad na stranicu sobe
      </router-link>
    </div>

   <div class="col-12 col-sm-12 col-md-6  col-lg-6 col-xl-6 " v-if='room'>
     <h2>Trenutna slika zaglavlja</h2>
     <div class="ch_current_profile">
      <img :src="'/images/covers/' + room.cover_img" alt="">
    </div>
   </div>

   <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
     <h3>Odabir nove slike zaglavlja</h3>
     <div class="ch_choose_profile"   v-if='room'>
       <form v-if="room.room_cover_images.length" @submit.prevent='changeCover' enctype="multipart/form-data">
         <table>
           <tr>
             <th>slika</th>
             <th>postavi za aktivnu</th>
           </tr>
           <tr>
             <td class="ch_listed_imgs"><img src="/images/covers/cover.jpg"alt=""></td>
             <td><input value="cover.jpg" type="radio" name="pot_profile" v-model="selectedImage"></td>
           </tr>
           <tr v-for="img in room.room_cover_images">
             <td class="ch_listed_imgs"><img :src="'/images/covers/' + img.name" alt=""></td>
             <td class='newProfileRadio'><input :value="img.name" type="radio" name="pot_profile" v-model="selectedImage"></td>
           </tr>
         </table>
         <input type="submit" class="btn btn-primary ch_submit_img" value="Prihvati izmjenu">
       </form>
       <h3 v-else>Niste dodali nijednu sliku pozadine za  smještajnu jedinicu {{room.name.sr}} !</h3>

       </div>
   </div>

  </div>
</template>

<script>
export default {
  data(){
    return {
      room : null,
      selectedImage : '1.jpg'
    }
  },

  created(){
    if(this.rooms.length){
      this.room = this.rooms.find((pot_room)=> pot_room.id == this.$route.params.id)
    }else{
    axios.get('/api/room/' + this.$route.params.id)
    .then((response)=>{
        this.room = response.data.room[0];
        this.selectedImage = response.data.room[0].profile_img;
    })
  }
  },

  computed : {
    rooms(){
      return this.$store.getters.getRooms;
    }
  },

  methods : {
    changeCover(){
      var router = this.$router;
      axios.post('/api/rooms/change_cover/'+this.room.id,
       {
         selectedImage : this.selectedImage
      })
      .then(
        (response) => {
          // this.success = response.data.message;
          router.push({name: "editRoom", params : { id : this.$route.params.id }});

        }
        ,
        (error) => {
          if(error.response.status == 422){
            // this.errors = error.response.data.errors;
          }
        }
)
      .catch((error) => {

      }
    )
    }
  }
}
</script>

<style lang="css">
</style>
