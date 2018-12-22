<template lang="html">
<div class='row addEvent'>

  <div class="col-12 adminNavLink">
    <router-link :to="{ name: 'adminDashboard', params: {} }">
      Nazad
    </router-link>
  </div>

  <div class="col-12">
    <form @submit.prevent="submitEvent">

        <!-- INFORMACIJE O PROMOCIJI -->
        <!-- IME -->
        <div class="form-group">
            <label for="exampleInputEmail1"><h3>Naziv promocije: <strong>{{newEventData.name.sr}}</strong></h3></label>
            <input type="text" v-model="newEventData.name.sr" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="npr 'Velika junska akcija' ili 'Samo za vjerne goste'">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1"><h5>Naziv promocije na engleskom</h5></label>
            <input type="text" v-model="newEventData.name.en" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1"><h5>Naziv promocije na ruskom</h5></label>
            <input type="text" v-model="newEventData.name.ru" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
       <!-- /IME -->

         <!-- KRATAK OPIS -->
        <div class="form-group">
            <label for="previewSr"><strong>Kratak opis</strong> (20-150 karaktera)</label>
            <VueTrix v-model="newEventData.preview.sr"/>
            <small class="form-text text-muted">Ovaj kratak tekst se prikazuje na početnoj strani i treba da privuče pažnju.</small>
        </div>
        <div class="form-group">
            <label for="previewEn"><strong>Kratak opis na engleskom</strong> (20-150 karaktera)</label>
            <VueTrix v-model="newEventData.preview.en"/>
            <small class="form-text text-muted">Ovaj kratak tekst se prikazuje na početnoj strani i treba da privuče pažnju.</small>
        </div>
        <div class="form-group">
            <label for="previewRu"><strong>Kratak opis na ruskom</strong> (20-150 karaktera)</label>
            <VueTrix v-model="newEventData.preview.ru"/>
            <small class="form-text text-muted">Ovaj kratak tekst se prikazuje na početnoj strani i treba da privuče pažnju.</small>
        </div>
        <!-- /KRATAK OPIS -->


        <!-- DUG OPIS -->
        <div class="form-group">
            <label for="exampleTextareaSr"><strong>Duži opis</strong> (minimalno 50 karaktera)</label>
              <VueTrix v-model="newEventData.description.sr"/>
            <small class="form-text text-muted">Ovaj  tekst se prikazuje na  posebnoj stranici promocije.</small>
        </div>
        <div class="form-group">
            <label for="exampleTextareaEn"><strong>Duži opis na engleskom</strong> (minimalno 50 karaktera)</label>
            <VueTrix v-model="newEventData.description.en"/>
            <small class="form-text text-muted">Ovaj  tekst se prikazuje na  posebnoj stranici promocije.</small>
        </div>
        <div class="form-group">
            <label for="exampleTextareaRu"><strong>Duži opis na ruskom</strong> (minimalno 50 karaktera)</label>
            <VueTrix v-model="newEventData.description.ru"/>
            <small class="form-text text-muted">Ovaj  tekst se prikazuje na  posebnoj stranici promocije.</small>
        </div>

        <!-- /INFORMACIJE O PROMOCIJI -->
        <hr>

        <!-- VRIJEME PROMOCIJE -->
        <div class="setPromotionPeriod">
            <div class="promotion_start">
                <h4 @click="konzoluj"><strong>Početak promocije</strong></h4>
                <datepicker :language='sr' :inline="true" @input="prom_start_action" :disabledDates="disabled"></datepicker>
                <div class="form-group">
                    <label for="exampleSelect1">Vrijeme početka promocije</label>
                    <select class="form-control" id="exampleSelect1" v-model="prom_start_hour">
                      <option value="0">00 : 00</option>
                      <option v-for='n in 23' :value="n">{{n<10? "0"+n : n}} : 00</option>
                    </select>
                </div>
            </div>

            <div class="promotion_finish">
                <h4><strong>Kraj promocije</strong></h4>
                <datepicker :language='sr' :inline="true" @input="prom_finish_action" :disabledDates="disabled"></datepicker>
                <div class="form-group">
                    <label for="exampleSelect1">Vrijeme početka promocije</label>
                    <select class="form-control" id="exampleSelect1" v-model="prom_finish_hour">
                      <!-- <option value="0">00 : 00</option> -->
                      <option v-for='n in 23' :value="n">{{n<10? "0"+n : n}} : 00</option>
                    </select>
                </div>
            </div>

        </div>
        <!-- //VRIJEME PROMOCIJE -->

          <!-- POVRATNE PORUKE -->
        <div class="newEventError alert alert-danger" v-if='pickDateError'>
            <h4 style="text-align: center;">Molimo odaberite validne datume</h4>
        </div>
        <div class="otherErrors alert alert-danger" v-if='otherErrors'>
            <ul>
                <li v-for='error in otherErrorsMsgs'>{{error}}</li>
            </ul>
        </div>
        <div class="alert alert-success" v-if='success'>
            <h4 style="text-align: center;">Promocija usješno kreirana.</h4>
        </div>
        <!-- //POVRATNE PORUKE -->



        <button type="submit" class="btn btn-primary">Dodajte promociju</button>
    </form>
  </div>
