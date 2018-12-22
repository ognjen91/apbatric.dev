<i18n>
{
"sr": {
    "Pratite nas na društvenim mrežama" : "Pratite nas na društvenim mrežama"
},
  "en": {
    "Pratite nas na društvenim mrežama" : "Follow us on social media "
  },
  "ru" : {
    "Pratite nas na društvenim mrežama" : "Следуйте за нами в социальных сетях"
  }
}
</i18n>

<template lang="html">
  <div class="col-12 socialLinks random">
    <h4 class='titleBiggest'>{{$t('Pratite nas na društvenim mrežama')}}</h4>
    <div>
      <div class="fbLink socialLink">
        <div>
          <a :href="'http://' + contact.facebook">
            <img src="/images/facebook.png" alt="">
          </a>
          </div>
      </div>
      <div class="instaLink socialLink">
        <div>
          <a :href="'http://' + contact.instagram">
            <img src="/images/instagram.png" alt="">
          </a>
        </div>
      </div>
    </div>

    <hr>

  </div>
</template>

<script>
export default {
  data(){
    return {
        locale: localStorage.getItem('lang')
    }
  },
  computed : {
    contact(){
      return this.$store.getters.getContact;
    }
  }
}
</script>

<style lang="css">
</style>
