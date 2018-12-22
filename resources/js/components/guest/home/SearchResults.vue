<i18n>
{
"sr": {
    "Rezultati pretrage" : "Rezultati pretrage",
    "kreveta" : "kreveta",
    "Pogledajte" : "Pogledajte",
    "Žao nam je, za traženi period nemamo slobodnih soba." : "Žao nam je, za traženi period nemamo slobodnih soba.",
    "Odaberite druge datume za pretragu" : "Odaberite druge datume za pretragu"
},
  "en": {
    "Rezultati pretrage" : "Search Results",
    "kreveta" : "beds",
    "Pogledajte" : "See More",
    "Žao nam je, za traženi period nemamo slobodnih soba." : "We are sorry, there is no apartments available in the selected period",
    "Odaberite druge datume za pretragu" : "Search by other dates"
  },
  "ru" : {
    "Rezultati pretrage" : "Результаты поиска",
    "kreveta" : "кровати",
    "Pogledajte" : "Подробнее",
    "Žao nam je, za traženi period nemamo slobodnih soba." : "Нет свободных номеров. Выберите другие даты",
    "Odaberite druge datume za pretragu" : "Выберите другие даты"
  }
}
</i18n>


 <template lang="html">
  <div class="row searchResults">

    <div class="col-12 searchTitles">
      <h2 class='titleBiggest'>{{$t('Rezultati pretrage')}}</h2>
      <h3 class='titleSmall'>
        {{locale !== 'en'? moment(arrivalDate).format("DD. MM. YYYY.") : moment(arrivalDate).format("DD. MMMM YYYY.")}}
        -
        {{locale !== 'en'? moment(departureDate).format("DD. MM. YYYY.") : moment(departureDate).format("DD. MMMM YYYY.")}}</h3>
    </div>

    <div class="col-12 resultRooms" v-if="searchResults.length">

      <div class="row">
         <div class="col-12 col-lg-6 searchResult" v-for='room in searchResults'>

         <div class="searchImg">
           <router-link :to="{ name: 'viewRoom', params: {id: room.id} }">
              <img :src="'/images/rooms/'+room.profile_img" alt="">
           </router-link>
         </div>

         <div class="searchInfo">
           <h3 class='titleSmall searchRoomName'>{{room.name[locale]}}</h3>
           <p class="textSpaced">{{room.beds}} {{$t('kreveta')}}</p>
           <router-link :to="{ name: 'viewRoom', params: {id : room.id} }" class="btn btn-primary searchGo">
             {{$t('Pogledajte')}}
           </router-link>
         </div>

         </div>
      </div>

    </div>
    <div class="col-12 noResults" v-else>
      <h2>{{$t('Žao nam je, za traženi period nemamo slobodnih soba.')}}</h2>
    </div>

    <div class="searchAgain col-12">
      <div class="btn btn-secondary" @click='goBackToPick'>
        {{$t('Odaberite druge datume za pretragu')}}
      </div>
    </div>

  </div>
</template>

<script>
var moment = require('moment');
export default {
  props : {
    reservedDates : Array,
    arrivalDate : Number,
    departureDate : Number
},
data(){
  return {
    moment: moment,
    searchResults : [],
    locale: localStorage.getItem('lang')
  }
},

methods : {
  goBackToPick(){
    this.$emit('goBackToPick');
  }
},


mounted(){
  this.searchResults = [];
  let ids = [];
  console.log(this.reservedDates);
  // this.reservedDates.forEach(room=>{console.log(room);})
  this.reservedDates.forEach(room=>{
      let is_free = true;
      try {
        var BreakException = {};
        room.reserved_dates.forEach(date=>{
          if (date>=this.arrivalDate && date<=this.departureDate){
              is_free = false;
              throw BreakException;
            }
          })
      } catch (e) {
        if (e !== BreakException) throw e;
      }

      if (is_free) this.searchResults  = [...this.searchResults , this.$store.getters.getRoom(room.id)];
  })
},
computed(){

}
}
</script>

<style lang="css">
</style>
