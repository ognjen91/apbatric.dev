<template lang="html">
<div class="row" v-if="activeEvents.length || pastEvents.length">
<!-- <div class="row"> -->

  <div class="col-12">
    <h2 class='titleBiggest'>
      AKCIJE I SNIŽENJA
      <router-link :to="{ name: 'newEvent', params: {} }" class='btn btn-dark'>Dodajte novu akciju</router-link>
    </h2>
    <h4 class='titleBig'>Izbor glavne akcije</h4>
  </div>

    <!-- AKTIVNE PROMOCIJE -->
    <div v-if="activeEvents.length" class='activeEventsDash col-12'>
        <form>
            <table class="listed_events">
                <tr>
                    <th>Naziv</th>
                    <th>Postavi za glavnu</th>
                    <th>Mijenjaj</th>
                    <th>Izbrisi</th>
                </tr>
                <tr v-for="event in activeEvents">
                    <td>{{event.name.sr}} <br><i><strong>start : {{moment(+event.start).format("DD. MM. YYYY.")}} <br> kraj: {{moment(+event.finish).format("DD. MM. YYYY.")}} </strong> </i></td>
                    <td><input  type="radio" :checked="event.active==1" name='active' :value="event.id" @change="selectNewActiveEvent(event.id)"></td>
                    <td><router-link :to="{ name: 'editEvent', params: {id : event.id} }"><a><i  class="far fa-edit fa-2x"></i></a></router-link></td>
                    <td><i class="fas fa-times-circle fa-2x" @click='removeEvent(event.id, event.name)'></i></td>
                </tr>
                <div class="alert alert-success" v-if="changeSuccess">
                <h4 >Aktivna promocija je uspješno promjenjena.</h4>
                </div>

            </table>

            <div @click="changeSelectedEvent" class="setActive btn btn-primary">Promjenite aktivan događaj</div>
        </form>
    </div>
    <!-- //AKTIVNE PROMOCIJE -->

    <hr>


    <!-- PROSLE PROMOCIJE -->
    <div v-if="pastEvents.length" class='col-12'>
        <h4>Prošle akcije</h4>

        <table class="listed_events">
            <tr>
                <th>Naziv</th>

                <th>Mijenjaj</th>
                <th>Izbrisi</th>
            </tr>
            <tr v-for="event in pastEvents">
                <td>{{event.name.sr}} <br> <strong> start : {{moment(+event.start).format("DD. MM. YYYY.")}} <br> kraj: {{moment(+event.finish).format("DD. MM. YYYY.")}} </strong></td>
                <td>
                    <router-link :to="{ name: 'editEvent', params: {id : event.id} }"><a><i  class="far fa-edit fa-2x"></i></a></router-link>
                </td>
                <td><i class="fas fa-times-circle fa-2x" @click='removeEvent(event.id, event.name)'></i></td>

            </tr>
        </table>
    </div>
     <!-- //PROSLE PROMOCIJE -->

</div>


  <div v-else class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
    <h3>Niste dodali nijednu promociju.</h3>
    <router-link tag="h4":to="{ name: 'newEvent', params: {} }"><a>Dodajte novu promociju</a></router-link>
  </div>


</template>



<script>
var moment = require('moment');

export default {

    props: {
        activeEvents: Array,
        pastEvents: Array
    },

    data() {
        return {
            moment: moment,
            newSelectedEventId: null,
            is_changed: false,
            changeSuccess: false
        }
    },


    methods: {
        removeEvent(id, name) {
            if (confirm("Da li ste sigurni da želite da izbrišete promociju '" + name + "''")) {
                axios.post('/api/events/remove/' + id, {}).
                then(response => {
                    location.reload();
                })
            }
        },

        selectNewActiveEvent(id) {
            this.newSelectedEventId = id;
            this.is_changed = true;
            console.log(this.is_changed)
        },

        changeSelectedEvent() {
            if (!this.is_changed) {
                console.log("oooj")
                return
            } else {
                console.log('ok');
            };
            axios.post('/api/events/select_active', {
                id: this.newSelectedEventId
            }).
            then((response) => {
                this.changeSuccess = true;
                setTimeout(() => {
                    location.reload()
                }, 3000);
            })
        }
    }
}
</script>

<style lang="css">
</style>
