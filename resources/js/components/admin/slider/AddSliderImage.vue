<template lang="html">
  <div class="col-12 col-sm-12 col-md-5">
    <h4><strong>Nova slika slajdera</strong></h4>
    <form @submit.prevent='addSliderImage' enctype="multipart/form-data" class="new_img_form">
      <div class="form-group">
        <label for="exampleFormControlFile1"><h5>Dodajte novu sliku za slajder</h5></label>
        <input @change="onFileChange" type="file" class="form-control-file" id="exampleFormControlFile1">



        <button type="submit" class="btn btn-default add_new_room_image">Ubaci!</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data(){
    return {
      file : null,

    }
  },
  methods : {
    onFileChange(event){
      this.file = event.target.files[0];
    },
    addSliderImage(){
      let formData = new FormData();
      formData.append('image', this.file);


      // return;
      const config = {
                     headers: { 'content-type': 'multipart/form-data' }
                      }
      axios.post('/api/slider/create', formData, config)
      .then((response)=>{
        location.reload()
        }
      )

      //DOPUNITI PORUKOM
    }
  }
}
</script>

<style lang="css">
</style>
