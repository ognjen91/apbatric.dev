<template lang="html">
  <div class='row mailsRow'>

  <div class="col-12 mailMenu">
    <router-link :to="{ name: 'newMail', params: {} }" tag='div' active-class="mailActiveLink"><a>Pošaljite novi mail gostima</a></router-link>
    <router-link :to="{ name: 'guestsList', params: {} }" tag='div' active-class="mailActiveLink"><a>Baza mailova gostiju</a></router-link>
  </div>



    <div class="col-12 col-sm-6 col-md-8 col-lg-9 mailMain">
      <h2 v-if="routeName == 'mailHome'">Molimo, odaberite mail za pregledanje, <router-link :to="{ name: 'newMail', params: {} }">kreirajte novi</router-link>, ili <router-link :to="{ name: 'guestsList', params: {} }">uređujte kontakte</router-link></h2>
      <router-view></router-view>
    </div>

    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mailAside">
      <ul v-if="mails.length" class='listedMails'>
        <h3 style="margin-bottom : 3%;">Poslati mailovi</h3>
        <router-link active-class="activeMail" exact v-for="mail in mails" :to="{ name: 'viewMessage', params: {id : mail.id} }" tag='li' :key="mail.id"><a>{{mail.title}} <br> <small>{{moment(mail.created_at).format("DD. MM. YYYY.")}}</small></a></router-link>
      </ul>
      <h3 v-else>Niste poslali nijedan mail</h3>
    </div>

  </div>
</template>

<script>
var moment = require('moment');
export default {
  mounted(){

    axios.get('/api/mails').
    then((response)=>{
      this.mails = response.data.mails.reverse();
    })
  },
  data(){
    return {
      moment : moment,
      mails : [],
      routeName : this.$route.name
    }
  }
}
</script>

<style lang="css">
</style>
