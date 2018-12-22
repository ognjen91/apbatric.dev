<template lang="html">
  <div>
    <div class="admin_edit_calendar">
      <h4 @click='konzoluj'>Izmjena kalendara za jedinicu {{room.name.sr}}</h4>

        <!-- <datepicker :inline="true" @input="calendarAction" :value="date"></datepicker> -->
      <datepicker :language='sr' :inline="true" @input="calendarAction" :value="date" :highlighted="highlighted" :disabledDates="disabled"></datepicker>
     <div class="update_message" v-if="message"  :class="{'update_cal_message':true, 'alert':true, 'alert-success':success, 'alert-danger':failure}">
       {{message}}
     </div>
<div class="btn btn-success calendar_save save_calendar" @click="saveCalendar">Sačuvajte izmjene!</div>

    </div>

  </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
import {sr} from 'vuejs-datepicker/dist/locale'
export default {
  components: {
   Datepicker
 },
 data(){
   return {
    sr : sr,
    date: new Date(),
    reserved_dates : [],
    room : {},
    // disabled : {
    //   to : new Date()
    // },
    message : null,
    success : null,
    failure : null
}
},

methods : {
  calendarAction(e){
    //proglasicu podne moje vremenske zone za vrijeme za poredjenje
    let date_selected = e.setHours(12,0,0);
    let is_free;
    is_free = this.reserved_dates.every(date => {if (date === date_selected) return false
    else return true});

    if(is_free){
      this.reserved_dates.push(date_selected);
    } else {
      for (var i = 0; i < this.reserved_dates.length; i ++) {
          if (this.reserved_dates[i] == date_selected) {
              this.reserved_dates.splice(i, 1);
              break;
          }
      }
    }
    console.log(this.reserved_dates);

},

saveCalendar(){
  axios.post('/api/calendars/' + this.$route.params.id, {reserved_dates : this.reserved_dates})
  .then((response)=>{
    if(response.status == 200){
      this.success = true;
      this.failure = false;
      this.message = response.data.message
    } else {
      this.success = false;
      this.failure = true;
      this.message = response.data.message
    }
  })
},

konzoluj(){
console.log("REZERVISANO", this.reserved_dates);
}

},

computed : {
 highlighted(){
  let date_objects_array = [];
  this.reserved_dates.forEach(date=>{date_objects_array.push(new Date(date))})
  return {
    dates : date_objects_array
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
  rooms(){
    return this.$store.getters.getRooms;
  }

},
created(){

  axios.get('/api/calendars/' + this.$route.params.id)
  .then((response)=>{
    this.reserved_dates = JSON.parse(response.data.reserved_dates);
  })

  if(this.rooms.length){
    this.room = this.rooms.find((pot_room)=> pot_room.id == this.$route.params.id)
  }else{
  axios.get('/api/room/' + this.$route.params.id)
  .then((response)=>{
      this.room = response.data.room[0];
  })
}


},

}
</script>

<style lang="css">
</style>
