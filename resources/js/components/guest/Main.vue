<template lang="html">
  <div class="row">


  <router-view name="promotionWarning" ></router-view>




  <transition name="fade"  mode="out-in"  >
        <router-view></router-view>
  </transition>


  </div>
</template>

<script>


export default {
  data(){
    return {
      loaded: false,
    }
  },

  computed : {
    sliderImages(){
      return this.$store.getters.getSliderImages;
    },
    rooms(){
      return this.$store.getters.getRooms;
    }
  },
  mounted(){
    this.$store.dispatch('guestGetRooms');
    this.$store.dispatch('guestGetSlider');
    this.$store.dispatch('guestGetGallery');
    this.$store.dispatch('guestGetEvents');
    this.$store.dispatch('guestGetContact');
    this.$store.commit('checkWarningDiscount');
  },

}
</script>

<style lang="css">

.fade-enter-active,
.fade-leave-active {
  transition-duration: 1s;
  transition-property: opacity;
  transition-timing-function: ease;
}

.fade-enter,
.fade-leave-active {
  opacity: 0
}
</style>
