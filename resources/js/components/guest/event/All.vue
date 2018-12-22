<i18n>
{
"sr": {
    "Popusti i sniženja" : "Popusti i sniženja",
    "Cijenimo Vašu lojalnost" : "Cijenimo Vašu lojalnost",
    "Pogledajte najnovije sniženje" : "Pogledajte najnovije sniženje",
    "Ostala sniženja" : "Ostala sniženja",
    "Najnovije sniženje" : "Najnovije sniženje",
    "dana" : "dan | dana",
    "sati" : "sat | sati",
    "minuta" : "minut | minuta",
    "sekundi" : "sekund | sekundi",
    "Saznajte više" : "Saznajte više",
    "Trenutno nije postavljeno glavno sniženje" : "Trenutno nije postavljeno glavno sniženje",
    "Ostala aktivna sniženja" : "Ostala aktivna sniženja",
    "aktivna do" : "aktivna do",
    "Trenutno nema drugih aktivnih sniženja" : "Trenutno nema drugih aktivnih sniženja"
},
  "en": {
    "Popusti i sniženja" : "Discounts",
    "Cijenimo Vašu lojalnost" : "We Appreciate Your Loyalty",
    "Pogledajte najnovije sniženje" : "See The Latest Discount",
    "Ostala sniženja" : "Other Discounts",
    "Najnovije sniženje" : "Latest Discount",
    "dana" : "day | days",
    "sati" : "hour | hours",
    "minuta" : "minute | minutes",
    "sekundi" : "second | seconds",
    "Saznajte više" : "See More Details",
    "Trenutno nije postavljeno glavno sniženje" : "There is no main discount active at the moment",
    "Ostala aktivna sniženja" : "Other Active Discounts",
    "aktivna do" : "Active by",
    "Trenutno nema drugih aktivnih sniženja" : "There is no other discounts active at the moment"
  },
  "ru" : {
    "Popusti i sniženja" : "Скидки",
    "Cijenimo Vašu lojalnost" : "Мы ценим вашу лояльность",
    "Pogledajte najnovije sniženje" : "Последняя скидка",
    "Ostala sniženja" : "Другие скидки",
    "Najnovije sniženje" : "Последняя скидка",
    "dana" : "день | дней",
    "sati" : "час | часов",
    "minuta" : "минуту | минут",
    "sekundi" : "секунду | секунд",
    "Saznajte više" : "Смотрите подробности",
    "Trenutno nije postavljeno glavno sniženje" : "Нет основной скидки",
    "Ostala aktivna sniženja" : "Другие активные скидки",
    "aktivna do" : "Заканчивается:",
    "Trenutno nema drugih aktivnih sniženja" : "В настоящий момент нет никаких других скидок"
  }
}
</i18n>




