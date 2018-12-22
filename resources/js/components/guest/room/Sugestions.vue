<i18n>
{
"sr": {
    "Apartmani sa" : "Apartmani sa",
    "kreveta" : "kreveta",
    "Pogledajte" : "Pogledajte",
    "Ostali apartmani" : "Ostali apartmani",
    "već od" : "već od"
},
  "en": {
    "Apartmani sa" : "Apartments with",
    "kreveta" : "beds",
    "Pogledajte" : "See Details",
    "Ostali apartmani" : "Other apartments",
    "već od" : "price starts at"
  },
  "ru" : {
    "Apartmani sa" : "Aпартаменты с",
    "kreveta" : "kreveta",
    "Pogledajte" : "Узнать больше",
    "Ostali apartmani" : "Другие апартаменты",
    "već od" : "oт"
  }
}
</i18n>



<template lang="html">
  <div class="row">

    <div class="col-12 withSameBeds suggestions" v-if='roomsWithSameBeds.length'>
      <div class="row">
        <div class="col-12"><h4 class='title suggestionTitle'>{{$t("Apartmani sa ")}}{{roomsWithSameBeds[0].beds}} {{$t("kreveta")}}</h4></div>

        <div class="col-6 col-md-4 suggestedRoom" v-for='(room, index) in roomsWithSameBeds' v-if='index<3'>
          <h4 class='text'>{{room.name[locale]}}</h4>
          <p class='title'>{{$t("već od")}} {{room.starting_price}} &euro;</p>

            <router-link :to="{ name: 'viewRoom', params: {id:room.id} }" tag='div' class="suggestedImg">
              <a>
              <img :src="'/images/rooms/' + room.profile_img" alt="suggested room profile image">
              </a>
             </router-link>



           <router-link :to="{ name: 'viewRoom', params: {id:room.id} }"  class="btn btn-primary searchGo suggestedGo">

            {{$t("Pogledajte")}}

          </router-link>


        </div>
      </div>
    </div>

    <div class="col-12 withNoSameBeds suggestions">
      <div class="row">
        <div class="col-12"><h4 class='title suggestionTitle'>{{$t("Ostali apartmani")}}</h4></div>

        <div class="col-6 col-md-4 suggestedRoom" v-for='(room, index) in otherRooms' v-if="index<3">
          <h4 class='text'>{{room.name[locale]}}</h4>
          <p class='title'>{{$t("već od")}} {{room.starting_price}} &euro;</p>

            <router-link :to="{ name: 'viewRoom', params: {id:room.id} }" tag='div' class="suggestedImg">
              <a>
              <img :src="'/images/rooms/' + room.profile_img" alt="suggested room profile image">
              </a>
            </router-link>


          <!-- <div class="btn btn-primary searchGo suggestedGo"> -->
           <router-link :to="{ name: 'viewRoom', params: {id:room.id} }" class="btn btn-primary searchGo suggestedGo">
            {{$t("Pogledajte")}}
          </router-link>
          <!-- </div> -->
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import {shuffle} from '../../../helpers/functions';

export default {
  props : {
    otherRooms : Array,
    roomsWithSameBeds : Array
  },
  data(){
    return {
        locale: localStorage.getItem('lang')
    }
  },

  watch : {
    otherRooms(val){
      val = shuffle(val)
    },
    roomsWithSameBeds(val){
      val = shuffle(val)
    },
  }
}
</script>

<style lang="css">
</style>
