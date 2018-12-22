<i18n>
{
"sr": {
    "Kontaktirajte nas" : "Kontaktirajte nas",
    "Pošalji" : "Pošalji",
    "Poruka poslata. Odgovorićemo u najkraćem roku." : "Poruka poslata. Odgovorićemo u najkraćem roku.",
    "S poštovanjem, Apartmani Batrićević" : "S poštovanjem, Apartmani Batrićević",
    "Greška pri slanju poruke" : "Greška pri slanju poruke",
    "Kontakt informacije" : "Kontakt informacije"
},
  "en": {
    "Kontaktirajte nas" : "Contact Us",
    "Pošalji" : "Send",
    "Poruka poslata. Odgovorićemo u najkraćem roku." : "Message sent. We will answer soon.",
    "S poštovanjem, Apartmani Batrićević" : " ",
    "Greška pri slanju poruke" : "Eroor",
    "Kontakt informacije" : "Contact Info"
  },
  "ru" : {
    "Kontaktirajte nas" : "Связаться с нами",
    "Pošalji" : "Представить",
    "Poruka poslata. Odgovorićemo u najkraćem roku." : "Сообщение отправлено. Мы ответим в ближайшее время.",
    "S poštovanjem, Apartmani Batrićević" : " ",
    "Greška pri slanju poruke" : "Ошибка",
    "Kontakt informacije" : "Контактная информация"
  }
}
</i18n>


<template lang="html">
  <div class="row contactPage">

  <div class="col-12 col-md-10 contactInfo">

    <div class="row" id="contact">
  <div class="container mt-5" >

  <div class="row" style="height:550px;">

    <div class="col-md-6">
      <h2 class="text-uppercase mt-3 font-weight-bold text-white ">{{$t('Kontaktirajte nas')}}</h2>
      <form @submit.prevent='sendMsg'>
        <div class="row">
          <div class="col-lg-6">
            <div class="form-group">
              <input type="text" class="form-control mt-2" placeholder="Ime/Name/Имя" required v-model="message.from">
            </div>
          </div>

          <div class="col-lg-6">
            <div class="form-group">
              <input type="email" class="form-control mt-2" placeholder="Email" required v-model='message.email'>
            </div>
          </div>

          <div class="col-12">
            <div class="form-group">
              <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Poruka/Message/Сообщение" rows="3" required v-model="message.text"></textarea>
            </div>
          </div>

          <div class="col-12">
            <button class="btn btn-light sendMsgToOwner" type="submit">{{$t('Pošalji')}}</button>
          </div>
        </div>

<!-- =============IZVJESTAJI SA TRANZICIJOM================ -->
        <transition enter-active-class="animated flipInX"
                    leave-active-class="animated fadeOut"
                    mode="out-in"
                    duration='800'>
        <div class="row" v-if="success">
          <div class="col-10 alert alert-success" style="margin-left: 5%; ">
          <h5>{{$t('Poruka poslata. Odgovorićemo u najkraćem roku.')}} <br> {{$t('S poštovanjem, Apartmani Batrićević')}}</h5>
        </div>
        </div>
          </transition>

        <transition enter-active-class="animated flipInX"
                    leave-active-class="animated fadeOut"
                    mode="out-in"
                    duration='800'>
                    <div class="row" v-if="failure">
                      <div class="col-10 alert alert-danger" style="margin-left: 5%; ">
                      <h5>{{$t('Greška pri slanju poruke')}}!</h5>
                    </div>
                    </div>
        </transition>
        <!-- =============//IZVJESTAJI SA TRANZICIJOM================ -->


      </form>
      <div class="text-white">
      <h2 class="text-uppercase mt-4 font-weight-bold">{{$t('Kontakt informacije')}}</h2>

      <i class="fas fa-phone mt-3"></i> <a href="tel:+">{{contact.phone1}}</a><br>
      <i class="fas fa-phone mt-3"></i> <a href="tel:+">{{contact.phone2}}</a><br>
      <i class="fa fa-envelope mt-3"></i> <a href="">{{contact.email}}</a><br>
      <i class="fas fa-globe mt-3"></i> {{contact.adress}}<br>
      <div class="my-4">
      <a :href="'http://' + contact.facebook" v-if="contact.facebook"><i class="fab fa-facebook fa-3x pr-4"></i></a>
      <a :href="'http://' + contact.instagram" v-if="contact.instagram"><i class="fab fa-instagram fa-3x"></i></a>
      <a  class="skypeContact" v-if="contact.skype"><i class="fab fa-skype fa-3x"></i>{{contact.skype}}</a>
      </div>
      </div>
    </div>
    <div class="col-md-6 maps" >
       <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d11880.492291371422!2d12.4922309!3d41.8902102!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x28f1c82e908503c4!2sColosseo!5e0!3m2!1sit!2sit!4v1524815927977" frameborder="0" style="border:0" allowfullscreen></iframe> -->
       <iframe src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJpfZXJew6TBMRJVl2EQ7mB8Y&key=AIzaSyBFNg5lqCTKLe5qjDySmxw-XXf_q-TYU7A" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>

  </div>
  </div>
  </div>

  </div>

  <aside class="col-12 col-md-2 contactAside">
     <contactAside/>
  </aside>
  </div>
</template>

<script>
import contactAside from "./ContactAside.vue";
export default {
  components : {
    contactAside
  },
  data(){
    return {
      message : {
        from : "",
        email : "",
        text : "",

      },
      success : false,
      failure : false,
      locale: localStorage.getItem('lang')

    }
  },
  methods : {
    sendMsg(){
      axios.post('/api/guest/contact' , {message : this.message})
      .then((response)=>{
        if(response.status == 200){
          this.success = true;
          this.failure = false;

        } else {
          this.success = false;
          this.failure = true;

        }
      }).catch((error)=>{
        this.success = false;
        this.failure = true;

      })
    }
  },

  created(){
    this.$store.dispatch('guestGetContact');
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
