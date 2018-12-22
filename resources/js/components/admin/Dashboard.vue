<template lang="html">
  <div class="dashboard row">

    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 listRooms">
        <ListRooms :rooms="rooms"></ListRooms>
    </div>

  <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
      <ListPromotions :activeEvents="activeEvents" :pastEvents="pastEvents"></ListPromotions>
  </div>


  </div>
</template>

<script>

import ListRooms from './dashboard/ListRooms.vue'
import ListPromotions from './dashboard/ListPromotions.vue'
export default {
  components : {
    ListRooms,
    ListPromotions
  },

  data(){
    return {

    }
  },
  computed : {
    rooms(){
      return this.$store.getters.getRooms;
    },
    activeEvents(){
      return this.$store.getters.getActiveEvents;
    },
    pastEvents(){
      return this.$store.getters.getPastEvents;
    }

  },
  methods : {

  },
  mounted(){
    this.$store.dispatch('getRooms');
    this.$store.dispatch('getEvents');
    this.$store.dispatch('getAbout');
    this.$store.dispatch('getContact');
  }

}
</script>

<style lang="css">
</style>
