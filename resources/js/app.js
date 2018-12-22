require('./bootstrap');
import Vue from 'vue';
import Vuex from 'vuex';
import VueRouter from 'vue-router';
import MainApp from './components/MainApp.vue'
import {routes} from './routes'
import storeData from './store'
import VueTrix from 'vue-trix'
import VueI18n from 'vue-i18n'




Vue.use(VueRouter);
Vue.use(Vuex);
Vue.use(VueI18n)

if (!localStorage.getItem('lang')){
  localStorage.setItem('lang', "sr");
}

//podes za l18n
let locale = localStorage.getItem('lang');
const i18n = new VueI18n({
  fallbackLocale: 'sr',
  locale: locale,

})

const store = new Vuex.Store(storeData);

const router = new VueRouter({
  routes,
  mode : 'history'
})


router.beforeEach((to, from, next) => {
  const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
  const currentUser = store.state.currentUser;

  localStorage.removeItem('VueTrixEditor.content');

  if (requiresAuth && !currentUser){
    next('/admin/login')
  } else if (to.path == "/admin/login" && currentUser) {
    next("/admin/dashboard");
  } else {
    next();
  }
})

// console.log(store.getters.currentUser.token)
if(store.getters.currentUser){
  axios.defaults.headers.common['Authorization'] = `Bearer ${store.getters.currentUser.token}`;
  axios.defaults.headers.common['Accept'] = `application/json`;
}

// presretanje neautorizovanih zahtjeva
axios.interceptors.response.use(null, (error) => {
    if (error.response.status == 401) {
        store.commit('logout');
        router.push({name : 'adminLogin'});
    }

    return Promise.reject(error);
});



const app = new Vue({
    i18n,
    el: '#app',
    router,
    store,
    components : {
      MainApp,
      VueTrix
    }
});


// setInterval(function(){
//   console.log("nsl", $('#slider').height())
// },1000)

// $("#sliderSpace").height($("#slider").height());
// console.log("sp", $("#sliderSpace").height())
// console.log("sl", $("#slider").height())
// $("#slider").height($("sliderSpace").height());
// $("#sliderSpace").height($("slider").height());


$(window).on('resize', function () {
    // Do something.
});

$('#app').on( 'click', '.smallImg>img', function(){
  // console.log($(this).attr('src'));
  // $("#bigImg").attr('background-image', "'url('"+$(this).attr('src')+)
});
