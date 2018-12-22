<i18n>
{
"sr": {
    "Sobe Vile Batrićević" : "Sobe Vile Batrićević",
    "odaberite sobu za sebe, a ostalo prepustite nama" : "odaberite sobu za sebe, a ostalo prepustite nama",
    "od" : "od",
    "kreveta" : "kreveta",
    "Pogledajte" : "Pogledajte"
},
  "en": {
    "Sobe Vile Batrićević" : "Our Apartments",
    "odaberite sobu za sebe, a ostalo prepustite nama" : "please choose the right one for yoursefl",
    "od" : "from",
    "kreveta" : "beds",
    "Pogledajte" : "See more"
  },
  "ru" : {
    "Sobe Vile Batrićević" : "Наши апартаменты",
    "odaberite sobu za sebe, a ostalo prepustite nama" : "выберите правильный для себя",
    "od" : "от",
    "kreveta" : "кровати",
    "Pogledajte" : "Подробнее"
  }
}
</i18n>


<template lang="html">
  <div class="row" id="allRooms">

    <div class="col-12 roomsPageTitle">
      <h2 class="titleBigger">{{$t("Sobe Vile Batrićević")}}</h2>
      <h4 class="titleBig">{{$t("odaberite sobu za sebe, a ostalo prepustite nama")}}</h4>
    </div>

      <!-- Category Card -->
      <div class="col-10 col-sm-5 col-md-4 roomCard" v-for="room in rooms">
          <div class="card rounded">
              <div class="card-image">
                  <!-- <span class="card-notify-badge">Low KMS</span> -->
                  <span v-if="locale !== 'en'" class="card-notify-year text">{{$t("od")}} {{room.starting_price}} &euro;</span>
                  <span v-else class="card-notify-year text"><small>{{$t("od")}} {{room.starting_price}} &euro;</small></span>
                  <router-link :to="{ name: 'viewRoom', params: {id: room.id} }">
                  <img class="img-fluid" :src="'images/rooms/'+room.profile_img" alt="Alternate Text" />
                  </router-link>
              </div>

              <div class="card-body text-center">
                  <div class="ad-title m-auto">
                      <h5>{{room.name[locale]}}</h5>
                  </div>
              </div>

              <div class="card-image-overlay m-auto">
                  <span class="card-detail-badge title">{{room.slogan[locale]}}</span>
                  <span class="card-detail-badge title">{{room.beds}} {{$t("kreveta")}}</span>
                  <!-- <span class="card-detail-badge">13000 Kms</span> -->
              </div>

              <div class="card-body text-center">
                  <!-- <div class="ad-title m-auto">
                      <h5>{{room.name.sr}}</h5>
                  </div> -->
                  <router-link class="ad-btn title text-lowercase spaced" :to="{ name: 'viewRoom', params: {id: room.id} }">
                    {{$t("Pogledajte")}}
                  </router-link>
              </div>

          </div>
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
    if(!this.$store.state.rooms.length){
      this.$store.dispatch('guestGetRooms');

    }
  },
  computed : {
    rooms(){
      return this.$store.getters.getRooms;
    }
  }
}
</script>

<style lang="css">
</style>
