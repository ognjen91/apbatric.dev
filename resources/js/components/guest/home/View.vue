<template lang="html">

  <div class="row homeWrap">

    <Slider :images='sliderImages' :texts="sliderTexts" />
    <div class="sliderSpace" id="sliderSpace"></div>
    <RandomOne/>
    <RoomsPreview :rooms="rooms"/>
    <RandomTwo/>
    <Calendars/>
    <Video/>
    <RandomThree/>
    <CurrentPromotion/>
    <Gallery/>
</div>
</template>

<script>
import Slider from './Slider.vue';
import RandomOne from './RandomOne.vue';
import RandomTwo from './RandomTwo.vue';
import RandomThree from './RandomThree.vue';
import Calendars from './Calendars.vue';
import RoomsPreview from './RoomsPreview.vue';
import CurrentPromotion from './CurrentPromotion.vue';
import Gallery from './Gallery.vue';
import Video from './Video.vue';

export default {
  components : {
    Slider, RandomOne, RandomTwo, RandomThree, Calendars,
    RoomsPreview, CurrentPromotion, Gallery, Video
  },
  computed : {
    sliderImages(){
      return this.$store.getters.getSliderImages;
    },
    sliderTexts(){
      return this.$store.getters.getSliderTexts;
    },
    rooms(){
      return this.$store.getters.getRooms;
    }
  },
  mounted(){
    if (!this.$store.state.rooms.length){
      this.$store.dispatch('guestGetRooms');
    }
    this.$store.dispatch('guestGetSlider');
    this.$store.dispatch('guestGetGallery');
    this.$store.dispatch('guestGetEvents');
    this.$store.dispatch('guestGetContact');
    this.$store.commit('checkWarningDiscount');
  },
}
</script>

<style lang="css">
</style>
