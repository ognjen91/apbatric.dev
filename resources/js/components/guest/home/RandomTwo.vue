<i18n>
{
"sr": {
    "Popusti tokom cijele godine" : "Popusti tokom cijele godine",
    "brinemo o našim gostima" : "brinemo o našim gostima"
},
  "en": {
    "Popusti tokom cijele godine" : "Check The Discounts Page",
    "brinemo o našim gostima" : "find the right discount for yourself"
  },
  "ru" : {
    "Popusti tokom cijele godine" : "Cкидки для вас",
    "brinemo o našim gostima" : "Мы Вас ждем"
  }
}
</i18n>

<template lang="html">
  <div class="col-12 second random">

      <h3 class="titleBiggest">{{$t('Popusti tokom cijele godine')}}</h3>
      <h5 class='titleSmall'>{{$t('brinemo o našim gostima')}}</h5>

  </div>
</template>

<script>
export default {
  data(){
    return {
        locale: localStorage.getItem('lang')
    }
  }
}
</script>

<style lang="css">
</style>
