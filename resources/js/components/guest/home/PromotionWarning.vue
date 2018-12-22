<i18n>
{
"sr": {
    "Popust" : "Popust",
    "je aktivan" : "je aktivan",
    "više detalja" : "više detalja"
},
  "en": {
    "Popust" : " ",
    "je aktivan" : "discount is active.",
    "više detalja" : "See details"
  },
  "ru" : {
    "Popust" : "Скидка : ",
    "je aktivan" : "",
    "više detalja" : "Смотрите подробности"
  }
}
</i18n>

<template lang="html">
  <div class="col-12 topDiscount" v-if='isActive && isShown && showDiscountDanger'>

    <div class="closeTopDiscount" @click='closeTopDiscount'>{{closeCountdown}}</div>
    <div class="">
      <h3 class='titleSmall topDiscTitle'>{{$t('Popust')}} {{mainDiscount.name[locale]}} {{$t('je aktivan')}}</h3>
      <h4 class="goToDiscDetails spaced"><router-link class='textSpaced2 underlined':to="{ name: 'viewDiscount', params: {id:mainDiscount.id} }">
        {{$t('više detalja')}}
      </router-link></h4>

    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      isShown : true,
      closeCountdown : 4,
      locale: localStorage.getItem('lang')

    }
  },

  computed : {
    mainDiscount(){
      return this.$store.getters.getCurrentEvent;
  },
    isActive(){
      let now = + new Date();
      if (typeof this.mainDiscount !== 'undefined'){
        return +this.mainDiscount.finish > now;
      } else {
        return false;
      }

    },

    showDiscountDanger(){
      return this.$store.getters.showDiscountDanger;
    }
},
 methods :{
   closeTopDiscount(){
     this.isShown = false;
   }
 },

 mounted(){
   setTimeout(()=>{this.isShown = false}, 5000);
   setInterval(()=>{
     this.closeCountdown--;
     if (this.closeCountdown == 0) this.isShown = false;
   }, 1000);
 }
}
</script>

<style lang="css">
</style>
