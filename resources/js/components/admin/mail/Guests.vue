<template lang="html">

<div class='row adresses'>

  <div class="col-12 col-sm-12 col-md-6 col-lg-5">
    <h4>Baza mailova gostiju</h4>
    <table class="contactsTable" v-if="contacts.length">
      <tr>
        <th>Ime</th>
        <th>Mail</th>
        <th>Brisanje</th>
      </tr>
      <tr v-for="contact in contacts">
        <td>{{contact.name}}</td>
        <td>{{contact.mail}}</td>
        <td class="delete_contact"><div @click='deleteContact(contact.id)'>x</div></td>
      </tr>
    </table>
    <div v-else><h5>Niste dodali ni jedan kontakt</h5></div>

    <div v-if="deleteSuccess" class='col-12 alert alert-success newContactMsg'>
      <h4>Kontakt je uspješno izbrisan.</h4>
    </div>
  </div>


  <div class="col-12 col-sm-12 col-md-6 col-lg-7  addAdressField">
    <form @submit.prevent="addContact">
      <h3>Dodajte novi kontakt u bazu</h3>
      <div class="form-inline">
        <label class="sr-only" for="newMail">Ime</label>
        <input type="text" v-model="newContact.name" id='newName' class='form-controll' placeholder="Ime">
        <label class="sr-only" for="newAdress">Mail</label>
        <input type="email" v-model='newContact.mail' id='newAdress' class='form-controll' placeholder="Mail">
        <button type="submit" class="btn btn-primary addAdress">Dodaj</button>
        <div class="row">

          <div v-if="success" class='col-12 alert alert-success newContactMsg'><h4>Kontakt je uspješno dodat.</h4></div>

          <div v-if="errors.length" class='col-12 alert alert-danger newContactMsg'>
            <ul>
              <li v-for="error in errors">{{ error }}</li>
            </ul>
          </div>
        </div>
      </div>
    </form>
</div>

</div>
</template>

<script>
export default {
  data(){
    return{
      newContact : {
        name : "",
        mail : ""
      },
      errors : [],
      success : false,
      contacts : [],
      deleteSuccess : false
    }
  },
  methods : {
    addContact(){
      axios.post('/api/contacts/create', this.newContact).
      then((response)=>{
        this.errors = [];
        this.success = true;
        setTimeout(()=>{location.reload()}, 2500);
      },
      (error) => {
        if(error.response.status == 422){
          var instance = this;
          instance.errors = [];
          Object.keys(error.response.data.errors).forEach(function(key) {
                console.log(error.response.data.errors[key]);
               instance.errors.push(error.response.data.errors[key]);

          });

        }
        if(error.response.status ==  500){
          this.success = error.response.data.message;
        }
      }
    ).
    catch((error)=>{

    })
  },

  deleteContact(id){
    axios.post('/api/contacts/delete', {id: id}).
    then((response)=>{
      this.deleteSuccess = true;
      setTimeout(()=>{location.reload()}, 2000);
    })
  }
  },

  mounted(){
    axios.get('/api/contacts').
    then((response)=>{
      this.contacts = response.data.contacts;
    })
  }
}
</script>

<style lang="css">
</style>
