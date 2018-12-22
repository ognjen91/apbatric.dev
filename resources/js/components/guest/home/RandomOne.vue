<i18n>
{
"sr": {
    "Odmor u srcu Boke" : "Odmor u srcu Boke",
    "mir i tišina čekaju na Vas" : "mir i tišina čekaju na Vas"
},
  "en": {
    "Odmor u srcu Boke" : "Comfort",
    "mir i tišina čekaju na Vas" : "in quiet part of The Bay of Kotor"
  },
  "ru" : {
    "Odmor u srcu Boke" : "Комфорт ",
    "mir i tišina čekaju na Vas" : "апартаменты в сердце Боки"
  }
}
</i18n>


<template lang="html">
  <div class="col-12 first random">

     <h3 class="titleBiggest">{{$t('Odmor u srcu Boke')}}</h3>
     <h5 class='titleSmall'>{{$t('mir i tišina čekaju na Vas')}}</h5>
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
