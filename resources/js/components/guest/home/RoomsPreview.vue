<i18n>
{
"sr": {
    "već od" : "već od",
    "Pogledajte sobu" : "Pogledajte sobu"
},
  "en": {
    "Pogledajte sobu" : "See more",
    "već od" : "price starts at"
  },
  "ru" : {
    "Pogledajte sobu" : "Узнать больше",
    "već od" : "цены от"
  }
}
</i18n>

<template lang="html">
  <div class="col-12 roomsPreview">
    <div class="randomRooms row">


    <div class="previewColumn col-12 col-sm-5" v-for="(room, index) in randomRooms" v-if="index<=3">
      <div class="previewRoom">
        <div class="previewImg">
          <router-link  :to="{ name: 'viewRoom', params: {id: randomRooms[index].id} }">

              <img :src="'/images/rooms/' + randomRooms[index].profile_img" alt="">

          </router-link>
        </div>
        <div class="previewText">
          <h3 class="titleBig roomTitle">{{randomRooms[index].name[locale]}}</h3>
          <p>{{randomRooms[index].slogan[locale]}}</p>
          <p class="previewStaPr">{{$t('već od')}} {{randomRooms[index].starting_price}} &euro;</p>

          <router-link class="btn btn-secondary goToRoom" tag='div' :to="{ name: 'viewRoom', params: {id: randomRooms[index].id} }">
              {{$t('Pogledajte sobu')}}
          </router-link>
        </div>
      </div>
    </div>


</div>

</div>
</template>

<script>
import {shuffle} from '../../../helpers/functions'
export default {
  props : {
    rooms : Array
  },
  data(){
    return {
        locale: localStorage.getItem('lang')
    }
  },
  computed : {
    randomRooms(){
      let randomRooms = shuffle(this.rooms);
      return randomRooms;
    }
  },
  watch : {
    locale (val) {
          this.$i18n.locale = val
        },
  }
}
</script>

<style lang="css">
</style>
