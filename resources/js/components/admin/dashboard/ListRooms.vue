<template lang="html">
  <div class="row">
    <div class="col-12">

    <h2 v-if="rooms.length" class="titleBiggest">
      SOBE
    <router-link :to="{ name: 'newRoom', params: {} }" class='btn btn-dark'>Dodajte novu sobu</router-link>
    </h2>

    <table v-if="rooms.length" class="listed_rooms">
      <tr>
        <th>Naziv</th>
        <th>Slika</th>
        <th>Mijenjaj</th>
        <th>Izbriši</th>
      </tr>
      <tr v-for='room in rooms'>
        <td>{{ room.name.sr }}</td>
        <td class="listed_profile_img"><img :src="'/images/rooms/' + room.profile_img" alt=""></td>
        <td><router-link :to="{ name: 'editRoom', params: {id : room.id} }"><a><i  class="far fa-edit fa-2x"></i></a></router-link></td>
        <td><i class="fas fa-times-circle fa-2x" @click="deleteRoom(room.id, room.name.sr)"></i></td>
    </tr>
  </table>

  <div v-else>
      <h3>Niste dodali ni jednu sobu</h3>
      <router-link :to="{ name: 'newRoom', params: {} }"><h3>Dodajte novu sobu</h3></router-link>
  </div>

  </div>
  </div>
</template>

<script>
export default {
  props : {
    rooms : Array
  },
  methods : {
    deleteRoom(id, name) {
        if (confirm("Da li ste sigurni da želite da izbrišete sobu '" + name + "''")) {
            axios.post('/api/rooms/remove/' + id, {}).
            then(response => {
                // location.reload();
                console.log(response);
            })
        }
    }
  }
}
</script>

<style lang="css">
</style>
