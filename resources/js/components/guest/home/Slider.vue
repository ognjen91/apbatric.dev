<template lang="html">
  <div class="sliderColumn" id='slider'>

    <div class="slider">

<vue-flux
   :captions="fluxCaptions"
   :options="fluxOptions"
   :images="images"
   :transitions="fluxTransitions"
   ref="slider">

      <flux-caption slot="caption"></flux-caption>

      <!-- <flux-pagination slot="pagination"></flux-pagination> -->

</vue-flux>

</div>

  </div>


</template>

<script>
import {
    VueFlux,
    FluxPagination,
    Transitions,
    FluxCaption
} from 'vue-flux';
export default {
    name: 'Slider',
    components: {
        VueFlux,
        FluxPagination,
        Transitions,
        FluxCaption,

    },
    props: {
        images: Array,
        texts: Object
    },
    data() {
        return {
            locale: localStorage.getItem('lang'),
            fluxOptions: {
                autoplay: true,
                enableGestures: true,
                bindKeys: true,
                delay: 4000,
                // fullscreen : true
            },

            fluxTransitions: {
                transitionWaterfall: Transitions.transitionWaterfall,
                transitionBlocks2: Transitions.transitionBlocks2,
                transitionRound2: Transitions.transitionRound2,
                transitionBlinds2D: Transitions.transitionBlinds2d,
                transitionZip: Transitions.transitionZip,

            },

        }
    },
    mounted() {

    },
    created() {

    },
    updated() {
        $("#sliderSpace").height($("#slider").height());
        window.onresize = function(event) {
            $("#sliderSpace").height($("#slider").height());
            // console.log("sp:   ", $("#sliderSpace").height());
            // console.log("sl:  ", $("#slider").height());
        }
    },

    methods: {
        konz() {
            console.log();
        }
    },


    computed: {
        fluxCaptions() {
            let arrayOfTexts = [];
            for (var i in this.texts) {
                arrayOfTexts = [...arrayOfTexts, this.texts[i][this.locale]]
            }
            return arrayOfTexts;
        }
    }
}
</script>

<style lang="css">
</style>
