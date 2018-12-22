<template lang="html">
  <div class="row changeRoomPrices">

    <div class="col-8 col-sm-10 col-md-12" v-if="price.length">

      <div class="col-12 adminNavLink">
        <router-link :to="{ name: 'editRoom', params: {id:$route.params.id} }">
          Nazad na stranicu sobe
        </router-link>
      </div>

      <form @submit.prevent="sendData" class="periodForm">
        <table class="table table-striped">


        <tr>
            <th>Od</th>
            <th>Do</th>
            <th>Cijena (&euro;)</th>
            <th>obriši period</th>
          </tr>
          <tr v-for="(period, i) in price">
            <td><input type="text" v-model='period.from'></td>
            <td><input type="text" v-model='period.to'></td>
            <td><input type="text" v-model='period.price'></td>
            <td><i @click="deletePeriod(i)" class="fas fa-times-circle fa-2x"></i></td>
          </tr>

     </table>

          <button type="button" name="button"  @click='addPeriod' class='btn btn-primary addPeriod'>Dodajte novi peiod</button>

          <input type="submit" class="btn btn-success addPeriod" name="" value="Prihvati promjene">

          <div class="row alert alert-success" v-if="success">
            <h1>Uspješno</h1>
          </div>
      </form>
    </div>

  </div>
</template>

<script>
export default {

  mounted(){
    axios.get('/api/rooms')
        .then((response) => {
            let room = response.data.rooms.find(room=>room.id = this.$route.params.id);
            // console.log(room);
            this.price = JSON.parse(room.prices.prices);
        })
  },

  data(){
    return{
      success : false,
      price : [
        {
        from : "",
        to : "",
        price : ""
      }]
    }

  },

  methods : {
    addPeriod(){
      this.price.push({from: "", to: "", price: ""});
    },

    deletePeriod(i){
      this.price.splice(i,1);
    },

    sendData(){
      axios.post('/api/rooms/' + this.$route.params.id + '/prices', {price: this.price})
      .then((response)=>{
        if(response.status == 200){
          this.success = true;
          // setTimeout(()=>{this.$router.push({name : 'editRoom'}, {id:this.$route.params.id})}, 2500)
        }
    })
  }
},


}
</script>

<style lang="css">
</style>
