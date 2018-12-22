<template lang="html">
  <div class="upload_imgs">

    <div class="col-12  editRoomSectionTitle">
      <h2 class="titleBigger">Slike</h2>
    </div>

       <div class="ui_wrap">

         <div class="ui_profile_img">
           <h5>Profilna slika sobe <router-link :to="{ name: 'changeProfileImg', params: { id : room.id } }" class='btn btn-primary' tag="a">Promjenite</router-link></h5>
           <div>
             <img :src="'/images/rooms/' + room.profile_img" alt="">
           </div>
           <hr>
         </div>



           <form @submit.prevent="onUpload" enctype="multipart/form-data" class="new_img_form">
             <div class="form-group">
               <label for="exampleFormControlFile1" @click="showUploadProfile" style='display:flex'><h5>Dodajte novu sliku sobe</h5><div class='showUpload'><img src="/images/down.png" alt=""></div></label>
               <div id="uploadProfile">
               <input @change="onFileChange" type="file" class="form-control-file" id="exampleFormControlFile1">
               <button type="submit" class="btn btn-default add_new_room_image">Ubaci!</button>
             </div>
             </div>
           </form>

           <form @submit.prevent="onCoverUpload" enctype="multipart/form-data" class="new_img_form">
             <div class="form-group">
               <label for="exampleFormControlFile1" @click="showUploadCover" style='display:flex'>
                 <h5 >Dodajte novu sliku pozadine <br><small>Slika treba da ima veću širinu nego visinu</small></h5>
                 <div class='showUpload'><img src="/images/down.png" alt="">

               </div>

             </label>
               <div id="uploadCover">
               <input @change="onCoverChange" type="file" class="form-control-file" id="exampleFormControlFile1">
               <button type="submit" class="btn btn-default add_new_room_image">Ubaci!</button>
             </div>
             </div>
           </form>



           <h5>Postojeće slike sobe</h5>
        <div class="ui_existing_imgs" v-if='room.room_images.length'>

            <table>
              <tr>
                <th>Slika</th>
                <th>Izbriši</th>
              </tr>
              <tr v-for='image in room.room_images' class='ui_imgs'>
                <td class="ui_listed_img"><img :src="'/images/rooms/' + image.name" alt=""></td>
                <td @click="deleteRoomPhoto(image.id)"><i class="fas fa-times-circle"></i></td>
              </tr>
            </table>
        </div>

        <div v-else><h3>Niste dodali nijednu sliku sobe</h3></div>

        <hr>

        <h5>Postojeće slike za pozadinu</h5>
        <div class="ui_existing_imgs" v-if='room.room_cover_images.length'>

            <table>
              <tr>
                <th>Slika</th>
                <th>Izbriši</th>
              </tr>
              <tr v-for='image in room.room_cover_images' class='ui_imgs'>
                <td class="ui_listed_img"><img :src="'/images/covers/' + image.name" alt=""></td>
                <td @click="deleteRoomCover(image.id)"><i class="fas fa-times-circle"></i></td>
              </tr>
            </table>
        </div>

        <div v-else><h3>Niste dodali nijednu sliku za pozadinu!</h3></div>

       </div>


  </div>
</template>

<script>
export default {
  data(){
    return {
      file : null,
      cover : null
    }
  },

  methods : {
    showUploadProfile(){
      $("#uploadProfile").slideToggle();
    },

   showUploadCover(){
     $("#uploadCover").slideToggle();
   },

    onFileChange(event){
      this.file = event.target.files[0];
    },

    onCoverChange(event){
      this.cover = event.target.files[0];
    },

    onUpload(){
      let formData = new FormData();
      formData.append('image', this.file);
      const config = {
                     headers: { 'content-type': 'multipart/form-data' }
                      }
      axios.post('/api/rooms/add_image/' + this.$route.params.id , formData, config)
      .then((response)=>{location.reload()})
    },

    onCoverUpload(){
      let formData = new FormData();
      formData.append('image', this.cover);
      const config = {
                     headers: { 'content-type': 'multipart/form-data' }
                      }
      axios.post('/api/rooms/add_cover/' + this.$route.params.id , formData, config)
      .then((response)=>{
        console.log(response);
        location.reload()
      })
    },

    deleteRoomPhoto(id){
      let formData = new FormData();
      formData.append('id', id);
      let sure_to_delete = confirm("Da li ste sigurni da želite da izbrišete fotografiju?");
      if (sure_to_delete){
        axios.post('/api/rooms/delete_image/' + this.$route.params.id , formData)
        .then((response)=>{location.reload()});
      }
      //MOZE SE DOPUNITI ODGOVARAJUĆOM PORUKOM
    },
    deleteRoomCover(id){
      let formData = new FormData();
      formData.append('id', id);
      let sure_to_delete = confirm("Da li ste sigurni da želite da izbrišete fotografiju?");
      if (sure_to_delete){
        axios.post('/api/rooms/delete_cover/' + this.$route.params.id , formData)
        .then((response)=>{location.reload()});
      }
      //MOZE SE DOPUNITI ODGOVARAJUĆOM PORUKOM
    },
  },
  props : {
    room : {
      type : Object
    }
  }
}
</script>

<style lang="css">
</style>
