<template lang="html">
  <div class="row">
    <div class="col-12" v-if="mail">
         <h2 class="mailTitle"><strong>Naslov: </strong>{{mail.title}}</h2>
         <hr>
         <div>
           <p><strong>Poslato na: </strong><span v-for="recept in to">{{recept}},&nbsp;</span> </p>
         </div>
         <hr>
         <div class="mailBody">
           <h3>Tekst poruke</h3>
           <p>{{mail.body}}</p>
         </div>

    </div>
  </div>
</template>

<script>
export default {
  created(){
    axios.get('/api/mail/'+ this.$route.params.id).
    then((response)=>{
      this.mail = response.data.mail;
      // console.log(response.data.mail.to);
      this.to = JSON.parse(response.data.mail.to);

    })
  },
  data(){
    return {
      mail : null,
      to : []
    }
  },
  watch: {
    '$route.params.id': function (id) {
      axios.get('/api/mail/'+ id).
      then((response)=>{
        this.mail = response.data.mail;
        // console.log(response.data.mail.to);
        this.to = JSON.parse(response.data.mail.to);
    })
  }
}
}
</script>

<style lang="css">
</style>
