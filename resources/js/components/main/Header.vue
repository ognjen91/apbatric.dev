<i18n>
{
  "sr": {
    "Početna" : "Početna",
    "Apartmani" : "Apartmani",
    "Sniženja" : "Sniženja",
    "Galerija" : "Galerija",
    "O nama" : "O nama",
    "Kontakt" : "Kontakt"
  },
  "en": {
    "Početna" : "Home",
    "Apartmani" : "Apartments",
    "Sniženja" : "Discounts",
    "Galerija" : "Gallery",
    "O nama" : "About Us",
    "Kontakt" : "Contact"
  },
  "ru" : {
    "Početna" : "Домашняя страничка ",
    "Apartmani" : "Aпартаменты",
    "Sniženja" : "Скидки",
    "Galerija" : "Галерея",
    "O nama" : "Насчет нас",
    "Kontakt" : "Kонтакт"
  }
}
</i18n>



<template lang="html">
  <header v-bind:class="{scrolledToTop : scrolledToTop, fadeOutNow : nextScroll}">


<div class="navigation">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

      <div class="logoNflags" >
        <div class="ab">
          <router-link :to="{ name: 'home', params: {} }">
            <img src="/images/logo.png" alt="site logo">
         </router-link>
        </div>

        <li class="flags d-none d-md-inline-flex" >
          <div v-if="locale !== 'sr'">
            <img src="/images/serbia.png" alt="Switch to Serbian" @click="changeLanguage('sr')">
          </div>
          <div v-if="locale !== 'ru'">
            <img src="/images/russia.png" alt="Switch to Russian" @click="changeLanguage('ru')">
          </div>
          <div v-if="locale !== 'en'">
            <img src="/images/uk.png" alt="Switch to English" @click="changeLanguage('en')">
           </div>
       </li>


       </div>



<!-- ========HAMBURGER DUGME=========== -->
  <button v-if="!menuShown" @click="menuToggle" id="hamburger" class="navbar-toggler" type="button" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <img src="/images/menu.png" alt="">
  </button>


<!-- =============X ZA SKRIVANJE MOBILE MENU===============   -->
 <div v-else id="closeMenu" @click="menuToggle">x</div>


  <div class="navbar-collapse collapse flexCentered" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto" @click='menuToggle'>

      <!-- ====================ADMIN MENU==================== -->
      <template v-if="logged_user">

        <li class="nav-item dropdown d-none d-md-block">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <strong>Zdravo, {{ logged_user.name }}</strong>
          </a>

          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <!-- <router-link :to="{ name: 'adminProfile', params: {} }" class="dropdown-item" active-class="activeHeader">Profil</router-link> -->
            <a class="dropdown-item" @click.prevent="logout">LogOut</a>
          </div>
        </li>

        <li class="nav-item d-md-none">
          <a @click.prevent class="nav-link">
            Zdravo, {{ logged_user.name }}
          </a>
        </li>

        <li class="nav-item d-md-none">
          <a @click.prevent='logout' class="nav-link">
            Log Out
          </a>
        </li>

      <router-link active-class="activeHeader" exact :to="{ name: 'adminDashboard', params: {} }" tag='li' class="nav-item">
      <a class="nav-link">
      Dashboard
      </a>
      </router-link>

      <router-link active-class="activeHeader" exact :to="{ name: 'mailHome', params: {} }" tag='li' class="nav-item" >
      <a class="nav-link">
      Mail
      </a>
      </router-link>

      <router-link active-class="activeHeader" exact :to="{ name: 'sliderHome', params: {} }" tag='li' class="nav-item" >
      <a class="nav-link">
      Slider
      </a>
      </router-link>

      <router-link active-class="activeHeader" exact :to="{ name: 'adminGallery', params: {} }" tag='li' class="nav-item" >
      <a class="nav-link">
      Galerija
      </a>
      </router-link>

      <router-link active-class="activeHeader" exact :to="{ name: 'adminAbout', params: {} }" tag='li' class="nav-item" >
      <a class="nav-link">
      O nama
      </a>
      </router-link>

      <router-link active-class="activeHeader" exact :to="{ name: 'adminContact', params: {} }" tag='li' class="nav-item" >
      <a class="nav-link">
      Kontakt
      </a>
      </router-link>

      </template>


      <!-- ============GUEST MENU======================== -->
      <template v-else>

        <li class="flags nav-item d-md-none" >
          <div v-if="locale !== 'sr'">
            <img src="/images/serbia.png" alt="Switch to Serbian" @click="changeLanguage('sr')">
          </div>
          <div v-if="locale !== 'ru'">
            <img src="/images/russia.png" alt="Switch to Russian" @click="changeLanguage('ru')">
          </div>
          <div v-if="locale !== 'en'">
            <img src="/images/uk.png" alt="Switch to English" @click="changeLanguage('en')">
           </div>
       </li>


        <router-link exact :to="{ name: 'home', params: {} }" tag='li' class="nav-item" active-class='activeHeader'>
          <a class="nav-link">{{$t('Početna')}}</a>
        </router-link>

        <router-link exact :to="{ name: 'rooms', params: {} }" tag='li' class="nav-item" active-class='activeHeader'>
          <a class="nav-link">{{$t('Apartmani')}}</a>
        </router-link>

        <router-link  exact :to="{ name: 'discounts', params: {} }" tag='li' class="nav-item" active-class='activeHeader'>
          <a class="nav-link">{{$t('Sniženja')}}</a>
        </router-link>

        <router-link  exact :to="{ name: 'gallery', params: {} }" tag='li' class="nav-item" active-class='activeHeader'>
          <a class="nav-link">{{$t('Galerija')}}</a>
        </router-link>

        <router-link  exact :to="{ name: 'about', params: {} }" tag='li' class="nav-item" active-class='activeHeader'>
          <a class="nav-link">{{$t('O nama')}}</a>
        </router-link>

        <router-link  exact :to="{ name: 'contact', params: {} }" tag='li' class="nav-item" active-class='activeHeader'>
          <a class="nav-link">{{$t('Kontakt')}}</a>
        </router-link>


      </template>

    </ul>


  </div>
