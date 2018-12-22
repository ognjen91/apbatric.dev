<template lang="html">
<div class='row'>

<div class="col-12">
  <div class="col-12 adminNavLink">
    <router-link :to="{ name: 'adminDashboard', params: {} }">
      Nazad
    </router-link>
  </div>


    <form @submit.prevent="submitEvent" v-if="!errorReceiveEvent">
    <!-- INFORMACIJE O PROMOCIJI -->
    <EditInfo :event="event" />
     <!-- //INFORMACIJE O PROMOCIJI -->
        <hr>


        <!-- VRIJEME PROMOCIJE -->
        <div class="setPromotionPeriod">
            <div class="promotion_start">
                <h4><strong>Početak promocije</strong></h4>
                <datepicker :value='promotionStart' :language='sr' :inline="true" @input="prom_start_action" :disabledDates="disabled"></datepicker>
                <div class="form-group">
                    <label for="exampleSelect1">Vrijeme početka promocije</label>
                    <select class="form-control" id="exampleSelect1" v-model="prom_start_hour">
                      <option value="0">00 : 00</option>
                      <option v-for='n in 23' :value="n">{{n<10? "0"+n : n}} : 00</option>
                    </select>
                </div>
            </div>

            <div class="promotion_finish">
                <h4><strong>Kraj promocije</strong></h4>

                <datepicker :value='promotionFinish' :language='sr' :inline="true" @input="prom_finish_action" :disabledDates="disabled"></datepicker>
                <div class="form-group">
                    <label for="exampleSelect1">Vrijeme početka promocije</label>
                    <select class="form-control" id="exampleSelect1" v-model="prom_finish_hour">
                      <option value="0">00 : 00</option>
                      <option v-for='n in 23' :value="n">{{n<10? "0"+n : n}} : 00</option>
                    </select>
                </div>
            </div>
        </div>
           <!-- //VRIJEME PROMOCIJE -->



        <!-- POVRATNE INFORMACIJE -->
        <div class="newEventError alert alert-danger" v-if='pickDateError'>
            <h4 style="text-align: center;">Molimo odaberite validne datume</h4>
        </div>
        <div class="otherErrors alert alert-danger" v-if='otherErrors'>
            <ul>
                <li v-for='error in otherErrorsMsgs'>{{error}}</li>
            </ul>
        </div>
        <div class="alert alert-success" v-if='success'>
            <h4 style="text-align: center;">Promocija usješno izmjenjena.</h4>
        </div>
        <!-- //POVRATNE INFORMACIJE -->

        <button type="submit" class="btn btn-primary">Sačuvajte izmjene</button>

    </form>

    <div v-else>
        <h4>Greška! Bićete prebačeni na admin početnu stranu.</h4>
    </div>
</div>
</div>
</template>

<script>
var moment = require('moment');
import EditInfo from './EditInfo.vue'

import Datepicker from 'vuejs-datepicker';
import {sr} from 'vuejs-datepicker/dist/locale'
export default {
  components: {
   Datepicker, EditInfo
 },
  data(){
    return {
      sr: sr,
      moment : moment,
      event : null,
      //  {
      //     name: {
      //       sr : '',
      //       en : '',
      //       ru : ''
      //     },
      //     preview: {
      //       sr : '',
      //       en : '',
      //       ru : ''
      //     },
      //     description: {
      //       sr : '',
      //       en : '',
      //       ru : ''
      //     },
      //     start: null,
      //     finish: null,
      // },
      error : null,
      errorReceiveEvent : false,
      prom_start_hour : 12,
      prom_finish_hour : 12,
      pickDateError : false,
      otherErrors : false,
      otherErrorsMsgs : [],
      success : false,
      promotionStart : null,
      promotionFinish : null,
    }
  },
  computed :{
    disabled(){
      //treba biti onemoguceno zakljucno sa jucerasnjim datumom
      var d = new Date();
      d.setDate(d.getDate() - 1);
      return {
        to : d
      }
    }
  },
  mounted(){
    const router = this.$router;
    axios.get('/api/events/' + this.$route.params.id)
    .then((response)=>{
        this.event = response.data.event;
        this.event.name = JSON.parse(this.event.name);
        this.event.description = JSON.parse(this.event.description);
        this.event.preview = JSON.parse(this.event.preview);

        this.promotionStart = new Date(+response.data.event.start);
        this.promotionFinish = new Date(+response.data.event.finish);

        this.prom_start_hour = moment(+response.data.event.start).get('hour');
        this.prom_finish_hour = moment(+response.data.event.finish).get('hour');


    },
    (error) => {
        this.errorReceiveEvent = true;
        setTimeout(()=>{router.push({name:'adminDashboard'})}, 5000);
      }).
      catch(
        (error)=>{
          this.errorReceiveEvent = true;
          setTimeout(()=>{router.push({name:'adminDashboard'})}, 5000);

        }
      )
  },


  methods : {
    prom_start_action(e){
      this.event.start = e.setHours(this.prom_start_hour,0,0);
      this.promotionStart = new Date(this.event.start);
    },

    prom_finish_action(e){
      this.event.finish = e.setHours(this.prom_finish_hour,0,0);
      this.promotionFinish = new Date(this.event.finish);
    },

    submitEvent(){
      this.event.start = moment(+this.event.start).set('hour', this.prom_start_hour).valueOf();
      this.event.finish = moment(+this.event.finish).set('hour', this.prom_finish_hour).valueOf();

      if (!this.event.start || !this.event.finish || this.event.start > this.event.finish){
        this.pickDateError = true
      } else {
        this.pickDateError = false;
        axios.post('/api/events/'+this.$route.params.id , this.$data.event)
        .then(
          (response) => {
            const router = this.$router;
             this.success = true;
             setTimeout(function(){
               router.push({name: "adminDashboard"});
             }, 3000)
          },
          (error) => {
            if(error.response.status == 422){
              this.otherErrors = true;
              this.otherErrorsMsgs = error.response.data.errors;
              console.log(this.otherErrors);
            }
            if(error.response.status ==  500){
              this.otherErrors = true;
              this.otherErrorsMsgs = [];
              this.otherErrorsMsgs = [...this.otherErrorsMsgs, "Greška"];
            }
          }
  )
        .catch((error) => {
          console.log(error);
          this.otherErrors = true;
          this.otherErrorsMsgs = [...this.otherErrorsMsgs, "Greška"];
        }
      )
      }
    }

  }


}
</script>

<style lang="css">
</style>
