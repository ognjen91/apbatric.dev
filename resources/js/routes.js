// ADMIN
import AdminMain from './components/admin/Main.vue';
import adminLogin from './components/admin/Login.vue';
import adminDashboard from './components/admin/Dashboard.vue';

// ============admin: Room============
import addNewRoom from './components/admin/room/New.vue';
import editRoom from './components/admin/room/Edit.vue';
import changeProfileImg from './components/admin/room/ChangeProfileImg.vue';
import changeCoverImg from './components/admin/room/ChangeCoverImg.vue';
import roomPrices from './components/admin/room/Prices.vue';
import editCalendars from './components/admin/calendars/Edit.vue' ;

// ============admin: Event============
import addNewEvent from './components/admin/events/New.vue';
import editEvent from './components/admin/events/Edit.vue';
import Gallery from './components/admin/gallery/View.vue';

// ============admin: Mail============
import mailHome from './components/admin/mail/Home.vue' ;
import newMail from './components/admin/mail/New.vue' ;
import guestsList from './components/admin/mail/Guests.vue' ;
import viewMessage from './components/admin/mail/View.vue' ;


// ============admin: Pages============
import sliderHome from './components/admin/slider/Home.vue' ;
import adminProfile from './components/admin/Profile.vue' ;
import About from './components/admin/pages/About.vue' ;
import Contact from './components/admin/pages/Contact.vue' ;


// GOST
import GuestMain from './components/guest/Main.vue';
import Homepage from './components/guest/home/View.vue';
import promotion from './components/guest/home/PromotionWarning.vue';
import rooms from './components/guest/room/All.vue'
import viewRoom from './components/guest/room/View.vue'
import events from './components/guest/event/All.vue'
import viewEvent from './components/guest/event/View.vue'
import viewGallery from './components/guest/gallery/View.vue'
import contact from './components/guest/contact/View.vue'
import about from './components/guest/about/View.vue'

//catch all route
import catchAll from './components/main/404.vue'
import contactWarning from './components/main/ContactWarning.vue'




export const routes = [
  {
    path : '/admin',
    component : AdminMain,
    name : 'admin',


  //ADMIN
    children: [
      { path : 'login', component : adminLogin, name : 'adminLogin'},
      { path : 'profile', component : adminProfile, name : 'adminProfile'},
      { path : 'dashboard', component : adminDashboard, name : 'adminDashboard', meta : { requiresAuth : true}},
      { path : 'room/new', component : addNewRoom, name : 'newRoom', meta : { requiresAuth : true}},
      { path : 'room/:id', component : editRoom, name : 'editRoom', meta : { requiresAuth : true}},
      { path : 'room/:id/profile', component : changeProfileImg, name : 'changeProfileImg', meta : { requiresAuth : true}},
      { path : 'room/:id/cover', component : changeCoverImg, name : 'changeCoverImg', meta : { requiresAuth : true}},
      { path : 'room/:id/prices', component : roomPrices, name : 'editPrices', meta : { requiresAuth : true}},
      { path : 'events/add', component : addNewEvent, name : 'newEvent', meta : { requiresAuth : true}},
      { path : 'events/:id', component : editEvent, name : 'editEvent', meta : { requiresAuth : true}},
      { path : 'calendars/:id', component : editCalendars, name : 'editCalendars', meta : { requiresAuth : true}},
      { path : 'mail', component : mailHome, name : 'mailHome', meta : { requiresAuth : true}, children : [
        { path : 'new', component : newMail, name : 'newMail', meta : { requiresAuth : true}},
        { path : 'view_message/:id', component : viewMessage, name : 'viewMessage', meta : { requiresAuth : true}},
        { path : 'guests_list', component : guestsList, name : 'guestsList', meta : { requiresAuth : true}}
      ]},
      { path : 'slider', component : sliderHome, name : 'sliderHome', meta : { requiresAuth : true}},
      { path : 'about', component : About, name : 'adminAbout', meta : { requiresAuth : true}},
      { path : 'contact', component : Contact, name : 'adminContact', meta : { requiresAuth : true}},
      { path : 'gallery', component : Gallery, name : 'adminGallery', meta : { requiresAuth : true}},
    ]
  },



 //GOST
  {path: '', name: 'home', components : {
    default : Homepage,
    promotionWarning : promotion
  }},

  {path: '/rooms', name: 'rooms', components : {
    default : rooms
  }},
  {path: '/rooms/:id', name: 'viewRoom', components : {
    default : viewRoom
  }},
  {path: '/discounts', name: 'discounts', components : {
    default : events
  }},
  {path: '/gallery', name: 'gallery', components : {
    default : viewGallery
  }},
  {path: '/discounts/:id', name: 'viewDiscount', components : {
    default : viewEvent
  }},
  {path: '/about', name: 'about', components : {
    default : about
  }},
  {path: '/contact', name: 'contact', components : {
    default : contact,
    contactWarning : contactWarning
  }},
  {path: '/*', name: 'errorRoute', components : {
    default : catchAll
  }},





]