</div>
</template>

<script>
var moment = require('moment');
import Datepicker from 'vuejs-datepicker';
import {
    sr
} from 'vuejs-datepicker/dist/locale'
export default {
    components: {
        Datepicker
    },
    data() {
        return {
            sr: sr,
            moment: moment,
            newEventData: {
                name: {
                  sr : '',
                  en : '',
                  ru : ''
                },
                preview: {
                  sr : '',
                  en : '',
                  ru : ''
                },
                description: {
                  sr : '',
                  en : '',
                  ru : ''
                },
                start: null,
                finish: null,
            },
            prom_start_hour: 12,
            prom_finish_hour: 12,

            pickDateError: false,
            otherErrors: false,
            otherErrorsMsgs: [],
            success: false,
        }
    },

    computed: {
        disabled() {
            //treba biti onemoguceno zakljucno sa jucerasnjim datumom
            var d = new Date();
            d.setDate(d.getDate() - 1);
            return {
                to: d
            }
        }
    },
    methods: {
        konzoluj() {
            console.log(this.disabled);
        },
        prom_start_action(e) {
            this.newEventData.start = e.setHours(this.prom_start_hour, 0, 0);

        },
        prom_finish_action(e) {
            this.newEventData.finish = e.setHours(this.prom_finish_hour, 0, 0);
        },

        submitEvent() {
            this.newEventData.start = moment(this.newEventData.start).set('hour', this.prom_start_hour).valueOf();
            this.newEventData.finish = moment(this.newEventData.finish).set('hour', this.prom_finish_hour).valueOf();

            if (!this.newEventData.start || !this.newEventData.finish || this.newEventData.start > this.newEventData.finish) {
                this.pickDateError = true
            } else {
                this.pickDateError = false;
                axios.post('/api/events/create', this.$data.newEventData)
                    .then(
                        (response) => {
                            const router = this.$router;
                            this.success = true;
                            setTimeout(function() {
                                router.push({
                                    name: "adminDashboard"
                                });
                            }, 3000)
                        },
                        (error) => {
                            if (error.response.status == 422) {
                                this.otherErrors = true;
                                this.otherErrorsMsgs = error.response.data.errors;
                                console.log(this.otherErrors);
                            }
                            if (error.response.status == 500) {
                                this.otherErrors = true;
                                this.otherErrorsMsgs = [];
                                this.otherErrorsMsgs = [...this.otherErrorsMsgs, "Greška"];
                            }
                        }
                    )
                    .catch((error) => {
                        console.log(error);
                        this.otherErrors = true;
                        this.otherErrorsMsgs = [...this.otherErrorsMsgs, "Greška"];
                    })
            }
        }
    }
}
</script>

<style lang="css">
</style>
