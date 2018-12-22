<template>
    <div class="container">


      <!-- <h1>OVO JE MAIN APP</h1> -->
  <Header/>
      <transition enter-active-class="bounceIn"
                  leave-active-class="lightSpeedOut"
                  mode="out-in"
                  :duration='200'>
        <router-view name="promotionWarning"></router-view>
      </transition>

      <router-view name="contactWarning"></router-view>

      <transition :enter-active-class="enterTransition"
                  leave-active-class="animated fadeOut"
                  mode="out-in"
                  :duration='duration' appear>
        <router-view></router-view>
      </transition>

  <Footer/>
    </div>
</template>

<script>
import Header from './main/Header.vue';
import Footer from './main/Footer.vue';
export default {
    name: "main-app",
    components: {
        Header, Footer
    },
    data(){
      return {
        enterTransition : "animated fadeIn",
        duration : 300

      }
    },
watch: {
    '$route'(to, from) {

    }

},

}
</script>
