<template lang="html">
<div class='row'>

  <div class="col-12 col-sm-12 col-md-6 col-lg-3 mailTo">
    <h2>Novi mail</h2>
    <h4>Označite primaoce:</h4>

      <table v-if="contacts.length">
        <tr>
          <th>Ime</th>
          <th>Označi</th>
          <tr v-for='contact in contacts'>
            <td>{{contact.name}}</td>
            <td><input type="checkbox" name='to' @change='addOrRemove(contact.mail)'></td>
          </tr>
        </tr>
      </table>

    <h3 v-else>Niste dodali nijedan kontakt</h3>
  </div>


  <div class="col-12 col-sm-12 col-md-6 col-lg-9">
    <h4>Vaša poruka</h4>
    <input type="text" v-model="mail.title" placeholder="Naslov" class="mailTitle">
    <!-- <textarea name="name" rows="10" cols="80" v-model='mail.body'></textarea> -->
    <VueTrix v-model="mail.body" />
    <div class="btn btn-success sendMail" @click='sendMail'>Pošalji</div>

    <div v-if="backMsg" class='mailBackInfo alert alert-success'><h3>{{backMsg}}</h3></div>
    <div v-if='errors.length' class="mailBackInfo">
      <ul>
        <li class="alert alert-danger" v-for='error in errors'>{{error}}</li>
      </ul>
    </div>
  </div>

</div>
</template>

<script>
import VueTrix from 'vue-trix'

export default {
  components : {
   VueTrix

  },
    data() {
        return {
            mail: {
                title: "",
                body: "Tekst poruke",
                to: []
            },
            contacts: [],
            backMsg: null,
            errors: []
        }
    },

    methods: {
        sendMail() {
            axios.post('/api/mail/create', this.mail).
            then((response) => {
                    this.backMsg = response.data.message;
                    location.reload();
                },
                (error) => {
                    if (error.response.status == 422) {
                        var instance = this;
                        instance.errors = [];
                        Object.keys(error.response.data.errors).forEach(function(key) {
                            console.log(error.response.data.errors[key]);
                            instance.errors.push(error.response.data.errors[key]);

                        });

                    }
                }).
            catch((error) => {

            })
        },


        addOrRemove(mail) {
            let is_in_array = this.mail.to.includes(mail);
            if (!is_in_array) {
                this.mail.to.push(mail)
            } else {
                for (var i = 0; i < this.mail.to.length; i++)
                    if (this.mail.to[i] === mail) {
                        this.mail.to.splice(i, 1);
                        break;
                    }
            }
            // console.log(this.mail.to);
        }
    },


    mounted() {
        axios.get('/api/contacts').
        then((response) => {
            this.contacts = response.data.contacts;
        })
    }
}
</script>

<style lang="css">
</style>
