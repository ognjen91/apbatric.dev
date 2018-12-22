<i18n>
{
"sr": {
    "Greška" : "Greška",
    "Idite na početnu stranu" : "Kliknite za povratak na početnu stranicu"
},
  "en": {
    "Greška" : "Error",
    "Idite na početnu stranu" : "Click to go to Homepage"
  },
  "ru" : {
    "Greška" : "Oшибка",
    "Idite na početnu stranu" : "Нажмите, чтобы перейти на главную страницу"
  }
}
</i18n>



<template lang="html">


  <div class="row errorPage">
    <div class="col-12">
      <h1 class="text spaced">{{$t("Greška")}}!</h1>
      <h3 @click='goBack' class='text spaced'>{{$t("Idite na početnu stranu")}}</h3>
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
  methods : {
    goBack(){
      this.$router.push({name:"home"})
    }
  }
}
</script>

<style lang="css">
</style>
