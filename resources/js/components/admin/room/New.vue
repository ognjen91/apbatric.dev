<template lang="html">
  <div class="newRoom row">
    <div class="col-12">

        <h2>Dodajte novu sobu</h2>

      <div class="errors" v-if='errors'>
        <ul>
          <li v-for="(fieldError, fieldName) in errors" :key="fieldName" class="alert alert-danger">
            {{fieldError.join('\n')}}
          </li>
        </ul>
      </div>

        <hr>

      <form @submit.prevent='send_data' enctype="multipart/form-data">

        <!-- =============NAZIV SOBE============== -->
        <div class="roomData">
        <div class="form-group">
          <label for="a_room_name"><h3>Naziv sobe</h3></label>
          <input type="text" class='form-control' id="a_room_name" v-model="new_room_data.name.sr">
        </div>

        <div class="form-group">
          <label for="a_room_name_en"><h4>Naziv sobe na engleskom</h4></label>
          <input type="text" class='form-control' id="a_room_name_en" v-model="new_room_data.name.en">
        </div>

        <div class="form-group">
          <label for="a_room_name_ru"><h4>Naziv sobe na ruskom</h4></label>
          <input type="text" class='form-control' id="a_room_name_ru" v-model="new_room_data.name.ru">
        </div>
      </div>


      <!-- ========KREVETI I CIJENA============== -->
   <div class="roomData">
        <div class="form-group">
          <label for="exampleSelect1">Broj kreveta</label>
          <select class="form-control" id="exampleSelect1" v-model="new_room_data.beds">
            <option v-for="n in 10" :value="n">{{n}}</option>
          </select>
        </div>


        <div class="form-group">
          <label for="room_name">Početna cijena (&euro;)</label>
            <input type="text" class='form-control' id="a_room_price" v-model="new_room_data.starting_price">
        </div>
      </div>


      <!-- ===========OPISI====================== -->
       <div class="roomData">
        <div class="form-group">
          <label><h4>Opis</h4></label>
          <VueTrix v-model="new_room_data.description.sr"/>
        </div>

        <div class="form-group">
          <label><h4>Opis na engleskom</h4></label>
          <VueTrix v-model="new_room_data.description.en"/>
        </div>

        <div class="form-group">
          <label><h4>Opis na ruskom</h4></label>
          <VueTrix v-model="new_room_data.description.ru"/>
        </div>
      </div>



    <!-- ====================SLOGANI=========================       -->
       <div class="roomData">
        <div class="form-group">
          <label for="a_room_slogan_sr"><h4>Slogan <small>kratak slogan za sobu, max 50 znakova</small></h4></label>
          <input maxlength="50" type="text" class='form-control' id="a_room_slogan_sr" v-model="new_room_data.slogan.sr">
        </div>

        <div class="form-group">
          <label for="a_room_slogan_en"><h4>Slogan na engleskom <small>kratak slogan za sobu, max 50 znakova</small></h4></label>
          <input maxlength="50" type="text" class='form-control' id="a_room_slogan_en" v-model="new_room_data.slogan.en">
        </div>

        <div class="form-group">
          <label for="a_room_slogan_ru"><h4>Slogan na ruskom <small>kratak slogan za sobu, max 50 znakova</small></h4></label>
          <input maxlength="50" type="text" class='form-control' id="a_room_slogan_ru" v-model="new_room_data.slogan.ru">
        </div>
      </div>

      <!-- ===========POGODNOSTI============= -->
       <div class="roomData">
         <div class='a_room_amenities'>
           <h4>Pogodnosti: &nbsp; &nbsp; </h4>
           <div class="form-check form-check-inline">
           <label class="form-check-label">
               <input class="form-check-input" :value="'true'" type="checkbox" id="inlineCheckbox1" value="option1" v-model="new_room_data.bathroom"> Kupatilo
             </label>
           </div>
           <div class="form-check form-check-inline">
             <label class="form-check-label">
               <input class="form-check-input" :value="'true'" type="checkbox" id="inlineCheckbox2" value="option2" v-model="new_room_data.kitchen"> Kuhinja
             </label>
           </div>
           <div class="form-check form-check-inline">
             <label class="form-check-label">
               <input class="form-check-input" :value="'true'" type="checkbox" id="inlineCheckbox3" value="option3" v-model="new_room_data.terrace"> Terasa
             </label>
           </div>
           <div class="form-check form-check-inline">
           <label class="form-check-label">
               <input class="form-check-input" :value="'true'" type="checkbox" id="inlineCheckbox1" value="option1" v-model="new_room_data.tv"> TV
             </label>
           </div>
           <div class="form-check form-check-inline">
             <label class="form-check-label">
               <input class="form-check-input" :value="'true'" type="checkbox" id="inlineCheckbox2" value="option2" v-model="new_room_data.air_conditioner"> Klima uređaj
             </label>
           </div>
           <div class="form-check form-check-inline">
             <label class="form-check-label">
               <input class="form-check-input" :value="'true'" type="checkbox" id="inlineCheckbox3" value="option3" v-model="new_room_data.wifi"> WiFi
             </label>
           </div>
         </div>
       </div>

       <!-- =========OSTALE POGODNOSTI============= -->
        <div class="roomData">
         <div class="form-group">
           <label for="a_room_amenities"><h4>Ostale pogodnosti: </h4></label>
           <VueTrix v-model="new_room_data.other_amenities.sr"/>
         </div>
         <div class="form-group">
           <label for="a_room_amenities_en"><h4>Ostale pogodnosti na engleskom: </h4></label>
           <VueTrix v-model="new_room_data.other_amenities.en"/>
         </div>
         <div class="form-group">
           <label for="a_room_amenities_ru"><h4>Ostale pogodnosti na ruskom: </h4></label>
           <VueTrix v-model="new_room_data.other_amenities.ru"/>
         </div>
       </div>


         <div class="submit_n_succes">
           <input type="submit" class="btn btn-primary" value="Dodaj sobu!">
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
      new_room_data : {
        name : {
          sr : "",
          en : "",
          ru : ""
        },
        beds : 1,
        starting_price : 10,
        bathroom : false,
        kitchen : false,
        terrace : false,
        air_conditioner : false,
        tv : false,
        wifi : false,
        other_amenities : {
          sr : "",
          en : "",
          ru : ""
        },
        description : {
          sr : "",
          en : "",
          ru : ""
        },
        slogan : {
          sr : "",
          en : "",
          ru : ""
        },

      },
      errors : null,
      success : null,
      room_id : null
    }
  },

  methods : {
    send_data(){

      var router = this.$router;
      axios.post('/api/rooms/create', this.$data.new_room_data)
      .then(
        (response) => {
          this.success = response.data.message;

          setTimeout(function(){
            router.push({name: "editRoom", params : { id : response.data.room_id }});
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
  }
}
</script>

<style lang="css">
</style>
