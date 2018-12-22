<i18n>
{
"sr": {
    "Galerija" : "Galerija",
    "idite na stranicu" : "idite na stranicu",
    "galerija" : "'galerija'"

},
  "en": {
    "Galerija" : "Gallery",
    "idite na stranicu" : "Go To",
    "galerija" : "Gallrery page"
  },
  "ru" : {
    "Galerija" : "Галерея",
    "idite na stranicu" : "перейти на",
    "galerija" : "страницу галереи"
  }
}
</i18n>


<template lang="html">
<div class="row homeGallery">

  <div class="col-12 homeGalleryTitle">
    <h2 class="titleBigger spaced">{{$t('Galerija')}}</h2>
  </div>
  <div class="col-12" v-if="images.length">

    <div class="row homeGalleryImages">
      <div class="col-4 col-sm-3 col-md-2 homeGalleryImage" v-for="(image, i) in images" v-if="i < imagesShown">
      <img @click.once="firstClicked++" class="image"  :src="image" @click="index = i">
      </div>
    </div>

  </div>
  <div class="col-12 goToGallery">
    <router-link class="btn  btn-primary goToGallery" tag='div' :to="{ name: 'gallery', params: {} }">
      <a>
        {{$t('idite na stranicu')}} <br> {{$t('galerija')}}
      </a>
    </router-link>
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
    imagesShown : 0,
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
    var width = window.innerWidth;
    if (width < 768){
      this.imagesShown = 12
    } else {
      this.imagesShown = 18;
    }


    window.onresize = (e)=> {
    let width = window.innerWidth;
    if (width < 768){
      this.imagesShown = 12
    } else {
      this.imagesShown = 18;
    }
  };
  }
}
</script>

<style lang="css">
</style>
