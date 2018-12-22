<template lang="html">
<div class="admin">
<router-view></router-view>
  </div>
</template>

<script>

import TopOptions from './includes/Top.vue'
import {getLocalUser} from '../../helpers/auth.js'
export default {
  components : {
    TopOptions
  },
  computed : {
    user(){
      return getLocalUser();
    }
  }
}
</script>

<style lang="css">
.admin{
  padding-top: 15%;
}
</style>
