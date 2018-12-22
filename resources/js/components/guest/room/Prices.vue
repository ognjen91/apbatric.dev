<i18n>
{
"sr": {
    "Od" : "Od",
    "Do" : "Do",
    "Cijena" : "Cijena"
},
  "en": {
    "Od" : "From",
    "Do" : "To",
    "Cijena" : "Price"
  },
  "ru" : {
    "Od" : "Oт",
    "Do" : "До",
    "Cijena" : "Цена"
  }
}
</i18n>



<template lang="html">
  <div class="row pricesRow">

<div class="roomPrices col-10 col-md-8">
    <table class="table table-striped">
    <tr class='pricesHead text spaced'>
        <th>{{$t("Od")}}</th>
        <th>{{$t("Do")}}</th>
        <th>{{$t("Cijena")}} (&euro;)</th>
      </tr>
      <tr v-for="period in prices">
        <td class="title">{{period.from}}</td>
        <td class="title">{{period.to}}</td>
        <td class="title">{{period.price}}</td>
      </tr>

    </table>
    </div>


  </div>
</template>

<script>
export default {
  data(){
    return {
        locale: localStorage.getItem('lang')
    }
  },
  props : {
    prices : Object
  }
}
</script>

<style lang="css">
</style>
