<template lang="html">
  <div class="col-12 calendars" >

    <transition enter-active-class="animated bounceIn"
                leave-active-class="animated fadeOut"
                mode="out-in"
                duration='300' appear>
    <component :is='activeView' @doSearch="search" @goBackToPick='showPickers'  :reservedDates='reserved'
    :arrivalDate="arrivalDate" :departureDate="departureDate"></component>
      </transition>
  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import {sr} from 'vuejs-datepicker/dist/locale'
import DatePickers from './DatePickers.vue';
import SearchResults from './SearchResults.vue';

export default {

  components: {
   Datepicker, DatePickers, SearchResults
 },
  data(){
    return {
     sr : sr,
     date: new Date(),
     message : null,
     success : null,
     failure : null,
     activeView : 'DatePickers',
     arrivalDate : null,
     departureDate : null

 }
},

methods: {
  search(data){
    this.activeView = 'SearchResults';
    this.arrivalDate = data.arrival;
    this.departureDate = data.departure;
    console.log('arrival...', data.arrival);
    console.log('departure...', data.departure);
  },
  showPickers(){
    this.activeView = 'DatePickers'
  }
},

computed : {
  reserved(){
    return this.$store.getters.getAllReservedDates;
  }
}



}
</script>

<style lang="css">
</style>
