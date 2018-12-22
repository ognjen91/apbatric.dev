<i18n>
{
"sr": {
    "Soba je slobodna u navedenom periodu. Pošaljite nam mail i rezervišite već danas" : "Soba je slobodna u navedenom periodu. Pošaljite nam mail i rezervišite već danas",
    "Slanje upita" : "Slanje upita",
    "Upit za period" : "Upit za period",
    "Poruka poslata" : "Poruka poslata",
    "Greška pri slanju poruke" : "Greška pri slanju poruke",
    "zatvori" : "zatvori",
    "upozorenje" : "Poštovani, dok je sajt u test fazi, možete nas kontaktirati na mail"

},
  "en": {
    "Soba je slobodna u navedenom periodu. Pošaljite nam mail i rezervišite već danas" : "The room is availabale in the selected period. Send us a mail and reserve",
    "Slanje upita" : "Send mail",
    "Upit za period" : "Query for period",
    "Poruka poslata" : "Message sent",
    "Greška pri slanju poruke" : "Error...",
    "zatvori" : "close",
    "upozorenje" : "Dear guests, while the website is in test phase, please contact us at email"

  },
  "ru" : {
    "Soba je slobodna u navedenom periodu. Pošaljite nam mail i rezervišite već danas" : "Комната доступна в выбранный период. Пришлите нам е-мейл и резерв",
    "Slanje upita" : "Отправить е-мейл",
    "Upit za period" : "Запрос на период",
    "Poruka poslata" : "E-мейл отправлено",
    "Greška pri slanju poruke" : "Oшибка...",
    "zatvori" : "закрыть",
    "upozorenje" : "Дорогие гости, пока веб-сайт находится на этапе тестирования, свяжитесь с нами по электронной почте"
  }
}
</i18n>






<template lang="html">
  <div class="row roomMail">
    <div class="col-12 freeText">
      <p class='title text-center'>
        {{$t("Soba je slobodna u navedenom periodu. Pošaljite nam mail i rezervišite već danas")}}
      </p>
    </div>
    <div class="col-12">
      <div class="row justify-content-center">
  <div class="col-12 col-md-8 col-lg-6 pb-5">

                  <form @submit.prevent="sendMail" class="roomContact">

                    <h1 class="temporaryAttention text-danger text-align-center">{{$t("upozorenje")}}  <strong>rbatricevic@yahoo.com</strong></h1>
                      <!-- <div class="card border-primary rounded-0">
                          <div class="card-header p-0">
                              <div class="formHeader bg-info text-white text-center py-2">
                                  <h3><i class="fa fa-envelope"></i>{{$t("Slanje upita")}}</h3>
                                  <p class="m-0">
                                    {{$t("Upit za period")}}
                                    {{locale !== 'en' ? moment(+arrival).format("DD. MM. YYYY.") : moment(+arrival).format("DD. MMMM YYYY.") }}
                                    -
                                    {{locale !== 'en' ? moment(+departure).format("DD. MM. YYYY.") : moment(+departure).format("DD. MMMM YYYY.")}}</p>
                              </div>
                          </div>
                          <div class="card-body p-3">

                              Body
                              <div class="form-group">
                                  <div class="input-group mb-2">
                                      <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fa fa-user text-info"></i></div>
                                      </div>
                                      <input type="text" class="form-control" id="nombre" name="nombre" placeholder=" Ime/ Name / Имя" required v-model='message.name'>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="input-group mb-2">
                                      <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fa fa-envelope text-info"></i></div>
                                      </div>
                                      <input type="email" class="form-control" id="nombre" name="email" placeholder="Email" required v-model='message.email'>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <div class="input-group mb-2">
                                      <div class="input-group-prepend">
                                          <div class="input-group-text"><i class="fa fa-comment text-info"></i></div>
                                      </div>
                                      <textarea class="form-control" placeholder='Poruka / Message / Сообщение' required v-model='message.text'></textarea>
                                  </div>
                              </div>



                              <div class="text-center">
                                  <input type="submit" value="Pošaljite/Send/Пришлите" class="btn btn-info btn-block rounded-0 py-2">
                                  <div class="btn btn-info btn-block rounded-0 py-2" @click='closeForm'>{{$t("zatvori")}}</div>
                              </div>
                            ==================izvjestaji o uspjesnosti======================


                            <transition enter-active-class="animated flipInX"
                                        leave-active-class="animated fadeOut"
                                        mode="out-in"
                                        duration='800'>
                              <div class="alert alert-success queryResult" v-if='success'>
                                <h4>{{$t("Poruka poslata")}}!</h4>
                              </div>
                            </transition>


                              <transition enter-active-class="animated flipInX"
                                          leave-active-class="animated fadeOut"
                                          mode="out-in"
                                          duration='800'>
                              <div class="alert alert-danger queryResult" v-if='failure'>
                                <h5>{{$t("Greška pri slanju poruke")}}</h5>
                              </div>
                            </transition>

                            ==================//izvjestaji o uspjesnosti======================


                          </div>

                      </div> -->
                  </form>
                  <!--Form with header-->


              </div>
</div>
    </div>
  </div>
</template>

<script>
var moment = require('moment');
export default {
    props: {
        roomName: Object,
        arrival: Number,
        departure: Number
        // , arrival, departure
    },
    data() {
        return {
            moment: moment,
            message: {
                name: '',
                email: '',
                text: ''
            },
            success: false,
            failure: false,
            locale: localStorage.getItem('lang')
        }
    },

    computed: {
        room() {
            return this.$store.getters.getRoom(this.$route.params.id);
        }
    },
    methods: {
        sendMail() {
            this.mesage = { ...this.message,
                room_id: this.room.id,
                title: "Upit za sobu " + this.room.name,
                arrival: this.arrival,
                departure: this.departure
            }
            axios.post('/api/guest/contact', {
                    message: this.message
                })
                .then((response) => {
                    if (response.status == 200) {
                        this.success = true;
                        this.failure = false;
                        setTimeout(() => {
                            this.success = true;
                            this.failure = false;
                        }, 10000);

                    } else {
                        this.success = false;
                        this.failure = true;
                        setTimeout(() => {
                            this.success = true;
                            this.failure = false;
                        }, 10000);
                    }
                }).catch((error) => {
                    this.success = false;
                    this.failure = true;
                    setTimeout(() => {
                        this.success = true;
                        this.failure = false;
                    }, 10000);
                })
        },
        closeForm() {
            this.$emit('closeForm');
        }
    }

}
</script>

<style lang="css">
.roomMail{
  /* background-color: #fff; */
}

.temporaryAttention{
  background-color: #fff;
  border: 2px solid red;
  padding: 1.5%;

}
</style>
