<template lang="html">
  <div class="new_room row">

    <div class="col-12 editRoomSectionTitle">
      <h2 class="titleBigger ">Osnovne informacije</h2>
    </div>

    <div class="col-12">



      <div class="errors" v-if='errors'>
        <ul>
          <li v-for="(fieldError, fieldName) in errors" :key="fieldName" class="alert alert-danger">
            {{fieldError.join('\n')}}
          </li>
        </ul>
      </div>

        <hr>

      <form @submit.prevent='updateRoom' enctype="multipart/form-data">

<div class="roomData">
        <div class="form-group">
          <label for="a_room_name"><h3 @click='konzoluj'>Naziv sobe</h3></label>
          <input type="text" class='form-control' id="a_room_name" v-model="room.name.sr">
        </div>

        <div class="form-group">
          <label for="a_room_name_en"><h4>Naziv sobe na engleskom</h4></label>
          <input type="text" class='form-control' id="a_room_name_en" v-model="room.name.en">
        </div>

        <div class="form-group">
          <label for="a_room_name_ru"><h4>Naziv sobe na ruskom</h4></label>
          <input type="text" class='form-control' id="a_room_name_ru" v-model="room.name.ru">
        </div>

        <hr>

        <div class="form-group">
          <label for="exampleSelect1">Broj kreveta</label>
          <select class="form-control" id="exampleSelect1" v-model="room.beds">
            <option v-for="n in 10" :value="n">{{n}}</option>
          </select>
        </div>


        <div class="form-group">
          <label for="room_name">Početna cijena (&euro;)</label>
          <input type="text" class='form-control' id="a_room_price" v-model="room.starting_price">
        </div>
</div>

<div class="roomData">
        <div class="form-group">
          <label for="a_room_description"><h4>Opis</h4></label>
          <VueTrix v-model="room.description.sr"/>
        </div>

        <div class="form-group">
          <label for="a_room_description_en"><h4>Opis na engleskom</h4></label>
          <VueTrix v-model="room.description.en"/>
        </div>

        <div class="form-group">
          <label for="a_room_description_ru"><h4>Opis na ruskom</h4></label>
          <VueTrix v-model="room.description.ru"/>
        </div>
</div>

<div class="roomData">
        <div class="form-group">
          <label for="a_room_slogan_sr"><h4>Slogan <small>kratak slogan za sobu, max 50 znakova</small></h4></label>
          <input maxlength="50" type="text" class='form-control' id="a_room_slogan_sr" v-model="room.slogan.sr">
        </div>

        <div class="form-group">
          <label for="a_room_slogan_en"><h4>Slogan na engleskom <small>kratak slogan za sobu, max 50 znakova</small></h4></label>
          <input maxlength="50" type="text" class='form-control' id="a_room_slogan_en" v-model="room.slogan.en">
        </div>

        <div class="form-group">
          <label for="a_room_slogan_ru"><h4>Slogan na ruskom <small>kratak slogan za sobu, max 50 znakova</small></h4></label>
          <input maxlength="50" type="text" class='form-control' id="a_room_slogan_ru" v-model="room.slogan.ru">
        </div>

      </div>

      <div class="roomData">
         <div class='a_room_amenities'>
           <h4>Pogodnosti: &nbsp; &nbsp; </h4>
           <div class="form-check form-check-inline">
           <label class="form-check-label">
               <input class="form-check-input"  type="checkbox" id="inlineCheckbox1"  v-model="room.bathroom"> Kupatilo
             </label>
           </div>
           <div class="form-check form-check-inline">
             <label class="form-check-label">
               <input class="form-check-input"  type="checkbox" id="inlineCheckbox2"  v-model="room.kitchen"> Kuhinja
             </label>
           </div>
           <div class="form-check form-check-inline">
             <label class="form-check-label">
               <input class="form-check-input"  type="checkbox" id="inlineCheckbox3"  v-model="room.terrace"> Terasa
             </label>
           </div>
           <div class="form-check form-check-inline">
           <label class="form-check-label">
               <input class="form-check-input"  type="checkbox" id="inlineCheckbox1"  v-model="room.tv"> TV
             </label>
           </div>
           <div class="form-check form-check-inline">
             <label class="form-check-label">
               <input class="form-check-input"  type="checkbox" id="inlineCheckbox2"  v-model="room.air_conditioner"> Klima uređaj
             </label>
           </div>
           <div class="form-check form-check-inline">
             <label class="form-check-label">
               <input class="form-check-input"  type="checkbox" id="inlineCheckbox3"  v-model="room.wifi"> WiFi
             </label>
           </div>
         </div>

       </div>

       <div class="roomData">
         <div class="form-group">
           <label><h4>Ostale pogodnosti: </h4></label>
           <VueTrix v-model="room.other_amenities.sr"/>
         </div>
         <div class="form-group">
           <label for="a_room_amenities_en"><h4>Ostale pogodnosti na engleskom: </h4></label>
           <VueTrix v-model="room.other_amenities.en"/>
         </div>
         <div class="form-group">
           <label for="a_room_amenities_ru"><h4>Ostale pogodnosti na ruskom: </h4></label>
           <VueTrix v-model="room.other_amenities.ru"/>
         </div>

       </div>


         <div class="submit_n_succes">
           <input type="submit" class="btn btn-primary" value="Prihvati izmjene!">
           <div class="create_room_success alert alert-success" v-if='success'>
               {{ success }}
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
      errors : null,
      success : null
    }
  },
  props : {
    room : {
      type : Object
    }
  },

  methods : {
    updateRoom(){
      axios.post( '/api/rooms/update/' + this.$route.params.id , this.room)
      .then((response)=>{location.reload()});
    },
    konzoluj(){
      // JSON.parse(this.room.name)
      console.log(typeof this.room.name)
      console.log(JSON.parse(this.room.name));
    }
  }
}
</script>

<style lang="css">
</style>
