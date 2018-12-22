<template lang="html">
  <div>
      <div class="form-group">
          <label for="exampleInputEmail1"><h3>Naziv promocije: <strong>{{event.name.sr}}</strong></h3></label>
          <input type="text" v-model="event.name.sr" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="npr 'Velika junska akcija' ili 'Samo za vjerne goste'">
      </div>

      <div class="form-group">
          <label for="exampleInputEmail1"><h5>Naziv promocije na engleskom</h5></label>
          <input type="text" v-model="event.name.en" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" >
      </div>

      <div class="form-group">
          <label for="exampleInputEmail1"><h5>Naziv promocije na ruskom</h5></label>
          <input type="text" v-model="event.name.ru" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>



      <div class="form-group">
          <label for="exampleTextarea"><strong>Kratak opis</strong> (20-150 karaktera)</label>
          <VueTrix v-model="event.preview.sr"/>
          <small class="form-text text-muted">Ovaj kratak tekst se prikazuje na početnoj strani i treba da privuče pažnju.</small>
      </div>
      <div class="form-group">
          <label for="exampleTextarea"><strong>Kratak opis na engleskom</strong> (20-150 karaktera)</label>
          <VueTrix v-model="event.preview.en"/>
          <small class="form-text text-muted">Ovaj kratak tekst se prikazuje na početnoj strani i treba da privuče pažnju.</small>
      </div>
      <div class="form-group">
          <label for="exampleTextarea"><strong>Kratak opis na ruskom</strong> (20-150 karaktera)</label>
          <VueTrix v-model="event.preview.ru"/>
          <small class="form-text text-muted">Ovaj kratak tekst se prikazuje na početnoj strani i treba da privuče pažnju.</small>
      </div>




      <div class="form-group">
          <label for="exampleTextarea"><strong>Duži opis</strong> (minimalno 50 karaktera)</label>
          <VueTrix v-model="event.description.sr"/>
          <small class="form-text text-muted">Ovaj  tekst se prikazuje na  posebnoj stranici promocije.</small>
      </div>
      <div class="form-group">
          <label for="exampleTextarea"><strong>Duži opis na engleskom</strong> (minimalno 50 karaktera)</label>
          <VueTrix v-model="event.description.en"/>
          <small class="form-text text-muted">Ovaj  tekst se prikazuje na  posebnoj stranici promocije.</small>
      </div>
      <div class="form-group">
          <label for="exampleTextarea"><strong>Duži opis na ruskom</strong> (minimalno 50 karaktera)</label>
          <VueTrix v-model="event.description.ru"/>
          <small class="form-text text-muted">Ovaj  tekst se prikazuje na  posebnoj stranici promocije.</small>
      </div>

      </div>
</template>

<script>
export default {
  props : {
    event : Object
  }
}
</script>

<style lang="css">
</style>