</nav>

</div>






</header>
</template>

<script>
export default {

    data() {
        return {
            menuShown: false,
            locale: localStorage.getItem('lang'),
            scrolledToTop : $(window).scrollTop() == 0,
            nextScroll : $(window).scrollTop() !== 0,
            topCounter : 0,

        }
    },
    methods: {


        logout() {
            this.$store.commit('logout');
            this.$router.push({
                name: "adminLogin"
            });
        },

        changeLanguage(lang) {
            this.locale = lang;
            localStorage.setItem('lang', lang);
            localStorage.removeItem("discountWarningLastShown");
            location.reload();
            //treba resetovati i timer popupa na vrhu

        },

        menuToggle() {
            if (+window.innerWidth < 992) {
                this.menuShown = !this.menuShown;
                $(".collapse").slideToggle(1000);
                // console.log($(".collapse").css('display'));
            }
        },

        isScrolledToTop(){
          if($(window).scrollTop() == 0){
            this.scrolledToTop = true;
            this.nextScroll = false;

            this.topCounter = 0;
          }else{
            this.scrolledToTop = false;
            // console.log($("header").css('background-color'));
            // console.log($("header").css(''));
            if ($("header").css('opacity') == 0.8){
              // console.log("gogogogogogogogogo/...");
              this.nextScroll = true;


            }
            this.topCounter++;
          };
        }
    },
    computed: {
        logged_user() {
            return this.$store.getters.currentUser;
        },


        // scrolledToTop(){
        //   return $(window).scrollTop() == 0;
        // }
    },
    watch: {
        locale(val) {
            this.$i18n.locale = val
        },
    },
    created () {
  // window.addEventListener('scroll', this.isScrolledToTop);
  window.addEventListener('scroll', (e)=>{
    this.isScrolledToTop()

  });
},

    mounted() {
        $(".navbar").addClass('transparentNav');
        $(".navbar-collapse").addClass('homeMenu').css("background-color", 'rgba(168, 143, 72, 0.05) !important');
    }
}
</script>

<style lang="css">
</style>
