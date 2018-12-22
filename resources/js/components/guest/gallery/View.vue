<i18n>
{
"sr": {
    "GALERIJA" : "GALERIJA"
},
  "en": {
    "GALERIJA" : "GALLERY"
  },
  "ru" : {
    "GALERIJA" : "ГАЛЕРЕЯ"
  }
}
</i18n>



<template lang="html">
  <div class="row galleryPage">
    <div class="col-12 galleryPageTitle">
      <h2 class="text spaced">{{$t("GALERIJA")}}</h2>
    </div>
    <div class="col-12" v-if="images.length">


      <div class="row">

  <!-- ======pojedine slike========== -->
  <div v-for="(image, i) in images" v-if="i < imagesShownAfterScrollToEnd" :key="i" class="col-4 col-sm-3 col-md-2 homeGalleryImage">

        <transition enter-active-class="animated bounceIn"
                    leave-active-class="animated fadeOut"
                    mode="out-in"
                    duration='800' appear>
        <img @click.once="firstClicked++" class="image"  :src="image" @click="index = i" v-if="i < imagesShownAfterScrollToEnd">

      </transition>
  </div>
    <!-- ========/pojedine slike========== -->

      </div>

    </div>

    <vue-gallery-slideshow :images="images" :index="index" @close="index = null" v-if='firstClicked'></vue-gallery-slideshow>



  </div>
</template>

<script>
import VueGallerySlideshow from 'vue-gallery-slideshow'

export default {
  components: {
    VueGallerySlideshow
  },
  data(){
    return {
    firstClicked : 0,
    index: 0,
    imagesShownInitialy : 0,
    imagesShownAfterScrollToEnd : 0,
    locale: localStorage.getItem('lang')

    }
  },
  methods: {
    onClick(i) {
      this.index = i;
    }
  },
  computed : {
    images(){
      return this.$store.getters.getGalleryImages;
    }
  },

  mounted(){
    if (!this.$store.getters.getGalleryImages.length){
      this.$store.dispatch('guestGetGallery');
    }

    var width = window.innerWidth;
    if (width < 576){
      this.imagesShownInitialy = 24;
    } else if (width < 768){
      this.imagesShownInitialy = 24
    }  else {
      this.imagesShownInitialy = 30;
    }

    this.imagesShownAfterScrollToEnd = this.imagesShownInitialy;

    window.onscroll = (ev) => {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
      // console.log("do kraja skrolovano")

      var width = window.innerWidth;
      // console.log(width);
      if (width < 576){
        this.imagesShownAfterScrollToEnd = this.imagesShownAfterScrollToEnd + 9;
      } else if (width < 768){
        this.imagesShownAfterScrollToEnd = this.imagesShownAfterScrollToEnd + 12;
      }else {
        this.imagesShownAfterScrollToEnd = this.imagesShownAfterScrollToEnd + 18;
      }
    }
};


  }

}

</script>

<style lang="css">
.list-enter-active, .list-leave-active {
  transition: all 1s;
}
.list-enter, .list-leave-to /* .list-leave-active below version 2.1.8 */ {
  opacity: 0;
  transform: translateY(30px);
}
</style>
