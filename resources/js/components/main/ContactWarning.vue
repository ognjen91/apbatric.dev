<i18n>
{
"sr": {
    "naslov upozorenja" : "Radovi na sajtu",
    "tekst upozorenja" : "Poštovani posjetioci, trenutno su u toku radovi na sajtu. Molimo vas da, dok radovi traju, kontaktirate nas direktno putem e-maila:",

    "ili putem telefona" : "ili putem telefona",
    "potpis" : "S poštovanjem, Apartmani Batrićević"
},
  "en": {
    "naslov upozorenja" : "The site is under maintance",
    "tekst upozorenja" : "Dear visitors, while the site is under maintance, please contact us directly by email:",

    "ili putem telefona" : "or by phone",
    "potpis" : "Apartmani Batrićević"
  },
  "ru" : {
    "naslov upozorenja" : "Режим технического обслуживания",
    "tekst upozorenja" : "Уважаемые посетители, и сайт находится под техническим обслуживанием, свяжитесь с нами напрямую по электронной почте:",

    "ili putem telefona" : "или по телефону",
    "potpis" : "C уважением, Апартаменты Батричевичей"
  }
}
</i18n>

<template lang="html">
<div class="contactWarning" id='contactWarning'>
  <div class="warning">
    <h1><i class="fas fa-exclamation-triangle"></i><strong>{{$t("naslov upozorenja")}}</strong></h1>
    <h3>{{$t("tekst upozorenja")}}</h3>
    <p><strong>rbatricevic@yahoo.com</strong>
    <br>
    {{$t("ili putem telefona")}} : <strong>+381 64/2011000</strong></p>
    <h4>{{$t("potpis")}}</h4>
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
  created(){

   setTimeout(()=>{

     $("#contactWarning").fadeIn('slow', function(){
       $("#contactWarning").addClass("goToCenter")
     })

   },2000);

  }
}
</script>

<style lang="css" scoped>

.contactWarning{
  position: absolute;
  left: 0;
  width: 100vw;
  z-index: 1000;
  display: none;


  text-align: center;
}

.warning{
  padding: 2% 1%;
  display: block;
  margin: 0 auto;
  background-color: rgba(238, 179, 45, 0.79);
  width: 80%;
  border: 2px solid black;
  text-align: center;
}

i{
  margin: 0 3%;
}

.goToCenter{
-webkit-animation: toCenter linear 1.5s forwards;
animation: toCenter linear 1.5s forwards;
-moz-animation: toCenter linear 1.5s forwards;
-o-animation: toCenter linear 1.5s forwards;
}


@-webkit-keyframes toCenter {
0% {top: 0}
50% {top: 22%}
100% {top: 45%}
}

@-moz-keyframes toCenter{
  0% {top: 0}
  50% {top: 22%}
  100% {top: 45%}
}

@keyframes toCenter {
  0% {top: 0}
  50% {top: 22%}
  100% {top: 45%}
    }
@-o-keyframes toCenter {
  0% {top: 0}
  50% {top: 22%}
  100% {top: 45%}

}

</style>
