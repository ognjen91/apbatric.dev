<i18n>
{
"sr": {
    "Kuhinja" : "Kuhinja",
    "Kupatilo" : "Kupatilo",
    "Terasa" : "Terasa",
    "TV" : "TV",
    "Klima uređaj" : "Klima uređaj",
    "WiFi" : "WiFi"
},
  "en": {
    "Kuhinja" : "Kitchen",
    "Kupatilo" : "Bathroom",
    "Terasa" : "Terrace",
    "TV" : "TV",
    "Klima uređaj" : "Air Conditioner",
    "WiFi" : "WiFi"
  },
  "ru" : {
    "Kuhinja" : "Кухня",
    "Kupatilo" : "Ванная",
    "Terasa" : "Tерраса",
    "TV" : "TV",
    "Klima uređaj" : "Кондиционер",
    "WiFi" : "WiFi"
  }
}
</i18n>



<template lang="html">
  <div class="row">

<div class="col-4 amenity" v-if='+room.kitchen'>
        <div>
          <img src="/images/kitchen.png" alt="kitchen icon">
        </div>
      <p class='titlte spaced'>{{$t("Kuhinja")}}</p>
</div>
<div class="col-4 amenity" v-if='+room.bathroom'>
        <div>
          <img src="/images/bathroom.png" alt="bathroom icon">
        </div>
     <p class='titlte spaced'>{{$t("Kupatilo")}}</p>
</div>
<div class="col-4 amenity" v-if='+room.terrace'>
        <div>
          <img src="/images/terrace.png" alt="kitchen icon">
        </div>
    <p class='titlte spaced'>{{$t("Terasa")}}</p>
</div>
<div class="col-4 amenity" v-if='+room.kitchen'>
      <div>
        <img src="/images/tv.png" alt="tv icon">
      </div>
   <p class='titlte spaced'>{{$t("TV")}}</p>
</div>
<div class="col-4 amenity" v-if='+room.air_conditioner'>
      <div>
        <img src="/images/air-conditioner.png" alt="air conditioner icon">
      </div>
  <p class='titlte spaced'>{{$t("Klima uređaj")}}</p>
</div>
<div class="col-4 amenity" v-if='+room.wifi'>
    <div>
      <img src="/images/wifi.png" alt="wifi icon">
    </div>
 <p class='titlte spaced'>{{$t("WiFi")}}</p>
</div>

  </div>

</template>

<script>
export default {
  props : {
    room : Object
  },
  data(){
    return {
        locale: localStorage.getItem('lang')
    }
  }
}
</script>

<style lang="css">
</style>