<template lang="html">
<div class="row discounts" id='#discounts'>

  <section class="discountsIntro col-12 pt-5 pb-5 mt-0 align-items-center d-flex bg-dark discountInto" style="height:100vh; background-size: cover; background-image: url(/images/discounts_background.jpg);">
   <div class="container-fluid introContainer">
   <!-- <div class="container-fluid" style="border: 2px solid red"> -->
      <div class="row  justify-content-center align-items-center d-flex text-center h-100">
        <div class="col-12 col-md-8  h-50 ">
            <h2 class="text-light titleBiggest"><strong>{{$t("Popusti i sniženja")}}</strong> </h2>
            <p class="lead  text-light mb-5">{{$t("Cijenimo Vašu lojalnost")}}.</p>
            <p>
              <router-link v-if="typeof mainEvent !== 'undefined'" class="goToMainDiscount title spaced btn  btn-round text-light btn-lg btn-rised" :to="{ name: 'viewDiscount', params: {id:mainEvent.id} }">
                {{$t("Pogledajte najnovije sniženje")}}
              </router-link>
              </p>


					<div class="btn-container-wrapper p-relative d-block  zindex-1">

						    <a class="goToOtherDiscounts btn btn-link btn-lg   mt-md-3 mb-4 scroll align-self-center text-light" href="#otherDiscounts">
                <h3 class='title'>{{$t("Ostala sniženja")}}</h3>
						    <i class="fa fa-angle-down fa-4x text-light"></i>
						    </a>
					</div>
        </div>

      </div>
    </div>
    </section>


    <div class="col-12  col-md-6 mainDiscRow">
      <div class="row mainDiscountCol" v-if="typeof mainEvent !== 'undefined'">
        <div class="col-12" >
          <h4 class='title mainDiscTitle spaced'>{{$t("Najnovije sniženje")}}</h4>
          <h1 class='title mainDiscName'>{{mainEvent.name[locale]}}</h1>

          <div class='row'>
            <div class="col-5 col-lg-3 counterCirlceCol">
              <button class="btn btn-default circle-button title">{{mainEventCounter.days}}  <br> {{$tc("dana",mainEventCounter.days)}}</button>
            </div>
            <div class="col-5 col-lg-3 counterCirlceCol">
                <button class="btn btn-default circle-button title">{{mainEventCounter.hours}}  <br> {{$tc("sati",mainEventCounter.hours)}}</button>
            </div>
            <div class="col-5 col-lg-3 counterCirlceCol">
                <button class="btn btn-default circle-button title">{{mainEventCounter.minutes}}  <br> {{$tc("minuta", mainEventCounter.minutes)}}</button>
            </div>
            <div class="col-5 col-lg-3 counterCirlceCol">
                <button class="btn btn-default circle-button title" id='counterSeconds'>{{mainEventCounter.seconds}} <br>  {{$tc("sekundi",mainEventCounter.seconds)}}</button>
            </div>
          </div>

        </div>

        <div class="col-12">

          <div class="mainDiscount">
            <div class="eventPreview">
              <p v-html="mainEvent.preview[locale]"></p>
            </div>

            <router-link v-if="typeof mainEvent !== 'undefined'" class='btn btn-secondary' :to="{ name: 'viewDiscount', params: {id:mainEvent.id} }">
              {{$t("Saznajte više")}}
            </router-link>
          </div>

        </div>
      </div>
      <div class="row mainDiscountCol" v-else>
       <h2 class='title'>{{$t("Trenutno nije postavljeno glavno sniženje")}}</h2>
      </div>
        <hr>
    </div>



    <div class="col-12 col-md-6 otherDiscountsCol" id="otherDiscounts">
      <div class="row">
        <div class="col-12">
         <h2 class='titleBig spaced'>{{$t("Ostala aktivna sniženja")}}</h2>
        </div>

        <div class="col-12 activeDiscounts" v-if="events.length">
       <div class="row">
      <div class="activeDiscount col-12" v-for='discount in events'>

       <h3 class='titleBiggest otherDiscName'>{{discount.name[locale]}}</h3>
       <div class="activeDiscountPreview">
         <h5 class='title'>
           {{$t("aktivna do")}}
            {{locale !== 'en'? moment(+discount.start).format("DD. MM. YYYY.") : moment(+discount.start).format("DD. MMMM YYYY.")}}</h5>
         <p v-html='discount.preview[locale]'></p>
       </div>

       <router-link v-if="typeof discount !== 'undefined'" class='btn btn-secondary' :to="{ name: 'viewDiscount', params: {id:discount.id} }">
         {{$t("Saznajte više")}}
       </router-link>

      </div>
    </div>
        </div>
        <div class="col-12 activeDiscounts" v-else>
          <h2 class="title">{{$t("Trenutno nema drugih aktivnih sniženja")}}</h2>
        </div>

      </div>
    </div>


</div>
</template>

<script>
var moment = require('moment');
export default {

  created(){
    this.$store.dispatch('guestGetEvents').then(
      ()=>{  setInterval(()=>{
          let thisMoment = new Date();
          let now = moment(thisMoment);
          let eventFinish = moment(+this.mainEvent.finish);
          this.mainEventCounter.days = eventFinish.diff(now, 'days');
          this.mainEventCounter.hours = eventFinish.diff(now, 'hours')%24;
          this.mainEventCounter.minutes = eventFinish.diff(now, 'minutes')%60;
          this.mainEventCounter.seconds = eventFinish.diff(now, 'seconds')%60;
        }, 1000);}
    );

  },
  mounted(){
  this.$store.dispatch('guestGetEvents');
    setInterval(()=>{
      $('#counterSeconds').toggleClass('circle-button-two')
    }, 1000);

    // setInterval(()=>{
    //   let thisMoment = new Date();
    //   let now = moment(thisMoment);
    //   let eventFinish = moment(+this.mainEvent.finish);
    //   this.mainEventCounter.days = eventFinish.diff(now, 'days');
    //   this.mainEventCounter.hours = eventFinish.diff(now, 'hours')%24;
    //   this.mainEventCounter.minutes = eventFinish.diff(now, 'minutes')%60;
    //   this.mainEventCounter.seconds = eventFinish.diff(now, 'seconds')%60;
    // }, 1000);
  },
  data(){
    return {
      moment : moment,
      mainEventCounter : {
        days : 0,
        hours : 0,
        minutes : 0,
        seconds : 0,
      },
      locale: localStorage.getItem('lang')
    }
  },
  computed : {
    events(){

        return this.$store.getters.getActiveEvents.filter(disc=>disc.id !== this.mainEvent.id);

    },
    mainEvent(){
      return this.$store.getters.getCurrentEvent;
    },
  },
  mounted(){


      $(".footer").css("display", "none");

  }
}
</script>

<style lang="css">
</style>
