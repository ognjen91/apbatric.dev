<i18n>
{
"sr": {
    "Dostupnost" : "Dostupnost",
    "Datum dolaska" : "Datum dolaska",
    "klik na polje za odabir datuma" : "klik na polje za odabir datuma",
    "Datum odlaska" : "Datum odlaska",
    "Nastavi" : "Nastavi",
    "Molimo izaberite validne datume" : "Molimo izaberite validne datume"
},
  "en": {
    "Dostupnost" : "Availability",
    "Datum dolaska" : "Arrival Date",
    "klik na polje za odabir datuma" : "click on the field to show calendars",
    "Datum odlaska" : "Departure Date",
    "Nastavi" : "Continue",
    "Molimo izaberite validne datume" : "Please, select valid dates"
  },
  "ru" : {
    "Dostupnost" : "Доступность",
    "Datum dolaska" : "Дата прибытия",
    "klik na polje za odabir datuma" : "нажмите на поле, чтобы отображать календари",
    "Datum odlaska" : "Дата отбытия",
    "Nastavi" : "Продолжить",
    "Molimo izaberite validne datume" : "Ошибка! Пожалуйста, проверьте даты"
  }
}
</i18n>


<template lang="html">
  <div class="row roomCalendars">
    <div class="col-12 roomCalendarsTitle">
      <h3 class="titleBigger spaced">{{$t("Dostupnost")}}</h3>
    </div>


    <!-- ==========KALENDARI ZA MALE EKRANE============ -->
    <div class="col-12 col-md-6 pickerCol roomCalendar smallCalendar">
      <h4 class="calendarTitle">{{$t("Datum dolaska")}}</h4>
      <h6 class='text-center'>({{$t("klik na polje za odabir datuma")}})</h6>
      <datepicker :language='calendarLang' @input="arrivalAction" :inline="false"  :value='arrival' :disabledDates="disabled" :highlighted="reservedDates"></datepicker>
    </div>
    <div class="col-12 col-md-6 pickerCol roomCalendar smallCalendar">
      <h4  class="calendarTitle">{{$t("Datum odlaska")}}</h4>
      <h6 class='text-center'>({{$t("klik na polje za odabir datuma")}})</h6>
      <datepicker :language='calendarLang' @input='departureAction' :inline="false"  :value='departure' :disabledDates="disabled" :highlighted="reservedDates"></datepicker>
    </div>

    <!-- ==========KALENDARI ZA VELIKE EKRANE============ -->
    <div class="col-12 col-md-6 pickerCol roomCalendar bigCalendar">
      <h4 class="calendarTitle">{{$t("Datum dolaska")}}</h4>
      <datepicker :language='calendarLang' @input="arrivalAction" :inline="true"  :value='arrival' :disabledDates="disabled" :highlighted="reservedDates"></datepicker>
    </div>
    <div class="col-12 col-md-6 pickerCol roomCalendar bigCalendar">
      <h4  class="calendarTitle">{{$t("Datum odlaska")}}</h4>
      <datepicker :language='calendarLang' @input='departureAction' :inline="true"  :value='departure' :disabledDates="disabled" :highlighted="reservedDates"></datepicker>
    </div>

<div class="col-12 checkAvailability">
    <div class="btn checkButton checkButtonRoom" @click="proceed">
      {{$t("Nastavi")}}!
    </div>
    <div class="col-12 alert alert-danger" v-if='error'>
      <h5 class='title'>{{$t("Molimo izaberite validne datume")}}!</h5>
    </div>
</div>

<transition enter-active-class="animated slideInRight"
            leave-active-class="animated slideOutRight"
            mode="out-in"
            duration='800'>
 <div class="col-12 sendMailAboutRoom" v-if="searchSuccess">
   <SendRoomMail :roomName="roomName" :arrival="arrival" :departure='departure' @closeForm="closeForm" />
 </div>
</transition>


  </div>
</template>

<script>

import SendRoomMail from './SendRoomMail.vue'
import Datepicker from 'vuejs-datepicker';
import {sr} from 'vuejs-datepicker/dist/locale'
export default {
  components: {
   Datepicker, SendRoomMail
 },
 props : {
   reservedTimestamps : Array,
   roomName : Object
 },
  data(){
    return {
      sr : sr,
      date: new Date(),
      arrival : new Date().setHours(12,0,0,0),
      departure : new Date().setHours(12,0,0,0),
      error : false,
      searchSuccess : false,
      locale: localStorage.getItem('lang')
    }
},

methods : {
  //prikaz slike
  showBig(e){
    let imgSrc = e.explicitOriginalTarget.attributes.src.nodeValue;
    $('#bigImg').css("background-image", "url("+ imgSrc +")");
  },
  proceed(){
    this.searchSuccess = false;
    this.error = false;
    if (!this.arrival || !this.departure || this.arrival > this.departure){
      this.error = true;
      setTimeout(()=>{this.error = false}, 4000);
      this.searchSuccess = false;
      return;
    }
   console.log('asdasdsadsa');
    // let date_selected = e.setHours(12,0,0);
    let is_free;
    is_free = this.reservedTimestamps.every(
      date => {
        if (date > this.arrival && date<this.departure) return false
        else
        return true
      });

    if (is_free){this.searchSuccess = true} else {this.error = true};


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
  },
  closeForm(){
    this.searchSuccess = false;
  }
},

computed : {
  reservedDates(){
    let datesArray = [];
    this.reservedTimestamps.forEach(timestamp=>{
      datesArray = [...datesArray, new Date(timestamp)]
    })
    return {
      dates : datesArray
    }
  },
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
}
}
</script>

<style lang="css" scoped>

</style>
