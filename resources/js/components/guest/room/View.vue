<i18n>
{
"sr": {
  "kreveta" : "kreveta",
  "Ostale pogodnosti" : "Ostale pogodnosti"
},
  "en": {
    "kreveta" : "beds",
    "Ostale pogodnosti" : "Other Amenities"
  },
  "ru" : {
    "kreveta" : "???",
    "Ostale pogodnosti": "Другие удобства"
  }
}
</i18n>


<template lang="html">
  <div class="viewRoom row">
    <div class="roomBackgroundImg" :style="{backgroundImage: 'url(/images/covers/'+room.cover_img +') ' }">
          <h3 class="roomSlogan">{{room.slogan.sr}}</h3>
    </div>
    <!-- <div class="backgroundImgSpace"></div> -->
    <div class="col-12">
      <div class="row">


  <!-- ============ROOM IMGS=================== -->
    <div class="roomImgs col-12 col-lg-12">
      <div class="row">

        <div class="bigImg col-10 col-sm-7" id='bigImg' :style="{backgroundImage: 'url(/images/rooms/'+room.profile_img +') ' }">
            <h3 class="roomSlogan">{{room.slogan.sr}}</h3>
        </div>

        <div class="smallImgs col-12 col-sm-4 col-lg-5">
            <div class="row">
                <div v-for="image in roomImages" class='smallImg col-4 col-sm-6 col-lg-4'>
                    <img :src="image" alt="" @click='showBig'>
                </div>
            </div>
        </div>

      </div>
    </div>



    <div class="col-12  roomInfo">
      <div class="row">

      <!-- =======ROOM BASICS============== -->
      <div class="col-12 col-lg-6 basicInfo">
        <h1 class="text roomName">{{room.name[locale]}}</h1>
        <p class="title"><i>{{ room.slogan[locale] }}</i></p>
        <p class='title'><strong>{{room.beds}}</strong> {{ $t('kreveta')}}</p>

        <hr>
        <p class="title roomDescription" v-html="room.description[locale]"></p>

      </div>

        <!-- ========ROOM AMENITIES====== -->
      <div class="col-12 col-lg-6 amenities">
          <RoomAmenities :room='room' />

          <div class="row otherAmenities" v-if="room.other_amenities.sr" >
            <div class="col-10">
              <h5 class='title'>{{$t('Ostale pogodnosti')}}</h5>
              <p v-html="room.other_amenities[locale]"></p>
            </div>
          </div>
      </div>

    </div>
    </div>

    <!-- =============ROOM PRICES===================== -->
    <div class="col-12 col-lg-4 prices">
       <RoomPrices :prices="room.prices.prices" />
    </div>


 <!-- ============ROOM CALENDARS======================== -->
    <div class="col-12 col-lg-8 room Calendars">
       <RoomCalendars :reservedTimestamps="room.calendars.reserved_dates" :roomName='room.name' />
    </div>

    <!-- ==========ROOMS SUGESTIONS========== -->
    <div class="col-12 roomSugestions">
      <RoomSugestions :otherRooms="otherRooms" :roomsWithSameBeds="roomsWithSameBeds" />
    </div>

</div>
</div>
    </div>

</template>

<script>



import RoomAmenities from './Amenities.vue'
import RoomCalendars from './Calendars.vue'
import RoomPrices from './Prices.vue'
import RoomSugestions from './Sugestions.vue'
import Datepicker from 'vuejs-datepicker';
import {shuffle} from '../../../helpers/functions';
import {sr} from 'vuejs-datepicker/dist/locale'
export default {
  components: {
   RoomCalendars, RoomAmenities, RoomSugestions, RoomPrices
 },
  data(){
    return {
      room : {},
      loaded : false,
      roomImages : [],
      locale: localStorage.getItem('lang')

    }
  },

  mounted(){
    this.$store.dispatch('guestGetRooms');
    axios.get('/api/public/room/' + this.$route.params.id)
    .then((response)=>{
      // console.log(response.data.room[0]);
        this.room = response.data.room[0];
        if (typeof this.room == 'undefined') this.$router.push({name:"errorRoute"});
        this.room.name = JSON.parse(this.room.name);
        this.room.prices.prices  = JSON.parse(this.room.prices.prices)
        this.room.description = JSON.parse(this.room.description);
        this.room.other_amenities = JSON.parse(this.room.other_amenities);
        this.room.slogan = JSON.parse(this.room.slogan);
        this.room.calendars.reserved_dates = JSON.parse(this.room.calendars.reserved_dates);
        response.data.room[0].room_images.forEach(img => {
          this.roomImages.push("/images/rooms/"+img.name)
        })
        this.loaded = true
    })



  },


  computed : {
    //sobe sa razlicitim brojem kreveta
    otherRooms(){
      return this.$store.getters.getRooms.filter(
        room =>  room.id !== this.room.id && room.beds !== this.room.beds
      );
    },
      roomsWithSameBeds(){
        return this.$store.getters.getRooms.filter(
          room =>  room.id !== this.room.id && room.beds == this.room.beds
        );
      }
  },

  methods : {
    //prikaz slike
    showBig(e){
      // console.log(e.target.currentSrc);
      let imgSrc = e.target.currentSrc;
      $('#bigImg').css("background-image", "url("+ imgSrc +")");
    },
    proceed(){
      if (!this.arrival || !this.departure || this.arrival > this.departure){
        // console.log("STOP");
        this.error = true;
        setTimeout(()=>{this.error = false}, 4000);
        return;
      }

      this.$emit('doSearch', {
        arrival : this.arrival,
        departure : this.departure
      })

    },
    arrivalAction(e){
      this.arrival = e.setHours(12,0,0,0);
    },
    departureAction(e){
      this.departure = e.setHours(12,0,0,0);
    }
  },

  watch : {
    locale (val) {
          this.$i18n.locale = val
    },

    '$route.params.id' : function(val){
      axios.get('/api/public/room/' + val)
      .then((response)=>{

        this.room = response.data.room[0];
        if (typeof this.room == 'undefined') this.$router.push({name:"errorRoute"});
        this.room.name = JSON.parse(this.room.name);
        this.room.prices.prices  = JSON.parse(this.room.prices.prices)
        this.room.description = JSON.parse(this.room.description);
        this.room.other_amenities = JSON.parse(this.room.other_amenities);
        this.room.slogan = JSON.parse(this.room.slogan);
        this.room.calendars.reserved_dates = JSON.parse(this.room.calendars.reserved_dates);
        this.roomImages = [];
        response.data.room[0].room_images.forEach(img => {
          this.roomImages.push("/images/rooms/"+img.name)
        })
        this.loaded = true





        // console.log(response.data.room[0]);
        //   this.room = response.data.room[0];
        //   this.room.name = JSON.parse(this.room.name);
        //   this.room.prices.prices  = JSON.parse(this.room.prices.prices)
        //   this.room.description = JSON.parse(this.room.description);
        //   this.room.other_amenities = JSON.parse(this.room.other_amenities);
        //   this.room.slogan = JSON.parse(this.room.slogan);
        //   this.room.calendars.reserved_dates = JSON.parse(this.room.calendars.reserved_dates);
        //   this.room.room_images = [];
        //   response.data.room[0].room_images.forEach(img => {
        //     // this.roomImages = [...this.roomImages, "/images/rooms/" + img.name];
        //     this.roomImages.push("/images/rooms/"+img.name)
        //   })
        //   this.loaded = true
      })

      var body = $("html, body");
      body.stop().animate({scrollTop:0}, 500, 'swing', function() {
   // alert("Finished animating");
});
    }
  }


}
</script>

<style lang="css">
</style>
