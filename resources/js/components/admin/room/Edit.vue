<template lang="html">
  <div class="row editRoom" v-if="room">

    <div class="col-12 adminNavLink">
      <router-link :to="{ name: 'adminDashboard', params: {id:$route.params.id} }">
        Nazad
      </router-link>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8 editRoomInfos">
      <div class="roomNameNCover" :style="{backgroundImage : 'url(/images/covers/'+room.cover_img +')'}">
        <router-link class="goChangeCover" :to="{ name: 'changeCoverImg', params: {} }"><small>Promjenite fotografiju pozadine sobe</small></router-link>
        <h1 @click="konzoluj"> {{ room.name.sr }} </h1>

      </div>



    <router-link :to="{ name: 'editCalendars', params: { id : room.id } }" tag="div" class='btn btn-dark'>Mijenjajte kalendare</router-link>
    <router-link :to="{ name: 'editPrices', params: { id : room.id } }" tag="div" class='btn btn-dark'>Mijenjajte cijenovnik</router-link>
    <EditFields :room='room'></EditFields>
    <hr>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4 editRoomImages">
      <Images :room='room' />
    </div>

  </div>




</template>

<script>
import Images from './Images.vue'
import EditFields from './EditFields.vue'

export default {
  data(){
    return {
        room : null
    }
  },
  methods : {
    konzoluj(){
      console.log(this.room)
      console.log(JSON.parse(this.room.name));
    }
  },
  components : {
    Images,
    EditFields,
  },
  mounted(){
    this.$store.dispatch('getRooms');
    axios.get('/api/room/' + this.$route.params.id)
    .then((response)=>{
        this.room = response.data.room[0];
        this.room.name = JSON.parse(this.room.name);
        this.room.description = JSON.parse(this.room.description);
        this.room.other_amenities = JSON.parse(this.room.other_amenities);
        this.room.slogan = JSON.parse(this.room.slogan);
    })

  },

  computed : {
    rooms(){
      return this.$store.getters.getRooms;
    }
  },

  watch : {
    room : function(val){
      // console.log(val)
      // if(typeof val == 'undefined') this.$router.push({name : "adminDashboard"});
   }
  }
}
</script>

<style lang="css">
</style>
