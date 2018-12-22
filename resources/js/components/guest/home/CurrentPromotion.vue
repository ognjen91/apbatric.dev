<i18n>
{
"sr": {
    "Promocije i sniženja" : "Promocije i sniženja",
    "završava za" : "završava za",
    "dana" : "dan | dana",
    "sati" : "sat | sati",
    "minuta" : "minut | minuta",
    "sekundi" : "sekund | sekundi",
    "Pogledajte detalje" : "Pogledajte detalje",
    "Ostale aktivne promocije" : "Ostale aktivne promocije",
    "Kraj promocije:" : "Kraj promocije",
    "Više..." : "Više...",
    "Promocija završena" : "Promocija završena"


},
  "en": {
    "Promocije i sniženja" : "Active Discounts",
    "završava za" : "finishes in",
    "dana" : "day | days",
    "sati" : "hour | hours",
    "minuta" : "minute | minutes",
    "sekundi" : "second | seconds",
    "Pogledajte detalje" : "See More Details",
    "Ostale aktivne promocije" : "Other Active Discounts",
    "Kraj promocije:" : "Discount active by",
    "Više..." : "More...",
    "Promocija završena" : "Discount Not Active"
  },
  "ru" : {
    "Promocije i sniženja" : "Акции и скидки",
    "završava za" : "заканчивается через",
    "dana" : "день | дней",
    "sati" : "час | часов",
    "minuta" : "минуту | минут",
    "sekundi" : "секунду | секунд",
    "Pogledajte detalje" : "Смотрите подробности",
    "Ostale aktivne promocije" : "Другие активные акции",
    "Kraj promocije:" : "Заканчивается:",
    "Više..." : "Подробности...",
    "Promocija završena" : "Скидка не активна"
  }
}
</i18n>

<template lang="html">
  <div class="col-12 discountsPreview">

      <div class="row">

        <div class="col-12 discTitle" v-if="!isCurrentEventActive">
          <h1 class='titleBiggest underlined'>{{$t('Promocije i sniženja')}}</h1>
        </div>

        <div class="col-12 col-md-7 mainDiscount"  v-if="isCurrentEventActive">
          <div class="col-12 discTitle">
            <h1 class='titleBiggest underlined'>{{$t('Promocije i sniženja')}}</h1>
          </div>

           <h3 class='titleBiggest mainDiscountTitle discountTitle'>{{ currentEvent.name[locale] }}</h3>
           <h6 class='spaced'>{{$t('završava za')}} <strong>
             {{mainEventCounter.days}} {{$tc('dana', mainEventCounter.days)}}
             {{mainEventCounter.hours}} {{$tc('sati', mainEventCounter.hours)}}
             {{mainEventCounter.minutes}} {{$tc('minuta', mainEventCounter.minutes)}}
             {{mainEventCounter.seconds}} {{$tc('sekundi', mainEventCounter.seconds)}}

             </strong> </h6>

             <hr>

           <p class="textSpaced" v-html="currentEvent.preview[locale]"></p>
           <router-link  class='btn btn-primary goToCurrentDisc' :to="{ name: 'viewDiscount', params: {id:currentEvent.id} }">
            {{ $t('Pogledajte detalje')}}
           </router-link>
        </div>

        <div :class="{ 'col-12 col-md-5' : isCurrentEventActive, 'col-8 ': !isCurrentEventActive, 'activeDicounts' : true}" v-if="activeEvents.length">
            <h4 class='titleSmall otherDiscTitle'>{{$t('Ostale aktivne promocije')}}</h4>
            <div class="activeDiscount" v-for='event in activeEvents'>
              <h3 class="titleSmall discountTitle">{{event.name[locale]}}</h3>
              <h6 class="textSpaced">{{$t('Kraj promocije:')}} <strong>{{locale !=='en'? moment(+event.finish).format("DD. MM. YYYY.") : moment(+event.finish).format("DD. MMMM YYYY.")}}</strong></h6>
              <hr>
              <p class="text" v-html='event.preview[locale]'></p>
              <router-link  class='btn btn-secondary' :to="{ name: 'viewDiscount', params: {id:event.id} }">
                {{$t('Više...')}}
              </router-link>
            </div>
        </div>

        <div v-if="!activeEvents.length && pastEvents.length" :class="{'col-12 col-md-5': isCurrentEventActive, 'col-4' : !isCurrentEventActive, 'pastDicounts' : true}">
          <h4 class='titleSmall otherDiscTitle underlined'>{{$t('Prošle promocije')}}</h4>
          <div class="pastDiscount" v-for='event in pastEvents'>
            <h3 class="titleSmall discountTitle">{{event.name[locale]}}</h3>
            <h6 class="textSpaced">{{$t('Promocija završena')}} <strong>{{locale !== 'en'? moment(+event.finish).format("DD. MM. YYYY.") : moment(+event.finish).format("DD. MMMM YYYY.")}}</strong></h6>
            <hr>
            <p class='text' v-html='event.preview[locale]'></p>
          </div>
        </div>

      </div>
  </div>
</template>

<script>
var moment = require('moment');

export default {
  data(){
    return{
      moment: moment,
      mainEventCounter : {
        days : "",
        hours : "",
        minutes : "",
        seconds : ""
      },
      locale: localStorage.getItem('lang')

    }
  },
  computed : {
    currentEvent(){
      return this.$store.getters.getCurrentEvent;
    },
    activeEvents(){
      return this.$store.getters.getActiveEvents.filter(event=>event.id !== this.currentEvent.id);
    },
    pastEvents(){
      return this.$store.getters.getPastEvents;
    },
    isCurrentEventActive(){
     if (typeof this.currentEvent !== 'undefined'){
       return this.currentEvent.finish > new Date().getTime();
     } else return false;
   },
   endOfCurrentPromotion(){

     let promFinish = moment(+this.currentEvent.finish);

  let now = moment(new Date().getTime());
  return promFinish.diff(now, 'days');

   }
 },

 mounted(){

   setInterval(()=>{
     let thisMoment = new Date();
     let now = moment(thisMoment);
     let eventFinish = moment(+this.currentEvent.finish);
     this.mainEventCounter.days = eventFinish.diff(now, 'days');
     this.mainEventCounter.hours = eventFinish.diff(now, 'hours')%24;
     this.mainEventCounter.minutes = eventFinish.diff(now, 'minutes')%60;
     this.mainEventCounter.seconds = eventFinish.diff(now, 'seconds')%60;
   }, 1000);
 }
}
</script>

<style lang="css">
</style>
