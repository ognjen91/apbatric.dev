<i18n>
{
"sr": {
    "Ovaj popust trenutno nije aktivan" : "Ovaj popust trenutno nije aktivan",
    "Opis akcije" : "Opis akcije",
    "Ostala sniženja" : "Ostala sniženja",
    "Saznajte više" : "Saznajte više",
    "Nema drugih aktivnih sniženja" : "Nema drugih aktivnih sniženja",
    "dana" : "dan | dana",
    "sati" : "sat | sati",
    "minuta" : "minut | minuta",
    "sekundi" : "sekund | sekundi"

},
  "en": {
    "Ovaj popust trenutno nije aktivan" : "This discount is not active at the moment",
    "Opis akcije" : "Discount Description",
    "Ostala sniženja" : "Other Dicounts",
    "Saznajte više" : "See More",
    "Nema drugih aktivnih sniženja" : "There is no other discounts active at the moment",
    "dana" : "day | days",
    "sati" : "hour | hours",
    "minuta" : "minute | minutes",
    "sekundi" : "second | seconds"
  },
  "ru" : {
    "Ovaj popust trenutno nije aktivan" : "Скидка в данный момент не активна",
    "Opis akcije" : "Описание",
    "Ostala sniženja" : "Другие скидки",
    "Saznajte više" : "Смотрите подробности",
    "Nema drugih aktivnih sniženja" : "В настоящий момент нет никаких других скидок",
    "dana" : "день | дней",
    "sati" : "час | часов",
    "minuta" : "минуту | минут",
    "sekundi" : "секунду | секунд"
  }
}
</i18n>


<template lang="html">
  <div class="row discountPage">
    <div class="col-12 alert alert-danger" v-if="!isActive">
      <h2>{{$t("Ovaj popust trenutno nije aktivan")}}!</h2>
    </div>


    <div class="col-12 col-md-9 discountInfo">
       <h1 class="text spaced2 discountName"><i class="fas fa-exclamation"></i> {{event.name[locale]}}</h1>


       <div class='row discountCounter' v-if='isActive'>
         <div class="col-5 col-sm-3 col-lg-3 counterCirlceCol">
           <button class="btn btn-default circle-button title">{{eventCounter.days}}  <br> {{$tc("dana",eventCounter.days)}}</button>
         </div>
         <div class="col-5 col-sm-3 col-lg-3 counterCirlceCol">
             <button class="btn btn-default circle-button title">{{eventCounter.hours}}  <br> {{$tc("sati",eventCounter.hours)}}</button>
         </div>
         <div class="col-5 col-sm-3 col-lg-3 counterCirlceCol">
             <button class="btn btn-default circle-button title">{{eventCounter.minutes}}  <br> {{$tc("minuta",eventCounter.minutes)}}</button>
         </div>
         <div class="col-5 col-sm-3 col-lg-3 counterCirlceCol">
             <button class="btn btn-default circle-button title" id='counterSeconds'>{{eventCounter.seconds}} <br>  {{$tc("sekundi",eventCounter.seconds)}}</button>
         </div>
       </div>

       <h3 class="titleBig spaced underlined">{{$t("Opis akcije")}}:</h3>
       <p v-html="event.description[locale]" class='title discoutDescription'></p>

<hr>
    </div>



    <div class="col-12 col-md-3 otherEvents">
        <h2 class="titleBig">{{$t("Ostala sniženja")}}</h2>
<div class="row" v-if="otherEvents.length">
  <div class="col-12">

  </div>
  <div class="col-12">
    <div class="row">
      <div class="col-10 otherDiscount" v-for='discount in otherEvents'>
        <h3 class="text otherDiscName">{{discount.name[locale]}}</h3>
        <p class='title otherDiscountDescription' v-html="discount.preview[locale]"></p>
        <router-link class='btn btn-secondary' :to="{ name: 'viewDiscount', params: {id:discount.id} }">
          {{$t("Saznajte više")}}
        </router-link>
      </div>
    </div>
  </div>
</div>
<div class="row" v-else>
  <h4 class="title noOtherDisc">{{$t("Nema drugih aktivnih sniženja")}}</h4>
</div>

    </div>

  </div>
</template>

<script>
var moment = require('moment');
import {shuffle} from '../../../helpers/functions';
export default {
  mounted(){
    this.$store.dispatch('guestGetEvents');
    setInterval(()=>{
      let thisMoment = new Date();
      let now = moment(thisMoment);
      let eventFinish = moment(+this.event.finish);
      this.eventCounter.days = eventFinish.diff(now, 'days');
      this.eventCounter.hours = eventFinish.diff(now, 'hours')%24;
      this.eventCounter.minutes = eventFinish.diff(now, 'minutes')%60;
      this.eventCounter.seconds = eventFinish.diff(now, 'seconds')%60;
    }, 1000);
  },
  data(){
    return {
      moment : moment,
      eventCounter : {
        days : "",
        hours : "",
        minutes : "",
        seconds : ""
      },
      locale: localStorage.getItem('lang')

    }
  },
  computed : {
    event(){
      let event = this.$store.getters.getEvent(this.$route.params.id);
      if (typeof event == 'undefined'){
        this.$router.push({name:'errorRoute'})
      }else {
        return event;
      }
    },
    isActive(){
      let now = new Date();
      if (typeof this.event !== 'undefined'){
        return +this.event.finish > now;
      } else {
        return false;
      }

    },
    otherEvents (){
      let all_events = this.$store.getters.getActiveEvents;
      return shuffle(all_events.filter(event => event.id !== this.event.id));
    }
  },

  watch : {

  }

}
</script>

<style lang="css">
</style>
