<template lang="html">
  <div class="row sliderPage">

    <!-- POSTOJEĆE SLIKE - ODABIR -->
    <div class="col-12 col-sm-12 col-md-7">
      <h2>Odabir slika za slajder</h2>

      <div class="ui_wrap">
        <div class="ui_existing_imgs" v-if='sliderImages.length'>
         <h4>Postojeće slike slajdera</h4>
         <form @submit.prevent='submitChanges'>

           <table >
             <tr>
               <th>Slika</th>
               <th>Pozicija na slajderu</th>
               <th>Izbriši</th>
               <th>tekstovi</th>
             </tr>
             <tr v-for='image in sliderImages' class='ai_tr'>
               <td class='as_image'><img :src="'/images/slider/' + image.name" alt=""></td>
               <td class='as_order'>
                 <select @change="(e) => { changeOrder(e, image.id, image.order) }">
                   <option v-for="n in number_of_active_imgs" :selected="n == image.order" :value="n">{{n}}</option>
                 </select></td>
              <td class="as_delete"><i  @click="deleteSliderImg(image.id, image.order)" class="fas fa-times-circle"></i></td>
              <td class="sliderTexts">

                <div class="theSlideText">
                  <h6>Tekst na srpskom</h6>
                  <input type="text" v-model="image.text.sr" name="" value="" class="newSlideText">
                    <h6>Tekst na engleskom</h6>
                  <input type="text" v-model="image.text.en" name="" value="" class="newSlideText">
                  <h6>Tekst na ruskom</h6>
                  <input type="text" v-model="image.text.ru" name="" value="" class="newSlideText">
                </div>

              </td>
            </tr>
          </table>

      <div style='display:flex'>
        <input type="submit" class="btn btn-primary" value="Prihvatite izmjene">
        <div class="alert alert-success" v-if='successMsg'>{{successMsg}}</div>
      </div>
      </form>
      </div>

       <div v-else><h3>Niste dodali nijednu sliku slajdera</h3></div>
      </div>
    </div>
    <!-- //POSTOJEĆE SLIKE - ODABIR -->


    <!-- UBAC NOVIH SLIKA ZA SLAJDER -->
    <addSliderImage></addSliderImage>
    <!-- //UBAC NOVIH SLIKA ZA SLAJDER -->

</div>
</template>

<script>
import addSliderImage from './AddSliderImage.vue';
export default {
    components: {
        addSliderImage
    },

    data() {
        return {
            sliderImages: [],
            orderChange: null,
            successMsg: null,
            sliderText : []
        }
    },

    computed: {
        number_of_active_imgs() {
            let number = 0;
            this.sliderImages.forEach((img) => {
                if (img.active) number++;
            })
            return number;
        }
    },

    methods: {

        changeOrder(e, id, oldOrder) {
            let newOrder = e.target.value;
            this.sliderImages.forEach(img => {
                if (img.id == id) img.order = newOrder;
                if (img.order > oldOrder && img.order <= newOrder && img.id !== id) img.order--;
                if (img.order < oldOrder && img.order >= newOrder && img.id !== id) img.order++;

            })
            this.sliderImages.sort(function(obj1, obj2) {
                return obj1.order - obj2.order;
            });
        },

        submitChanges() {
            var data = [];
            this.sliderImages.forEach(img => {
                data.push({
                    id: img.id,
                    order: img.order,
                    text : img.text
                })
            })

            axios.post('/api/slider/update', {
                    order_update: data
                })
                .then((response) => {
                    this.successMsg = response.data.message;
                    setTimeout(() => {
                        location.reload();
                    }, 1500)
                })

        },

        deleteSliderImg(img_id, img_order) {

            // ..NOVI REDOSLJED SLIKA
          if (confirm("Da li ste sigurni da želite da izbrišete ovu sliku slajdera?")){
              var changedOrder = [];

              for (var i in this.sliderImages){
                if (this.sliderImages[i].id == img_id) continue;
                if (this.sliderImages[i].order > img_order){
                  this.sliderImages[i].order--;
                  changedOrder = [...changedOrder, {
                    id : this.sliderImages[i].id,
                    order : this.sliderImages[i].order
                  }]
                }
              }

                axios.post('/api/slider/delete/' + img_id, {changedOrder : changedOrder})
                    .then(
                        (response) => {
                          this.sliderImages.splice(img_order-1, 1);
                            // location.reload()
                        }
                    );
            }
            //MOZE SE DOPUNITI ODGOVARAJUĆOM PORUKOM
        }
    },
    mounted() {
        axios.get('/api/slider')
            .then((response) => {
                this.sliderImages = response.data.images;
                response.data.images.forEach(img=>{
                  img.text = JSON.parse(img.text);
                })
                this.sliderImages.sort(function(obj1, obj2) {
                    return obj1.order - obj2.order;
                }); //(SORTIRANJE PO REDU(order))
            })
    }

}
</script>

<style lang="css">
</style>
