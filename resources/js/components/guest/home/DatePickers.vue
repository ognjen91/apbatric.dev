<i18n>
{
"sr": {
    "Provjera dostupnosti" : "Provjera dostupnosti",
    "Datum dolaska" : "Datum dolaska",
    "Datum odlaska" : "Datum odlaska",
    "Molimo, izaberite validne datume" : "Molimo, izaberite validne datume",
    "Provjeri" : "Provjeri"
},
  "en": {
    "Provjera dostupnosti" : "Check Availability",
    "Datum dolaska" : "Arrival Date",
    "Datum odlaska" : "Departure Date",
    "Molimo, izaberite validne datume" : "Please, select valid dates",
    "Provjeri" : "Check"
  },
  "ru" : {
    "Provjera dostupnosti" : "Доступность",
    "Datum dolaska" : "Дата прибытия",
    "Datum odlaska" : "Дата отбытия",
    "Molimo, izaberite validne datume" : "Ошибка! Пожалуйста, проверьте даты",
    "Provjeri" : "Проверь"
  }
}
</i18n>

<template lang="html">

  <div class="row pickersRow">
    <div class="col-12">
      <h2 class="pickTitle title titleBiggest">{{$t('Provjera dostupnosti')}}</h2>
    </div>

<div class="col-xl-1 pickerHelper"></div>
    <div class="col-12 col-md-6 col-xl-5 pickerCol">
      <h4 calendarTitle>{{$t('Datum dolaska')}}</h4>
      <datepicker :language='calendarLang' @input="arrivalAction" :inline="true"  :value="arrival" :disabledDates="disabled"></datepicker>
    </div>

    <div class="col-12 col-md-6 col-xl-5 pickerCol">
      <h4 calendarTitle>{{$t('Datum odlaska')}}</h4>
      <datepicker :language='calendarLang' @input='departureAction' :inline="true"  :value="departure" :disabledDates="disabled"></datepicker>
    </div>
<div class="col-xl-1 pickerHelper"></div>

    <div class="col-12" v-if="error">
      <div class="alert alert-danger">
        <h3>{{$t('Molimo, izaberite validne datume')}}</h3>
      </div>
    </div>

    <div class="col-12 check">

         <div class="btn btn-secondary checkButton" @click="proceed">
           {{$t('Provjeri')}} !
         </div>

    </div>
  </div>

</template>

<script>
import Datepicker from 'vuejs-datepicker';
import {sr, en, ru} from 'vuejs-datepicker/dist/locale'
export default {
  components: {
   Datepicker
 },
 data(){
   return {
    sr : sr,
    en : en,
    ru : ru,
    date: new Date(),
    arrival : new Date().setHours(12,0,0,0),
    departure : new Date().setHours(12,0,0,0),
    error : false,
    locale: localStorage.getItem('lang')
}
},
computed : {
  disabled() {
      //treba biti onemoguceno zakljucno sa jucerasnjim datumom
      var d = new Date();
      d.setDate(d.getDate() - 1);
      return {
          to: d
      }
  },
  calendarLang(){
    if (this.locale == "en"){
      return this.en;
    } else if (this.locale == "ru"){
      return this.ru;
    } else {
      return this.sr;
    }
  }
},

methods : {
  proceed(){

    if (!this.arrival || !this.departure || this.arrival > this.departure){
      console.log("STOP");
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

    //prilagođavanje odlaznog kalendara
    if (this.arrival > this.departure) this.departure = this.arrival;

  },
  departureAction(e){
    this.departure = e.setHours(12,0,0,0);

    //prilagođavanje dolaznog kalendara
    if (this.departure < this.arrival) this.arrival = this.departure;
  }
},
mounted(){
  // console.log("!!!!!", sr.language);
}

}
</script>

<style lang="css">
</style>
