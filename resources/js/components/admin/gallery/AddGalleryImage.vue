<template lang="html">
  <div class="col-12 col-sm-12 col-md-4">
    <h4><strong>Nova slika galerije</strong></h4>
    <form @submit.prevent='addGalleryImage' enctype="multipart/form-data" class="new_img_form">
      <div class="form-group">
        <label for="exampleFormControlFile1"><h5>Dodajte novu sliku galerije</h5></label>
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
      file : null
    }
  },
  methods : {
    onFileChange(event){
      this.file = event.target.files[0];
    },
    addGalleryImage(){
      let formData = new FormData();
      formData.append('image', this.file);
      const config = {
                     headers: { 'content-type': 'multipart/form-data' }
                      }
      axios.post('/api/gallery/create', formData, config)
      .then((response)=>{
        location.reload()
        // console.log(response);
      })

      //DOPUNITI PORUKOM
    }
  }
}
</script>

<style lang="css">
</style>
